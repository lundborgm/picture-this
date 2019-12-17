<?php

require __DIR__.'/views/header.php';

$posts = getAllPosts();

?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Home page.</p>

    <?php if (isset($_SESSION['user'])): ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>

        <?php foreach ($posts as $post): ?>
        <article class="posts">
            <h2> <?php echo $post['title']; ?> </h2>
            <img class="post-image" src="<?php echo "uploads/".$post['image']; ?>" alt="">
            <p> <?php echo $post['content']; ?> </p>
            <small> <?php echo "Posted by: ".$post['name']; ?></small>
            <small> <?php echo "Published: ".$post['date']; ?></small>
        </article>
    <?php endforeach; ?>

    <?php endif; ?>
</article>

<?php require __DIR__.'/views/footer.php'; ?>
