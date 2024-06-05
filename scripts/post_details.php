<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

if (!isset($_GET['post_id'])) {
    echo "No post ID provided.";
    include '../templates/footer.php';
    exit();
}

$post_id = $_GET['post_id'];

$sql_post = "SELECT * FROM Posts WHERE post_id = '$post_id'";
$result_post = $conn->query($sql_post);

if ($result_post->num_rows > 0) {
    $post = $result_post->fetch_assoc();
} else {
    echo "Post not found.";
    include '../templates/footer.php';
    exit();
}

$sql_comments = "SELECT Comments.*, Users.username FROM Comments INNER JOIN Users ON Comments.user_id = Users.user_id WHERE Comments.post_id = '$post_id' ORDER BY Comments.created_at DESC";
$result_comments = $conn->query($sql_comments);

$sql_tags = "SELECT tags.name FROM tags INNER JOIN post_tags ON tags.tag_id = post_tags.tag_id WHERE post_tags.post_id = '$post_id'";
$result_tags = $conn->query($sql_tags);
?>

<main>
    <h2>Post Details</h2>
    <div class="post">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
        <p><?php echo htmlspecialchars($post['content']); ?></p>
        <?php if (!empty($post['link'])): ?>
            <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
        <?php endif; ?>
        <p>Tags: 
            <?php while ($tag = $result_tags->fetch_assoc()): ?>
                <?php echo htmlspecialchars($tag['name']) . ' '; ?>
            <?php endwhile; ?>
        </p>
    </div>
    <h3>Comments</h3>
    <?php while ($comment = $result_comments->fetch_assoc()): ?>
        <div class="comment">
            <p><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong> <?php echo htmlspecialchars($comment['content']); ?></p>
            <?php if ($comment['user_id'] == $_SESSION['user_id']): ?>
                <a href="update_comment.php?comment_id=<?php echo $comment['comment_id']; ?>&post_id=<?php echo $post_id; ?>">Update</a>
                <a href="delete_comment.php?comment_id=<?php echo $comment['comment_id']; ?>&post_id=<?php echo $post_id; ?>" onclick="return confirm('Are you sure you want to delete this comment?');">Delete</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    <div class="add-comment">
        <form action="create_comment.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <textarea name="content" placeholder="Add a comment..." required></textarea>
            <button type="submit">Post Comment</button>
        </form>
    </div>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
