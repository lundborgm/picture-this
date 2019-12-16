<?php

require __DIR__.'/views/header.php';

// If you're not logged in you'll be redirected
if (!isset($_SESSION['user'])) {
    redirect('/');
}

$user = getUserById($_SESSION['user']['id']);
$avatar = $user['avatar_image'];
$biography = $user['biography'];

?>

<article>
    <h1>Profile</h1>
        <p>Hello, <?php echo $_SESSION['user']['name']; ?>. This is your profile.</p>
        <h2>Biography</h2>
        <p><?php echo $biography; ?></p>
        <img class="avatar" src="<?php echo "uploads/avatar/".$avatar ?>" alt="">

        <a href="editprofile.php"><button>Edit profile</button></a>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
