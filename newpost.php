<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

?>

<article>
    <h1>New post</h1>

    <p class="error"> <?php displayError(); ?> </p>
    <p class="message"> <?php displayMessage(); ?> </p>

    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">

        <h2>Choose image</h2>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" accept=".png, .jpg, .jpeg, .gif" name="image" id="image">
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
