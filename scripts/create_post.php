<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to create a post.";
    include '../templates/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['post-title'];
    $content = $_POST['post-content'];
    $link = $_POST['post-link'];
    $tags = $_POST['post-tags'];

    // Insert the new post into the database
    $sql = "INSERT INTO Posts (user_id, title, content, link, tags) VALUES ('$user_id', '$title', '$content', '$link', '$tags')";

    if ($conn->query($sql) === TRUE) {
        header("Location: feed.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<main>
    <h2>Create Post</h2>
    <div class="create-post-form">
        <form action="create_post.php" method="post">
            <label for="post-title">Post Title:</label>
            <input type="text" id="post-title" name="post-title" placeholder="Enter post title" required>
            
            <label for="post-content">Post Content:</label>
            <textarea id="post-content" name="post-content" placeholder="Write your post..." required></textarea>
            
            <label for="post-link">Link:</label>
            <input type="url" id="post-link" name="post-link" placeholder="Enter URL (optional)">
            
            <label for="post-tags">Tags:</label>
            <input type="text" id="post-tags" name="post-tags" placeholder="Enter tags separated by commas">
            
            <button type="submit">Create Post</button>
        </form>
    </div>
</main>

<?php 
include '../templates/footer.php'; 
?>
