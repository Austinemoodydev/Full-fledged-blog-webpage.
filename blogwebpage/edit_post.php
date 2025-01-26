<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'blog');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Fetch the post data
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $post = $result->fetch_assoc();
    } else {
        die("Post not found.");
    }

    // Fetch categories for the dropdown
    $categories_result = $conn->query("SELECT * FROM categories");
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];

    // Update the post in the database
    $update_stmt = $conn->prepare("UPDATE posts SET title = ?, content = ?, author = ?, category_id = ? WHERE id = ?");
    $update_stmt->bind_param("sssii", $title, $content, $author, $category_id, $post_id);

    if ($update_stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error updating post.";
    }
}
?>

<form method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

    <label for="content">Content:</label>
    <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>

    <label for="category">Category:</label>
    <select id="category" name="category_id" required>
        <?php while ($category = $categories_result->fetch_assoc()): ?>
            <option value="<?php echo $category['id']; ?>" <?php echo $category['id'] == $post['category_id'] ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category['name']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Update Post</button>
</form>