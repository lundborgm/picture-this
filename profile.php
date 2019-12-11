<?php

// If you're not logged in you'll be redirected
if (!isset($_SESSION['user'])) {
    redirect('/');
}

?>

<form action="app/users/update.php">
</form>
