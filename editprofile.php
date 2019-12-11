<?php

require __DIR__.'/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('/');
}

?>

<article>

    <h1>Edit profile</h1>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="email">New email:</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
            <small class="form-text text-muted">Change your email</small>
        </div><!-- /form-group -->

        <button type="submit">Save changes</button>
    </form>

    <h1>Change password</h1>
    <form action="app/users/changepassword.php" method="post">
        <div class="form-group">
            <label for="password">New password:</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text text-muted">Change your password</small>
        </div><!-- /form-group -->

        <button type="submit">Save changes</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
