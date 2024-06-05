<?php
// Ensure the database connection is available
if (!isset($conn)) {
    include $_SERVER['DOCUMENT_ROOT'].'/MarcusMallia-PHPsynoptic/scripts/config.php'; 
}

// Fetch the number of likes for the post
$sql_likes = "SELECT COUNT(*) as like_count FROM Likes WHERE post_id = '".$post['post_id']."'";
$result_likes = $conn->query($sql_likes);
$like_count = $result_likes->fetch_assoc()['like_count'];

// Fetch the number of comments for the post
$sql_comments = "SELECT COUNT(*) as comment_count FROM Comments WHERE post_id = '".$post['post_id']."'";
$result_comments = $conn->query($sql_comments);
$comment_count = $result_comments->fetch_assoc()['comment_count'];

// Check if the current user liked the post
$sql_user_like = "SELECT * FROM Likes WHERE user_id = '".$_SESSION['user_id']."' AND post_id = '".$post['post_id']."'";
$result_user_like = $conn->query($sql_user_like);
$is_liked = $result_user_like->num_rows > 0;
?>

<div class="post">
    <h3><a href="/MarcusMallia-PHPsynoptic/scripts/post_details.php?post_id=<?php echo $post['post_id']; ?>"><?php echo htmlspecialchars($post['title']); ?></a></h3>
    <p>By <a href="/MarcusMallia-PHPsynoptic/scripts/user_profile.php?user_id=<?php echo $post['user_id']; ?>">
        <?php echo isset($post['username']) ? htmlspecialchars($post['username']) : 'Unknown User'; ?></a></p>
    <p><?php echo htmlspecialchars($post['content']); ?></p>
    <?php if (!empty($post['link'])): ?>
        <p><a href="<?php echo htmlspecialchars($post['link']); ?>" target="_blank">Link</a></p>
    <?php endif; ?>
    <p>Tags: <?php echo htmlspecialchars($post['tags']); ?></p>
    <div class="post-actions">
        <form action="/MarcusMallia-PHPsynoptic/scripts/like_action.php" method="post" style="display:inline;">
            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
            <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
            <?php if ($is_liked): ?>
                <button type="submit" name="action" value="unlike">Unlike</button>
            <?php else: ?>
                <button type="submit" name="action" value="like">Like</button>
            <?php endif; ?>
        </form>
        <span><?php echo $like_count; ?> likes</span>
        <a href="/MarcusMallia-PHPsynoptic/scripts/post_details.php?post_id=<?php echo $post['post_id']; ?>"><button type="button">Comment</button></a>
        <span><?php echo $comment_count; ?> comments</span>
        <?php if ($_SESSION['user_id'] == $post['user_id']): ?>
            <a href="/MarcusMallia-PHPsynoptic/scripts/update_post.php?post_id=<?php echo $post['post_id']; ?>">Edit</a>
            <a href="/MarcusMallia-PHPsynoptic/scripts/delete_post.php?post_id=<?php echo $post['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
        <?php endif; ?>
    </div>
</div>
