<?php include 'templates/header.php'; ?>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to create a post.";
    include 'templates/footer.php';
    exit();
}

// Include the database connection file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    $link = $_POST['link'];

    // Insert the new post into the database
    $sql = "INSERT INTO Posts (user_id, content, link) VALUES ('$user_id', '$content', '$link')";

    if ($conn->query($sql) === TRUE) {
        echo "New post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<h2>Create a New Post</h2>
<form action="create_post.php" method="post">
    <label for="content">Content:</label>
    <textarea id="content" name="content" required></textarea><br>
    <label for="link">Link:</label>
    <input type="text" id="link" name="link"><br>
    <input type="submit" value="Create Post">
</form>
<?php include 'templates/footer.php'; ?>
