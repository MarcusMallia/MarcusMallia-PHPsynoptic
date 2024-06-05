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

$current_user_id = $_SESSION['user_id'];
$user_id = $_GET['user_id'];

// Define the is_following function
function is_following($current_user_id, $user_id, $conn) {
    $sql = "SELECT * FROM Followers WHERE follower_user_id = '$current_user_id' AND user_id = '$user_id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

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

// Fetch follower count
$sql_followers = "SELECT COUNT(*) as follower_count FROM Followers WHERE user_id = '$user_id'";
$result_followers = $conn->query($sql_followers);
$follower_count = $result_followers->fetch_assoc()['follower_count'];

// Fetch following count
$sql_following = "SELECT COUNT(*) as following_count FROM Followers WHERE follower_user_id = '$user_id'";
$result_following = $conn->query($sql_following);
$following_count = $result_following->fetch_assoc()['following_count'];

// Fetch post count
$sql_post_count = "SELECT COUNT(*) as post_count FROM Posts WHERE user_id = '$user_id'";
$result_post_count = $conn->query($sql_post_count);
$post_count = $result_post_count->fetch_assoc()['post_count'];

// Fetch user-specific posts
$sql_posts = "SELECT Posts.*, Users.username FROM Posts INNER JOIN Users ON Posts.user_id = Users.user_id WHERE Posts.user_id = '$user_id' ORDER BY Posts.created_at DESC";
$result_posts = $conn->query($sql_posts);
?>

<main class="main-content">
    <div class="profile-header">
        <div class="profile-picture-container">
            <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
        </div>
        <div class="profile-info">
            <h3><?php echo htmlspecialchars($user['username']); ?></h3>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
            <p><?php echo htmlspecialchars($user['bio']); ?></p>
            <p>Followers: <?php echo $follower_count; ?></p>
            <p>Following: <?php echo $following_count; ?></p>
            <p>Posts: <?php echo $post_count; ?></p>

            <!-- Follow/Unfollow button -->
            <?php if ($current_user_id != $user_id): ?>
                <form class="follow-form" data-user-id="<?php echo $user_id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <?php if (is_following($current_user_id, $user_id, $conn)): ?>
                        <button type="submit" name="action" value="unfollow">Unfollow</button>
                    <?php else: ?>
                        <button type="submit" name="action" value="follow">Follow</button>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="profile-posts">
        <h2>Posts by <?php echo htmlspecialchars($user['username']); ?></h2>
        <div class="post-container">
            <?php while ($post = $result_posts->fetch_assoc()): ?>
                <?php include '../templates/post.php'; ?>
            <?php endwhile; ?>
        </div>
    </div>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
<script src="/MarcusMallia-PHPsynoptic/assets/follow.js" defer></script>
