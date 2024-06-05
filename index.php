<?php 
session_start();
include 'templates/header.php'; 
include 'scripts/config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: scripts/login.php");
    exit();
}

// Fetch the latest posts with usernames
$sql = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC LIMIT 10";
$result = $conn->query($sql);
?>

<main>
    <h2>Welcome to SpeakeasySounds</h2>
    <p>Share your musical experiences and connect with other music enthusiasts.</p>

    <h3>Latest Posts</h3>
    <?php while ($post = $result->fetch_assoc()): ?>
        <?php include 'templates/post.php'; ?>
    <?php endwhile; ?>
</main>

<?php 
include 'templates/footer.php'; 
$conn->close();
?>
