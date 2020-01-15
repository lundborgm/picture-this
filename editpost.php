<?php

require __DIR__.'/views/header.php';

if (!loggedIn()) {
    redirect('/');
}

$user = getUserById($_SESSION['user']['id'], $pdo);

$posts = editPost($_GET['id'], $pdo);

?>

<article>

    <p class="error"> <?php displayError(); ?> </p>
    <p class="message"> <?php displayMessage(); ?> </p>

    <?php foreach ($posts as $post): ?>
        <article class="posts">
            <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
            <p> <?php echo $post['content']; ?> </p>
            <small> <?php echo "Posted by: ".$user['name']; ?></small>
        </article>
    <?php endforeach; ?>

    <h1>Edit post</h1>
    <form action="<?php echo "app/posts/update.php?id=".$post['id']."&author_id=".$post['author_id']; ?>" method="post" enctype="multipart/form-data">
        <h2>Image</h2>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" accept=".png, .jpg, .jpeg, .gif" name="image" id="image" required>
        </div>
        <h2>Description</h2>
        <div class="form-group">
            <label for="content">Description:</label>
            <textarea class="form-control" name="content" id="content" maxlength="100" required></textarea>
        </div>
        <button type="submit">Save changes</button>
    </form>

    <form action="<?php echo "app/posts/delete.php?id=".$post['id']."&author_id=".$post['author_id']; ?>" method="post">
        <input type="hidden" name="post-image" value="<?php echo $post['image'] ?>">
        <button class="delete-post" type="submit">Delete post</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
