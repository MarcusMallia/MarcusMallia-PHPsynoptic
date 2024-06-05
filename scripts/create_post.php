<?php 
session_start();
include '../templates/header.php'; 
include 'config.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to create a post.";
    include '../templates/footer.php';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $link = $_POST['link'];
    $tags = explode(',', $_POST['tags']);

    // Insert the new post into the database
    $sql = "INSERT INTO Posts (user_id, title, content, link) VALUES ('$user_id', '$title', '$content', '$link')";
    if ($conn->query($sql) === TRUE) {
        $post_id = $conn->insert_id;

        // Insert tags
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

        echo "New post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<main class="main-content">
    <h2>Create a New Post</h2>
    <form class="create-post-form" action="create_post.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea><br>
        <label for="link">Link:</label>
        <input type="text" id="link" name="link"><br>
        <label for="tags">Tags (comma separated):</label>
        <input type="text" id="tags" name="tags"><br>
        <input type="submit" value="Create Post">
    </form>
</main>

<?php include '../templates/footer.php'; ?>
