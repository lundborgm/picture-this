<?php
require __DIR__ . '/views/header.php';

// If you're not logged in you'll be redirected
 if (!loggedIn()) {
    redirect('/');
}

$usrAmount = $_GET['usr'];
?>

<div class="users-search">

<?php for($i =0;$i < $usrAmount ; $i++ ): ?>
    <div class="search-box">
        <img class="search-avatar" src="" alt="profile image">
        <a class="visit-profile" href="<?php echo "visitprofile.php?id=" . 26; ?>">
            <h3></h3>
        </a> 
        </div>
<?php endfor;?>
</div>

<div class="posts-search">
</div>



<?php require __DIR__ . '/views/footer.php'; ?>