<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql_posts = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC LIMIT 10";
$result_posts = $conn->query($sql_posts);
?>

<main>
    <h2>Welcome to SpeakeasySounds</h2>
    <p>Share your musical experiences and connect with other music enthusiasts.</p>

    <h3>Latest Posts</h3>
    <?php while ($post = $result_posts->fetch_assoc()): ?>
        <?php include '../templates/post.php'; ?>
    <?php endwhile; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
