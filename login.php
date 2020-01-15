<?php require __DIR__.'/views/header.php'; ?>

<div class="form login">
    <h1>Picture This</h1>

    <form action="app/users/login.php" method="post">
        <div class="form-group">
            <!-- <label for="email">Email:</label> -->
            <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
        </div>

        <div class="form-group">
            <!-- <label for="password">Password:</label> -->
            <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <button class="purple-btn" type="submit">Login</button>
    </form>

    <div class="question">
        <h3>Don't have an account?</h3>
        <a href="signup.php"><button class="signup-btn">Sign up</button></a>
    </div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>
