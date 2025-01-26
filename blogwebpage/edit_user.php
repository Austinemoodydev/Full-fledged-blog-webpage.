<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    echo "Access denied. Admins only.";
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'blog');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch user data
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        die("User not found.");
    }
} else {
    die("Invalid request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Update user in the database
    $update_stmt = $conn->prepare("UPDATE users SET email = ?, role = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $email, $role, $user_id);

    if ($update_stmt->execute()) {
        header("Location: manage_users.php");
        exit;
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="contributor" <?php echo $user['role'] === 'contributor' ? 'selected' : ''; ?>>Contributor</option>
        </select>

        <button type="submit">Update User</button>
    </form>
</body>
</html>