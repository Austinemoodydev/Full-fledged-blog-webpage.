<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli('localhost', 'root', '', 'blog');
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];  // Store user role in session
            header('Location: index.php');
            exit;
        } else {
            echo "<p class='error-message'>Invalid password.</p>";
        }
    } else {
        echo "<p class='error-message'>No user found.</p>";
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link rel="stylesheet" href="login.css">
<div class="login-container">
    <form method="POST" class="login-form">
        <h2>Login</h2>
        
        <div class="input-group">
            <label for="username"><i class="fas fa-user"></i> Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username" required class="input-field">
        </div>
        
        <div class="input-group">
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required class="input-field">
        </div>
        
        <button type="submit" class="submit-button">Login</button>
        <p class="forgot-password"><a href="#">Forgot Password?</a></p>
    </form>
</div>
