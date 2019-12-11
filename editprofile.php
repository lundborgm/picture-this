<?php

require __DIR__.'/views/header.php';

// die(var_dump($_SESSION['user']['id']));

?>

<article>
    <h1>Edit profile</h1>

    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <p><?php echo $_SESSION['user']['email']; ?></p>
            <label for="email">New email:</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="email@email.com">
            <small class="form-text text-muted">Change your email</small>
        </div><!-- /form-group -->
        <button type="submit">Save changes</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
