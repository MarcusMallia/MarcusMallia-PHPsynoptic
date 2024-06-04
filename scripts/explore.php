<?php 
// Include the header template
include '../templates/header.php'; 
?>

<!-- Main content section -->
<main>
    <h2>Explore</h2>
    <!-- Search bar -->
    <div class="search-bar">
        <input type="text" placeholder="Search for posts or users...">
        <button>Search</button>
    </div>
    <!-- Placeholder for new posts -->
    <h3>New Posts</h3>
    <div class="post">
        <h3>Explore Post Title</h3>
        <p>Explore post content goes here...</p>
        <!-- Placeholder for like and comment buttons -->
        <div class="post-actions">
            <button>Like</button>
            <button>Comment</button>
        </div>
    </div>
    <div class="post">
        <h3>Explore Post Title</h3>
        <p>Explore post content goes here...</p>
        <div class="post-actions">
            <button>Like</button>
            <button>Comment</button>
        </div>
    </div>
    <!-- Placeholder for new users -->
    <h3>New Users</h3>
    <div class="user">
        <h4>User Name</h4>
        <button>Follow</button>
    </div>
    <div class="user">
        <h4>User Name</h4>
        <button>Follow</button>
    </div>
</main>

<?php 
// Include the footer template
include '../templates/footer.php'; 
?>
