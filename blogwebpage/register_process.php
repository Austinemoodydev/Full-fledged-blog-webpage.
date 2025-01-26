<?php
// Database connection variables
$servername = "localhost";
$username_db = "root"; // use your database username
$password_db = ""; // use your database password
$dbname = "blog"; // your database name

// Create connection
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure these values are set before using them
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Validate and sanitize inputs as needed

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind the parameters to the prepared statement
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $role);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "User registered successfully.";
        header("Location: login.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
