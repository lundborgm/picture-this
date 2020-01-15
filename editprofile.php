<?php

require __DIR__.'/views/header.php';

if (!loggedIn()) {
    redirect('/');
}

displayMessage();

displayError();

$user = getUserById($_SESSION['user']['id'], $pdo);
$avatar = $user['avatar_image'];
$biography = $user['biography'];

?>

<div class="form edit">
    <h1>Edit profile</h1>

    <form action="app/users/editprofile.php" method="post" enctype="multipart/form-data">
    <img class="avatar" src="<?php echo "uploads/avatar/".$avatar ?>" alt="">
        <div>
            <label for="avatar"><h2>Change avatar:</h2></label>
            <input class="choose-image" type="file" accept=".png, .jpg, .jpeg" name="avatar" id="avatar">
        </div>
        <button class="purple-btn" type="submit">Upload</button>
    </form>

    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="biography"><h2>Update biography:</h2></label>
            <textarea class="biography" name="biography" id="biography" maxlength="100"><?php echo $biography; ?></textarea>
        </div>
        <button class="purple-btn" type="submit">Save changes</button>
    </form>

    <form action="app/users/editprofile.php" method="post">
        <div class="form-group">
            <label for="email"><h2>Change email:</h2></label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>" required>
        </div>
        <button class="purple-btn" type="submit">Save changes</button>
    </form>

    <form action="app/users/changepassword.php" method="post">
        <h2>Change password</h2>
        <div class="form-group">
            <input class="form-control" type="password" name="old-password" id="old-password" placeholder="Old password" required>
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="new-password" id="new-password" placeholder="New password" required>
        </div>

        <div class="form-group">
            <input class="form-control" type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password" required>
        </div>
        <button class="purple-btn" type="submit">Save changes</button>
    </form>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
