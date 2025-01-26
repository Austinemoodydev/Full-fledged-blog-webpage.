<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $conn = new mysqli('localhost', 'root', '', 'blog');

    // Delete the post
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Error deleting post.";
    }
} else {
    die("Invalid request.");
}
?>