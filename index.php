<?php 
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: scripts/login.php");
    exit();
}

include 'templates/header.php'; 
include 'scripts/config.php'; 

// Fetch the latest posts with usernames
$sql = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC LIMIT 10";
$result = $conn->query($sql);
?>

<main>
    <h2>Welcome to SpeakeasySounds</h2>
    <p>Share your musical experiences and connect with other music enthusiasts.</p>

    <h3>Latest Posts</h3>
    <?php while ($post = $result->fetch_assoc()): ?>
        <div class="post">
            <h4><a href="scripts/post_details.php?post_id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h4>
            <p>By <a href="scripts/user_profile.php?user_id=<?php echo $post['user_id']; ?>"><?php echo htmlspecialchars($post['username']); ?></a></p>
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <?php if (!empty($post['link'])): ?>
                <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
            <?php endif; ?>
            <p>Tags: <?php echo htmlspecialchars($post['tags']); ?></p>
            <div class="post-actions">
                <button>Like</button>
                <button>Comment</button>
                <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
                    <a href="scripts/update_post.php?post_id=<?php echo $post['post_id']; ?>">Edit</a>
                    <a href="scripts/delete_post.php?post_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<?php 
include 'templates/footer.php'; 
$conn->close();
?>
