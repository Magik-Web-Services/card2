<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category"></li>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo SITE_URL; ?>index.php">
        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <?php
    if ($_SESSION['role'] == 'admin') {
    ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo SITE_URL; ?>users/user.php">
          <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
          <span class="menu-title">Users</span>
        </a>
      </li>
    <?php
    }
    ?>
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?php echo SITE_URL; ?>cards/cards.php">
        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
        <span class="menu-title">Cards</span>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="icon-bg"><i class="mdi mdi-crosshairs-gps menu-icon"></i></span>
        <span class="menu-title">Cards</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          
          <?php
          // Cards
          $sql = "Select * from `card2_data`";
          $result = mysqli_query($conn, $sql);
          $cards = mysqli_num_rows($result);
          $row = mysqli_num_rows($result);
          $data = mysqli_fetch_assoc($result);

          for ($i = 0; $i < $row; $i++) {
            echo '<li class="nav-item"> <a class="nav-link" href="cards.php?id=' . $data['rand_str'] . '">Work'.$row.'</a></li>';
          }
          ?>
        </ul>
      </div>
    </li>
  </ul>
</nav>