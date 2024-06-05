<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to update a post.";
    include '../templates/footer.php';
    exit();
}

if (!isset($_GET['post_id'])) {
    echo "No post ID provided.";
    include '../templates/footer.php';
    exit();
}

$post_id = $_GET['post_id'];

$sql_post = "SELECT * FROM Posts WHERE post_id = '$post_id' AND user_id = '".$_SESSION['user_id']."'";
$result_post = $conn->query($sql_post);

if ($result_post->num_rows > 0) {
    $post = $result_post->fetch_assoc();
} else {
    echo "Post not found or you don't have permission to update this post.";
    include '../templates.footer.php';
    exit();
}

$sql_tags = "SELECT tags.name FROM tags INNER JOIN post_tags ON tags.tag_id = post_tags.tag_id WHERE post_tags.post_id = '$post_id'";
$result_tags = $conn->query($sql_tags);
$current_tags = [];
while ($tag = $result_tags->fetch_assoc()) {
    $current_tags[] = $tag['name'];
}
$current_tags = implode(', ', $current_tags);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $link = $_POST['link'];
    $tags = explode(',', $_POST['tags']);

    $sql_update = "UPDATE Posts SET title='$title', content='$content', link='$link' WHERE post_id='$post_id'";
    if ($conn->query($sql_update) === TRUE) {
        // Update tags
        $sql_delete_post_tags = "DELETE FROM post_tags WHERE post_id='$post_id'";
        $conn->query($sql_delete_post_tags);

        foreach ($tags as $tag_name) {
            $tag_name = trim($tag_name);
            $sql_tag = "SELECT tag_id FROM tags WHERE name='$tag_name'";
            $result_tag = $conn->query($sql_tag);

            if ($result_tag->num_rows > 0) {
                $tag = $result_tag->fetch_assoc();
                $tag_id = $tag['tag_id'];
            } else {
                $sql_insert_tag = "INSERT INTO tags (name) VALUES ('$tag_name')";
                $conn->query($sql_insert_tag);
                $tag_id = $conn->insert_id;
            }

            $sql_post_tag = "INSERT INTO post_tags (post_id, tag_id) VALUES ('$post_id', '$tag_id')";
            $conn->query($sql_post_tag);
        }

        header("Location: post_details.php?post_id=$post_id");
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }

    $conn->close();
}
?>

<main class="main-content">
    <h2>Update Post</h2>
    <form action="update_post.php?post_id=<?php echo $post_id; ?>" method="post" class="post-form">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link" value="<?php echo htmlspecialchars($post['link']); ?>">
        </div>
        <div class="form-group">
            <label for="tags">Tags (comma separated):</label>
            <input type="text" id="tags" name="tags" value="<?php echo htmlspecialchars($current_tags); ?>">
        </div>
        <button type="submit">Update Post</button>
    </form>
</main>

<?php include '../templates/footer.php'; ?>
