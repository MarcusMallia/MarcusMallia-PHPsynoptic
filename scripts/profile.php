<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to view your profile.";
    include '../templates/footer.php';
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user information
$sql_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

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
$sql_posts = "SELECT * FROM Posts WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result_posts = $conn->query($sql_posts);
?>

<main>
    <h2>Profile</h2>
    <div class="profile-info">
        <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile Picture" class="profile-picture">
        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
        <p><?php echo htmlspecialchars($user['bio']); ?></p>
        <p>Followers: <?php echo $follower_count; ?></p>
        <p>Following: <?php echo $following_count; ?></p>
        <p>Posts: <?php echo $post_count; ?></p>
        <a href="update_user.php"><button>Edit Profile</button></a>
    </div>
    <h2>Your Posts</h2>
    <?php while ($post = $result_posts->fetch_assoc()): ?>
        <?php include '../templates/post.php'; ?>
    <?php endwhile; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
