<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!isset($_SESSION['user'])) {
    redirect('/');
}

if (isset($_SESSION['messages'])) {
    foreach ($_SESSION['messages'] as $message) {
        echo $message;

        unset($_SESSION['messages']);
    }
}

if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {
        echo $error;

        unset($_SESSION['errors']);
    }
}

?>

<article>
    <h1>New post</h1>

    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
        <h2>Title</h2>
        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <h2>Choose image</h2>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" accept=".png, .jpg, .jpeg" name="image" id="image">
        </div>

        <h2>Description</h2>
        <div class="form-group">
            <label for="content">Description:</label>
            <textarea class="form-control" name="content" id="content" maxlength="100"></textarea>
        </div>

        <button type="submit">Upload</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
