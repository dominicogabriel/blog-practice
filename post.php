<?php
require('config/config.php');
require('config/db.php');

if (isset($_POST['delete'])) {
    // Get Form Data
    // Get bodyData
    // Get authorData
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    $query = "DELETE FROM posts WHERE id = {$delete_id}";
    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . '');
    } else {
        echo 'ERROR: ' . mysqli_error($conn);
    }
}

// get ID
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Create Query
$query = 'SELECT * FROM posts WHERE id=' . $id;

// Get Result
$result = mysqli_query($conn, $query);

// Fetch Data
$post = mysqli_fetch_assoc($result);
// var_dump($posts);

// Free Result
mysqli_free_result($result);

// Close Conn
mysqli_close($conn);


?>


<?php include('inc/header.php'); ?>

<body>
    <div class="container">
        <h1>Posts</h1>

        <div class="card bg-secondary mb-3" style="max-width: 50rem;">
            <a href="<?php echo ROOT_URL; ?>" class="btn btn-primary">Back to post</a>
            <div class="card-header"><?php echo $post['title']; ?></div>
            <small class="card-header">Created on <?php echo $post['created_at']; ?>
                by <?php echo $post['author']; ?>
            </small>
            <div class="card-body">
                <p class="card-text">
                    <?php echo $post['body']; ?>
                </p>
                <hr>
                <form class="pull-right" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
                    <input type="submit" name="delete" value="Delete" class="btn btn-danger">
                </form>


                <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?> " class="btn btn-primary">Edit</a>
            </div>
        </div>

    </div>
    <?php include('inc/footer.php'); ?>