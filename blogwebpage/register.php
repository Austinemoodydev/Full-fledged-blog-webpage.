<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = $_POST['role']; // Get the role from the form

    $conn = new mysqli('localhost', 'root', '', 'blog');
    
    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare the SQL statement to include the role
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<link rel="stylesheet" href="register.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<form method="POST" action="register_process.php" class="registration-form">
    <div class="form-group">
        <label for="username"><i class="fas fa-user"></i> Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
    </div>
    
    <div class="form-group">
        <label for="password"><i class="fas fa-lock"></i> Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
    
    <div class="form-group">
        <label for="role"><i class="fas fa-user-tag"></i> Role</label>
        <select id="role" name="role" required>
            <option value="contributor">Contributor</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    
    <button type="submit" class="btn-submit">Register</button>
</form>

<!-- Optional: Basic styling for a cleaner appearance -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .registration-form {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        box-sizing: border-box;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
        color: #333;
    }

    input[type="text"], input[type="password"], select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }

    input[type="text"]:focus, input[type="password"]:focus, select:focus {
        border-color: #007BFF;
        outline: none;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    .form-group i {
        margin-right: 8px;
    }
</style>
