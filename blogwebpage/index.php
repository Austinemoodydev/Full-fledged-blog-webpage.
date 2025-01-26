<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Blog</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="Stylesheet" href="index.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <h1>My Professional Blog</h1>
    <nav>
        <a href="index.php"><i class="fas fa-home"></i> Home</a>
        <a href="create.php"><i class="fas fa-plus-circle"></i> Add Post</a>
    </nav>
    <form method="GET" action="index.php" class="search-form">
        <input type="text" name="search" placeholder="Search posts..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</header>

<?php
// Connect to database
$conn = new mysqli('localhost', 'root', '', 'blog');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!-- Category Filter Links -->
<nav class="categories">
    <a href="index.php"><i class="fas fa-list"></i> All</a>
    <?php
    // Fetch categories from the database
    $categories_result = $conn->query("SELECT * FROM categories");
    while ($category = $categories_result->fetch_assoc()): ?>
        <a href="index.php?category_id=<?php echo $category['id']; ?>"><i class="fas fa-tag"></i> <?php echo htmlspecialchars($category['name']); ?></a>
    <?php endwhile; ?>
</nav>

<main>
    <?php
    // Set the number of posts per page
    $posts_per_page = 5;

    // Get the current page or set to 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $posts_per_page;

    // Get the category filter
    $category_filter = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

    // Check if a search query is provided
    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Build SQL query with category filter and/or search term
    if ($category_filter) {
        $sql = "SELECT * FROM posts WHERE category_id = ? ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $category_filter, $posts_per_page, $offset);
    } elseif ($search) {
        $sql = "SELECT * FROM posts WHERE title LIKE ? OR content LIKE ? ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $search . "%";
        $stmt->bind_param("ssii", $searchParam, $searchParam, $posts_per_page, $offset);
    } else {
        // Fetch posts for the current page without any filters
        $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT ? OFFSET ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $posts_per_page, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Get the total number of posts for pagination
    $total_posts_query = "SELECT COUNT(*) AS total FROM posts";
    $total_posts_result = $conn->query($total_posts_query);
    $total_posts = $total_posts_result->fetch_assoc()['total'];
    $total_pages = ceil($total_posts / $posts_per_page);

    // Display posts
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<article>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p>By " . htmlspecialchars($row['author']) . " on " . $row['created_at'] . "</p>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";

            // Add comment form for each post
            echo '<form method="POST" action="add_comment.php">
                    <input type="hidden" name="post_id" value="' . $row['id'] . '">
                    <input type="text" name="username" placeholder="Your name" required>
                    <textarea name="comment" placeholder="Write a comment..." required></textarea>
                    <button type="submit"><i class="fas fa-comment"></i> Comment</button>
                  </form>';

            // Fetch and display comments for the post
            $comments_sql = "SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC";
            $comments_stmt = $conn->prepare($comments_sql);
            $comments_stmt->bind_param("i", $row['id']);
            $comments_stmt->execute();
            $comments_result = $comments_stmt->get_result();

            if ($comments_result->num_rows > 0) {
                while ($comment = $comments_result->fetch_assoc()) {
                    echo "<div class='comment'>";
                    echo "<p><i class='fas fa-user'></i> <strong>" . htmlspecialchars($comment['username']) . "</strong>: " . nl2br(htmlspecialchars($comment['comment'])) . "</p>";
                    echo "<p class='comment-date'>" . $comment['created_at'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p><i class='fas fa-comment-slash'></i> No comments yet!</p>";
            }

            echo "</article>";
        }
    } else {
        echo "<p>No posts found!</p>";
    }
    ?>

    <!-- Pagination links -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>"><i class="fas fa-chevron-left"></i> Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $total_pages): ?>
            <a href="?page=<?php echo $page + 1; ?>">Next <i class="fas fa-chevron-right"></i></a>
        <?php endif; ?>
    </div>
</main>
<footer>
    <p>&copy; 2025 My Blog. All rights reserved.</p>
</footer>
</body>
</html>
