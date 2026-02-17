<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();  
}
$user_id = $_SESSION['user_id'] ?? '';  
?>

<!-- Modification du menu de navigation dans votre header -->
<header class="header">
   <section class="flex">
      <a href="home.php" class="logo" style="font-size: 3.5rem">Essenza Lux</a>
      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <!-- Menu déroulant pour les parfums -->
         <div class="dropdown">
            <a href="#" class="dropdown-toggle">Parfums</a>
            <div class="dropdown-menu">
            <a href="http://localhost/EssenzaLux Shop/type.php?type=homme"class="dropdown-item">
                  <i class="fas fa-male"></i> men
               </a>
               <a href="http://localhost/EssenzaLux Shop/type.php?type=femme" class="dropdown-item">
                  <i class="fas fa-female"></i> women
               </a>
               <a href="http://localhost/EssenzaLux Shop/type.php?type=kids" class="dropdown-item">
                  <i class="fas fa-child"></i> kids
               </a>
            </div>
         </div>
         <a href="menu.php">Products</a>
         <a href="orders.php">Orders</a>
         <a href="contact.php">Contact</a>
      </nav>
      
      <div class="icons">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php" class="notification-icon"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      
      </div>
      
      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">Profile</a>
            <a href="logout.php" class="btn">Logout</a>
         </div>
         <p class="account">
            <a href="login.php">Login</a> or
            <a href="register.php">Register</a>
         </p>
          <?php
            }else{
         ?>
            <p class="name">Please Login First!</p>
            <a href="login.php" class="btn">User</a>
            <a href="admin/admin_login.php" class="btn">admin</a>
         <?php
          }
         ?>
      </div>
   </section>

   
   <script>
  let lastScroll = 0;
  const header = document.querySelector('.header');

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > lastScroll && currentScroll > 80) {

      header.style.transform = 'translateY(-100%)';
    } else {
      header.style.transform = 'translateY(0)';
    }

    lastScroll = currentScroll;
  });
</script>

</header>