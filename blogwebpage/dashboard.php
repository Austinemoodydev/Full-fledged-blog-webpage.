<?php
session_start();

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'blog');

// Fetch statistics
$total_posts = $conn->query("SELECT COUNT(*) AS total FROM posts")->fetch_assoc()['total'];
$total_categories = $conn->query("SELECT COUNT(*) AS total FROM categories")->fetch_assoc()['total'];
$total_comments = $conn->query("SELECT COUNT(*) AS total FROM comments")->fetch_assoc()['total'];

// Count total users
$total_users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

// Count posts by the logged-in contributor
if ($_SESSION['role'] === 'contributor') {
    $user_posts = $conn->prepare("SELECT COUNT(*) AS total FROM posts WHERE author_id = ?");
    $user_posts->bind_param("i", $_SESSION['user_id']);
    $user_posts->execute();
    $user_posts = $user_posts->get_result()->fetch_assoc()['total'];
}

// Fetch posts for display
$posts_result = $conn->query("SELECT posts.*, categories.name AS category_name FROM posts LEFT JOIN categories ON posts.category_id = categories.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet"href="dashboard.css">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h1>
        <nav>
            <a href="index.php"><i class="fas fa-blog"></i> View Blog</a>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="create.php"><i class="fas fa-plus-circle"></i> Add Post</a>
                <a href="manage_users.php"><i class="fas fa-users-cog"></i> Manage Users</a>
            <?php endif; ?>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>
    </header>

    <main>
        <section class="analytics">
            <h2><i class="fas fa-chart-line"></i> Blog Analytics</h2>
            <p><i class="fas fa-pencil-alt"></i> Total Posts: <?php echo $total_posts; ?></p>
            <p><i class="fas fa-th-list"></i> Total Categories: <?php echo $total_categories; ?></p>
            <p><i class="fas fa-comments"></i> Total Comments: <?php echo $total_comments; ?></p>
            <p><i class="fas fa-users"></i> Total Users: <?php echo $total_users; ?></p>
            
            <?php if ($_SESSION['role'] === 'contributor'): ?>
                <p><i class="fas fa-pen"></i> Your Posts: <?php echo isset($user_posts) ? $user_posts : 0; ?></p>
            <?php endif; ?>
        </section>

        <h2><i class="fas fa-edit"></i> Manage Posts</h2>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($post = $posts_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post['title']); ?></td>
                        <td><?php echo htmlspecialchars($post['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($post['author']); ?></td>
                        <td>
                            <?php 
                            // Check if the user is a contributor and ensure they can only edit their own posts
                            if ($_SESSION['role'] === 'contributor' && $post['author_id'] !== $_SESSION['user_id']) {
                                echo "You can only edit your posts.";
                            } else {
                                // Show edit and delete links for admin and contributors who own the post
                                ?>
                                <a href="edit_post.php?id=<?php echo $post['id']; ?>"><i class="fas fa-edit"></i> Edit</a> | 
                                <a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?')"><i class="fas fa-trash-alt"></i> Delete</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
