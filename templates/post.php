<div class="post">
    <h3><a href="post_details.php?post_id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
    <p><?php echo htmlspecialchars($post['content']); ?></p>
    <?php if (!empty($post['link'])): ?>
        <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
    <?php endif; ?>
    <p>Tags: <?php echo htmlspecialchars($post['tags']); ?></p>
    <div class="post-actions">
        <button>Like</button>
        <button>Comment</button>
        <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
            <a href="update_post.php?post_id=<?php echo $post['post_id']; ?>">Edit</a>
            <a href="delete_post.php?post_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        <?php endif; ?>
    </div>
</div>
