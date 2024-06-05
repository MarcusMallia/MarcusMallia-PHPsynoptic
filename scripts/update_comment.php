<?php 
session_start();
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$comment_id = $_GET['comment_id'];
$post_id = $_GET['post_id'];

// Fetch the comment details
$sql_comment = "SELECT * FROM Comments WHERE comment_id = '$comment_id' AND user_id = '".$_SESSION['user_id']."'";
$result_comment = $conn->query($sql_comment);

if ($result_comment->num_rows > 0) {
    $comment = $result_comment->fetch_assoc();
} else {
    echo "Comment not found or you don't have permission to update this comment.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];

    // Update the comment in the database
    $sql_update = "UPDATE Comments SET content='$content' WHERE comment_id='$comment_id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: post_details.php?post_id=$post_id");
        exit();
    } else {
        echo "Error updating comment: " . $conn->error;
    }
}
?>

<?php include '../templates/header.php'; ?>
<main>
    <h2>Update Comment</h2>
    <form action="update_comment.php?comment_id=<?php echo $comment_id; ?>&post_id=<?php echo $post_id; ?>" method="post">
        <textarea name="content" required><?php echo htmlspecialchars($comment['content']); ?></textarea>
        <button type="submit">Update Comment</button>
    </form>
</main>
<?php include '../templates/footer.php'; ?>
<?php $conn->close(); ?>
