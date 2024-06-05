<?php 
session_start();
include '../templates/header.php'; // Adjusted path
include '../scripts/config.php';   // Adjusted path

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the latest posts with usernames
$sql = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC LIMIT 10";
$result = $conn->query($sql);
?>

<div class="main-content">
    <main>
        <h2>Welcome to SpeakeasySounds</h2>
        <p>Share your musical experiences and connect with other music enthusiasts.</p>

        <h3>Latest Posts</h3>
        <div class="post-container">
            <?php while ($post = $result->fetch_assoc()): ?>
                <?php include '../templates/post.php'; ?>
            <?php endwhile; ?>
        </div>
    </main>
</div>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
