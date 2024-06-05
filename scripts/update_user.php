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

// Fetch user information
$sql_user = "SELECT * FROM Users WHERE user_id = '$user_id'";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];

    // Handle profile picture upload
    $profile_picture = $user['profile_picture']; // Default to current profile picture
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check !== false) {
            // Check file size (limit to 5MB)
            if ($_FILES['profile_picture']['size'] > 5000000) {
                echo "Sorry, your file is too large.";
            } else {
                // Allow certain file formats
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                    if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
                        $profile_picture = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Update password only if a new password is provided
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql_update = "UPDATE Users SET username='$username', email='$email', password='$password', profile_picture='$profile_picture', bio='$bio' WHERE user_id='$user_id'";
    } else {
        $sql_update = "UPDATE Users SET username='$username', email='$email', profile_picture='$profile_picture', bio='$bio' WHERE user_id='$user_id'";
    }

    if ($conn->query($sql_update) === TRUE) {
        header("Location: profile.php"); // Redirect back to profile page
        exit();
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<main>
    <h2>Edit Profile</h2>
    <form action="update_user.php" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter new password (leave blank to keep current password)">
        
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture">
        
        <label for="bio">Bio:</label>
        <textarea id="bio" name="bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
        
        <button type="submit">Update Profile</button>
    </form>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
