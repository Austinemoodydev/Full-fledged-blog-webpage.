<?php 
session_start();
if (!isset($_SESSION['username'])) { 
    header('Location: login.php'); 
    exit; 
}  

// Fetch categories from the database where category ID is between 1 and 10
$conn = new mysqli('localhost', 'root', '', 'blog');
$categories_result = $conn->query("SELECT * FROM categories WHERE id BETWEEN 1 AND 10"); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Add New Post</title>     
    <link rel="stylesheet" href="styles.css">     
    <link rel="stylesheet" href="create.css">     
    <!-- Font Awesome CDN -->     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
</head> 
<body>     
    <header>         
        <h1><i class="fas fa-plus-circle"></i> Add New Post</h1>         
        <nav>             
            <a href="index.php"><i class="fas fa-home"></i> Home</a>         
        </nav>     
    </header>     
    <main>         
        <form action="save_post.php" method="POST">             
            <label for="title"><i class="fas fa-heading"></i> Title:</label>             
            <input type="text" id="title" name="title" required>              

            <label for="author"><i class="fas fa-user"></i> Author:</label>             
            <input type="text" id="author" name="author" required>              

            <label for="content"><i class="fas fa-pencil-alt"></i> Content:</label>             
            <textarea id="content" name="content" rows="10" required></textarea>              

            <!-- Category Dropdown -->             
            <label for="category"><i class="fas fa-th-list"></i> Category:</label>             
            <select id="category" name="category_id" required>                 
                <option value="">Select a category</option>                 
                <?php while ($category = $categories_result->fetch_assoc()): ?>                     
                    <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>                 
                <?php endwhile; ?>             
            </select>              

            <button type="submit"><i class="fas fa-paper-plane"></i> Publish</button>         
        </form>     
    </main> 
</body> 
</html>
