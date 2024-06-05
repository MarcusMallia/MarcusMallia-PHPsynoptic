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

// Fetch user-specific posts
$sql_posts = "SELECT * FROM Posts WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result_posts = $conn->query($sql_posts);
?>

<main>
    <h2>Profile</h2>
    <div class="profile-info">
        <h3><?php echo htmlspecialchars($user['username']); ?></h3>
        <p><?php echo htmlspecialchars($user['email']); ?></p>
        <button>Edit Profile</button>
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
