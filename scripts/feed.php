<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to view the feed.";
    include '../templates/footer.php';
    exit();
}

// Fetch all posts with usernames from the database
$sql = "SELECT Posts.*, Users.username FROM Posts INNER JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC";
$result = $conn->query($sql);
?>

<main>
    <h2>Feed</h2>
    <?php while ($post = $result->fetch_assoc()): ?>
        <?php include '../templates/post.php'; ?>
    <?php endwhile; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
