<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to update your profile.";
    include '../templates/footer.php';
    exit();
}

$user_id = $_SESSION['user_id'];

$sql_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    $user = $result_user->fetch_assoc();
} else {
    echo "User not found.";
    include '../templates/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    } else {
        $target_file = $user['profile_picture'];
    }

    $sql_update = "UPDATE Users SET username='$username', email='$email', bio='$bio', profile_picture='$target_file' WHERE user_id='$user_id'";
    if ($conn->query($sql_update) === TRUE) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<main class="main-content">
    <h2>Update Profile</h2>
    <form action="update_user.php" method="post" enctype="multipart/form-data" class="profile-form">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="bio">Bio:</label>
            <textarea id="bio" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="profile_picture">Profile Picture:</label>
            <input type="file" id="profile_picture" name="profile_picture">
        </div>
        <button type="submit">Update Profile</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>
