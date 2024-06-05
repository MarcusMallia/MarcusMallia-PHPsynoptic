<div class="post">
    <h3><?php echo htmlspecialchars($post['title']); ?></h3>
    <p><?php echo htmlspecialchars($post['content']); ?></p>
    <?php if (!empty($post['link'])): ?>
        <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
    <?php endif; ?>
    <p>Tags: <?php echo htmlspecialchars($post['tags']); ?></p>
    <div class="post-actions">
        <button>Like</button>
        <button>Comment</button>
    </div>
</div>
