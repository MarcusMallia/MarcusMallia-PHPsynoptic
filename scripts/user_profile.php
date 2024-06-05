<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user ID from the query string
if (!isset($_GET['user_id'])) {
    echo "No user ID provided.";
    include '../templates/footer.php';
    exit();
}

$user_id = $_GET['user_id'];

// Fetch user information
$sql_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
} else {
    echo "User not found.";
    include '../templates/footer.php';
    exit();
}

// Fetch user-specific posts
$sql_posts = "SELECT Posts.*, Users.username FROM Posts INNER JOIN Users ON Posts.user_id = Users.user_id WHERE Posts.user_id = '$user_id' ORDER BY Posts.created_at DESC";
$result_posts = $conn->query($sql_posts);
?>

<main>
    <h2><?php echo htmlspecialchars($user['username']); ?>'s Profile</h2>
    <div class="profile-info">
        <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <button>Follow</button> <!-- Add follow/unfollow functionality here -->
    </div>
    <h2>Posts by <?php echo htmlspecialchars($user['username']); ?></h2>
    <?php while ($post = $result_posts->fetch_assoc()): ?>
        <div class="post">
            <h3><a href="post_details.php?post_id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
            <p>by <a href="user_profile.php?user_id=<?php echo $post['user_id']; ?>"><?php echo htmlspecialchars($post['username']); ?></a></p>
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <?php if (!empty($post['link'])): ?>
                <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
            <?php endif; ?>
            <p>Tags: <?php echo htmlspecialchars($post['tags']); ?></p>
            <div class="post-actions">
                <button>Like</button>
                <button>Comment</button>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                    <a href="update_post.php?post_id=<?php echo $post['post_id']; ?>">Edit</a>
                    <a href="delete_post.php?post_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
