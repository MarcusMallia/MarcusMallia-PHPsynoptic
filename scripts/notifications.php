<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch notifications for the logged-in user
$sql = "SELECT * FROM Notifications WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="main-content">
    <main>
        <h2>Notifications</h2>
        <?php while ($notification = $result->fetch_assoc()): ?>
            <div class="notification <?php echo $notification['is_read'] ? 'read' : 'unread'; ?>">
                <p><?php echo htmlspecialchars($notification['message']); ?></p>
                <p><small><?php echo htmlspecialchars($notification['created_at']); ?></small></p>
                <?php if (!$notification['is_read']): ?>
                    <form action="update_notification.php" method="post">
                        <input type="hidden" name="notification_id" value="<?php echo $notification['notification_id']; ?>">
                        <button type="submit">Mark as Read</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </main>
</div>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
