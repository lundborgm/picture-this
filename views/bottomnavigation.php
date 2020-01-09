

  <ul class="add-post">



    <?php if (isset($_SESSION['user'])): ?>
        <li><a class="plus-btn" href="newpost.php"><i class="fas fa-plus fa-2x"></i></a></li><!-- /nav-item -->
    <?php endif; ?>



    <?php if (isset($_SESSION['user'])): ?>
        <li><a  href="profile.php"><i class="fas fa-user fa-2x"></i></a></li><!-- /nav-item -->
    <?php endif; ?>



  </ul><!-- /navbar-nav -->




<!-- <div class="add-post">
    <button class="plus-btn"><i class="fas fa-plus fa-2x"></i></button>
    </div> -->
