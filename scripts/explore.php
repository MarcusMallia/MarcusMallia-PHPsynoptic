<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$search_query = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_query = $_POST['search_query'];
}

// Fetch new posts
$sql_new_posts = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id ORDER BY Posts.created_at DESC LIMIT 10";
$result_new_posts = $conn->query($sql_new_posts);

// Fetch new users
$sql_new_users = "SELECT * FROM Users ORDER BY created_at DESC LIMIT 10";
$result_new_users = $conn->query($sql_new_users);

// Fetch search results for posts
$sql_search_posts = "SELECT Posts.*, Users.username FROM Posts JOIN Users ON Posts.user_id = Users.user_id WHERE Posts.content LIKE '%$search_query%' OR Users.username LIKE '%$search_query%' OR Posts.tags LIKE '%$search_query%' ORDER BY Posts.created_at DESC";
$result_search_posts = $conn->query($sql_search_posts);

// Fetch search results for users
$sql_search_users = "SELECT * FROM Users WHERE username LIKE '%$search_query%' ORDER BY created_at DESC";
$result_search_users = $conn->query($sql_search_users);

// Function to check if the current user is following another user
function is_following($current_user_id, $user_id, $conn) {
    $sql = "SELECT * FROM Followers WHERE follower_user_id = '$current_user_id' AND user_id = '$user_id'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

$current_user_id = $_SESSION['user_id'];
?>

<main>
    <h2>Explore</h2>
    <!-- Search bar -->
    <div class="search-bar">
        <form action="explore.php" method="post">
            <input type="text" name="search_query" placeholder="Search for posts or users..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (empty($search_query)): ?>
        <!-- Display new posts when search is blank -->
        <h3>New Posts</h3>
        <?php while ($post = $result_new_posts->fetch_assoc()): ?>
            <?php include '../templates/post.php'; ?>
        <?php endwhile; ?>

        <!-- Display new users when search is blank -->
        <h3>New Users</h3>
        <?php while ($user = $result_new_users->fetch_assoc()): ?>
            <div class="user">
                <h4><a href="user_profile.php?user_id=<?php echo $user['user_id']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></h4>
                <form class="follow-form" data-user-id="<?php echo $user['user_id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <?php if (is_following($current_user_id, $user['user_id'], $conn)): ?>
                        <button type="submit" name="action" value="unfollow">Unfollow</button>
                    <?php else: ?>
                        <button type="submit" name="action" value="follow">Follow</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <!-- Display search results for posts -->
        <h3>Search Results for Posts</h3>
        <?php while ($post = $result_search_posts->fetch_assoc()): ?>
            <?php include '../templates/post.php'; ?>
        <?php endwhile; ?>

        <!-- Display search results for users -->
        <h3>Search Results for Users</h3>
        <?php while ($user = $result_search_users->fetch_assoc()): ?>
            <div class="user">
                <h4><a href="user_profile.php?user_id=<?php echo $user['user_id']; ?>"><?php echo htmlspecialchars($user['username']); ?></a></h4>
                <form class="follow-form" data-user-id="<?php echo $user['user_id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                    <?php if (is_following($current_user_id, $user['user_id'], $conn)): ?>
                        <button type="submit" name="action" value="unfollow">Unfollow</button>
                    <?php else: ?>
                        <button type="submit" name="action" value="follow">Follow</button>
                    <?php endif; ?>
                </form>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php 
include '../templates/footer.php'; 
$conn->close();
?>
