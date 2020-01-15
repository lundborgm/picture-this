<?php

require __DIR__.'/views/header.php';

if (!loggedIn()) {
    redirect('/');
}

$user = getUserById($_SESSION['user']['id'], $pdo);

$posts = editPost($_GET['id'], $pdo);

?>

<div class="form post">
    <h1>Edit post</h1>
    <p class="error"> <?php displayError(); ?> </p>
    <p class="message"> <?php displayMessage(); ?> </p>

    <?php foreach ($posts as $post): ?>
        <article class="posts">
            <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
            <p> <?php echo $post['content']; ?> </p>
        </article>
    <?php endforeach; ?>

    <form action="<?php echo "app/posts/update.php?id=".$post['id']."&author_id=".$post['author_id']; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image"><h2>Choose another image:</h2></label>
            <input class="choose-image" type="file" accept=".png, .jpg, .jpeg, .gif" name="image" id="image" required>
        </div>

        <div class="form-group">
            <label for="content"><h2>Update the description:</h2></label>
            <textarea class="description" class="form-control" name="content" id="content" maxlength="100" required></textarea>
        </div>
        <button class="purple-btn" type="submit">Save changes</button>
    </form>

    <form action="<?php echo "app/posts/delete.php?id=".$post['id']."&author_id=".$post['author_id']; ?>" method="post">
        <input type="hidden" name="post-image" value="<?php echo $post['image'] ?>">
        <button class="delete-post" type="submit">Delete post</button>
    </form>

</div>

<?php require __DIR__.'/views/footer.php'; ?>
