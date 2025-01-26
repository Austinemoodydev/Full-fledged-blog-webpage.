<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = (int) $_POST['post_id']; // Ensure it's an integer
    $username = htmlspecialchars($_POST['username']); // Sanitize username to prevent XSS
    $comment = htmlspecialchars($_POST['comment']); // Sanitize comment to prevent XSS

    // Create a connection
    $conn = new mysqli('localhost', 'root', '', 'blog');

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the statement
    $stmt = $conn->prepare("INSERT INTO comments (post_id, username, comment) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Statement preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iss", $post_id, $username, $comment);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        header("Location: index.php");
        exit(); // Always call exit() after a redirect to stop further script execution
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
