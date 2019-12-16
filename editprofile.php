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

$user = getUserById($_SESSION['user']['id']);
$avatar = $user['avatar_image'];
$biography = $user['biography'];

?>

<article>

    <h1>Edit profile</h1>
    <h2>Update avatar</h2>
    <img class="avatar" src="<?php echo "uploads/avatar/".$avatar ?>" alt="">
    <form action="app/users/editprofile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="avatar">Avatar:</label>
            <input type="file" accept=".png, .jpg, .jpeg" name="avatar" id="avatar">
            <small class="form-text text-muted">Update your avatar picture</small>
        </div>
        <button type="submit">Upload</button>
    </form>

    <h2>Update biography</h2>
    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="biography">Biography:</label>
            <textarea class="form-control" name="biography" id="biography" maxlength="100"><?php echo $biography; ?></textarea>
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
