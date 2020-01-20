<?php

require __DIR__ . '/views/header.php';

// If you're not logged in you'll be redirected
if (!loggedIn()) {
    redirect('/');
}
?>





<?php require __DIR__.'/views/footer.php'; ?>