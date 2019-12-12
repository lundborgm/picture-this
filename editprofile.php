<?php

require __DIR__.'/views/header.php';

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

    <h1>Edit profile</h1>
    <h2>Update biography</h2>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="biography">Biography:</label>
            <textarea class="form-control" name="biography" id="biography" maxlength="100"></textarea>
            <small class="form-text text-muted">Change your bio</small>
        </div><!-- /form-group -->

        <button type="submit">Save changes</button>
    </form>

    <h2>Change email</h2>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="email">New email:</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
            <small class="form-text text-muted">Change your email</small>
        </div><!-- /form-group -->

        <button type="submit">Save changes</button>
    </form>

    <h2>Change password</h2>
    <form action="app/users/changepassword.php" method="post">
    <div class="form-group">
        <label for="old-password">Old password:</label>
        <input class="form-control" type="password" name="old-password" id="old-password" required>
        <small class="form-text text-muted">Change your password</small>
    </div><!-- /form-group -->

    <div class="form-group">
        <label for="new-password">New password:</label>
        <input class="form-control" type="password" name="new-password" id="new-password" required>
        <small class="form-text text-muted">Change your password</small>
    </div><!-- /form-group -->

    <div class="form-group">
        <label for="confirm-password">Confirm password:</label>
        <input class="form-control" type="password" name="confirm-password" id="confirm-password" required>
        <small class="form-text text-muted">Change your password</small>
    </div><!-- /form-group -->

        <button type="submit">Save changes</button>
    </form>

</article>

<?php require __DIR__.'/views/footer.php'; ?>
