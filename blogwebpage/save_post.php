<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];
    $category = $_POST['category'];  // Handle category

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'blog');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert post into database with category
    $stmt = $conn->prepare("INSERT INTO posts (title, author, content, category) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $author, $content, $category);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
