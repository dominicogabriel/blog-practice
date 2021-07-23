<?php
require('config/config.php');
require('config/db.php');

// Create Query
$query = 'SELECT * FROM posts ORDER BY created_at DESC';

// Get Result
$result = mysqli_query($conn, $query);

// Fetch Data
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($posts);

// Free Result
mysqli_free_result($result);

// Close Conn
mysqli_close($conn);


?>


<?php include('inc/header.php'); ?>
<div class="container">
    <h1>Posts</h1>
    <?php foreach ($posts as $post) : ?>
        <div class="card bg-secondary mb-3" style="max-width: 50rem;">
            <div class="card-header"><?php echo $post['title']; ?></div>
            <small class="card-header">Created on <?php echo $post['created_at']; ?>
                by <?php echo $post['author']; ?>
            </small>
            <div class="card-body">
                <p class="card-text">
                    <?php echo $post['body']; ?>
                </p>
                <a class="btn btn-primary" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include('inc/footer.php'); ?>