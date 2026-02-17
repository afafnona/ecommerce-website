<?php

include 'includes/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'includes/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EssenzaLux Shop</title>

   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">


   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
 <style>* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
  overflow-x: hidden;
}
.background-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -2;
  pointer-events: none;
}
</style>
</head>
<body>

<?php include 'includes/user_header.php'; ?>



<section class="hero">
  <!-- Background Video -->
   
  <video   autoplay muted loop playsinline class="background-video">
    <source src="images/video1.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Dark overlay -->
  <div class="hero-overlay"></div>

  <!-- Hero Content -->
  <div class="hero-content" data-aos="fade-up" data-aos-delay="300">
    
    <!-- Subtitle -->
    <span class="hero-subtitle" data-aos="fade-down" data-aos-delay="100">
      Crafted with elegance. Inspired by you.
    </span>

    <!-- Heading with Typewriter Effect -->
    <h1 class="typewrite" data-period="2000" data-type='["Essenza Lux", "The Essence of Luxury", "Your Signature Scent"]'>
      <span class="wrap"></span>
    </h1>

    <!-- Description -->
    <p class="hero-description" data-aos="fade-up" data-aos-delay="600">
      A fragrance that defines who you are. Embrace elegance. Embrace your identity.
    </p>

    <!-- Call to Action Button -->
    <a href="menu.php" class="btn hero-btn" data-aos="zoom-in" data-aos-delay="900">
      Explore the Collection
    </a>
  </div>
</section>



<section class="category">

   <h1 class="title">fragrances category</h1>

   <div class="box-container">

<a href="http://localhost/EssenzaLux Shop/category.php?category=Chanel" class="box">
   <img src="https://uploads-ssl.webflow.com/60ed53b834cea373c275181a/60ed849b3be642a29997c8f5_chanel.png" alt="">
   
   
</a>

<a href="http://localhost/EssenzaLux Shop/category.php?category=Dior" class="box">
   <img src="https://th.bing.com/th/id/R.e66dc173c2985a5dc933c3d4bcc0e5bb?rik=uyaTbdzFxQsmew&riu=http%3a%2f%2ftlmagazine.com%2fwp-content%2fuploads%2f2015%2f08%2flogo-dior-e1441123266248.png&ehk=lpSjQtK%2fcM9dfzg4jnyZ6%2bjZlO%2bOnlSfDr3KuxMJ6pY%3d&risl=&pid=ImgRaw&r=0" alt="">
   
</a>

<a href="http://localhost/EssenzaLux Shop/category.php?category=Tom Ford" class="box">
   <img src="https://logos-world.net/wp-content/uploads/2020/12/Tom-Ford-Logo.png" alt="">

</a>

<a href="http://localhost/EssenzaLux Shop/category.php?category=ZARA" class="box">
   <img src="https://clipground.com/images/logo-zara-png-2.png" alt="">
  
</a>

</div>

</section>


<section class="products">

   <h3 class="title">Latest Parfums</h3>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
   <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

   <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
   <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

   <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
   <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>

   <div class="name"><?= $fetch_products['name']; ?></div>

   <div class="flex">
      <div class="price">
         <?= $fetch_products['price']; ?>DH
         <?php if (!empty($fetch_products['old_price']) && $fetch_products['old_price'] > $fetch_products['price']) { ?>
            <small class="old-price"><?= $fetch_products['old_price']; ?>DH</small>
            <span class="discount-badge">
               <i class="fas fa-star"></i>
               -<?= round((($fetch_products['old_price'] - $fetch_products['price']) / $fetch_products['old_price']) * 100) ?>%
            </span>
         <?php } ?>
      </div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
   </div>
</form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">View All</a>
   </div>

</section>

<?php include 'includes/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

<button id="scrollTopBtn" title="Go to top">
   <i class="fas fa-arrow-up"></i>
</button>

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  const scrollBtn = document.getElementById("scrollTopBtn");
  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    scrollBtn.classList.add("show");
  } else {
    scrollBtn.classList.remove("show");
  }
}

document.getElementById('scrollTopBtn').addEventListener('click', function(){
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
</script>
</body>
</html>