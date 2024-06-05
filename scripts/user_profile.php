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

// Function to check if the current user is following this user
function is_following($current_user_id, $user_id, $conn) {
    $sql = "SELECT * FROM Followers WHERE follower_user_id = '$current_user_id' AND user_id = '$user_id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

$is_following = is_following($current_user_id, $user_id, $conn);

// Fetch user-specific posts
$sql_posts = "SELECT Posts.*, Users.username FROM Posts INNER JOIN Users ON Posts.user_id = Users.user_id WHERE Posts.user_id = '$user_id' ORDER BY Posts.created_at DESC";
$result_posts = $conn->query($sql_posts);
?>

<main>
    <h2><?php echo htmlspecialchars($user['username']); ?>'s Profile</h2>
    <div class="profile-info">
        <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Joined: <?php echo htmlspecialchars($user['created_at']); ?></p>

        <!-- Follow/Unfollow button -->
        <?php if ($current_user_id != $user_id): ?>
            <form class="follow-form" data-user-id="<?php echo $user_id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                <?php if ($is_following): ?>
                    <button type="submit" name="action" value="unfollow">Unfollow</button>
                <?php else: ?>
                    <button type="submit" name="action" value="follow">Follow</button>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </div>

    <h2>Posts by <?php echo htmlspecialchars($user['username']); ?></h2>
    <?php while ($post = $result_posts->fetch_assoc()): ?>
        <?php include '../templates/post.php'; ?>
    <?php endwhile; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
<script src="/MarcusMallia-PHPsynoptic/assets/follow.js" defer></script>
