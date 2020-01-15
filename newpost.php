<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}

?>

<div class="form post">
    <h1>New post</h1>
    <p class="error"> <?php displayError(); ?> </p>
    <p class="message"> <?php displayMessage(); ?> </p>

    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="image"><h2>Choose an image:</h2></label>
            <input class="choose-image" type="file" accept=".png, .jpg, .jpeg, .gif" name="image" id="image" required>
        </div>

        <div class="form-group">
            <label for="content"><h2>Description:</h2></label>
            <textarea class="description" name="content" id="content" maxlength="200" required></textarea>
        </div>

        <button class="purple-btn" type="submit">Upload</button>
    </form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
