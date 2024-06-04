<?php 
// Include the header template
include '../templates/header.php'; 
?>

<!-- Main content section -->
<main>
    <h2>Create Post</h2>
    <!-- Placeholder for create post form -->
    <div class="create-post-form">
        <form action="#" method="post">
            <label for="post-title">Post Title:</label>
            <input type="text" id="post-title" name="post-title" placeholder="Enter post title">
            
            <label for="post-content">Post Content:</label>
            <textarea id="post-content" name="post-content" placeholder="Write your post..."></textarea>
            
            <label for="post-link">Link:</label>
            <input type="url" id="post-link" name="post-link" placeholder="Enter URL (optional)">
            
            <label for="post-tags">Tags:</label>
            <input type="text" id="post-tags" name="post-tags" placeholder="Enter tags separated by commas">
            
            <button type="submit">Create Post</button>
        </form>
    </div>
</main>

<?php 
// Include the footer template
include '../templates/footer.php'; 
?>
