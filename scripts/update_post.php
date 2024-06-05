<?php
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to update a post.";
    include '../templates/footer.php';
    exit();
}

// Check if the post ID is provided
if (!isset($_GET['post_id'])) {
    echo "No post ID provided.";
    include '../templates/footer.php';
    exit();
}

$post_id = $_GET['post_id'];

// Fetch the existing post data
$sql = "SELECT * FROM Posts WHERE post_id = '$post_id' AND user_id = '".$_SESSION['user_id']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    echo "No post found or you do not have permission to edit this post.";
    include '../templates/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['post-title'];
    $content = $_POST['post-content'];
    $link = $_POST['post-link'];
    $tags = $_POST['post-tags'];

    // Update the post in the database
    $sql = "UPDATE Posts SET title = '$title', content = '$content', link = '$link', tags = '$tags' WHERE post_id = '$post_id' AND user_id = '".$_SESSION['user_id']."'";

    if ($conn->query($sql) === TRUE) {
        header("Location: feed.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<main>
    <h2>Update Post</h2>
    <div class="update-post-form">
        <form action="update_post.php?post_id=<?php echo $post_id; ?>" method="post">
            <label for="post-title">Post Title:</label>
            <input type="text" id="post-title" name="post-title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            
            <label for="post-content">Post Content:</label>
            <textarea id="post-content" name="post-content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            
            <label for="post-link">Link:</label>
            <input type="url" id="post-link" name="post-link" value="<?php echo htmlspecialchars($post['link']); ?>" placeholder="Enter URL (optional)">
            
            <label for="post-tags">Tags:</label>
            <input type="text" id="post-tags" name="post-tags" value="<?php echo htmlspecialchars($post['tags']); ?>" placeholder="Enter tags separated by commas">
            
            <button type="submit">Update Post</button>
        </form>
    </div>
</main>

<?php 
include '../templates/footer.php'; 
?>
