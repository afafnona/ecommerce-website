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

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Slick Carousel CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      /* Banner Slider Styles */
      .banner-slider {
         width: 100%;
         margin: 0 auto 50px;
         position: relative;
         max-height: 500px;
         overflow: hidden;
         z-index: 1;
      }

      .banner-slider img {
         width: 100%;
         height: 500px;
         object-fit: cover;
         border-radius: 0;
      }

      /* Custom Arrows */
      .slick-prev, .slick-next {
         width: 50px;
         height: 50px;
         z-index: 10;
      }

      .slick-prev:before, .slick-next:before {
         color: gold;
         font-size: 30px;
         opacity: 1;
      }

      /* Center arrows vertically */
      .slick-prev {
         left: 15px;
      }

      .slick-next {
         right: 15px;
      }

      .slick-dots li button:before {
         color: gold;
         font-size: 12px;
      }

      .slick-dots li.slick-active button:before {
         color: #d4af37;
      }

      /* Add smooth fading */
      .slick-slider {
         transition: all 0.5s ease-in-out;
      }
   </style>
</head>
<body>

<?php include 'includes/user_header.php'; ?>

<!-- ✅ Banner Image Slider -->
<div class="banner-slider">
   <div><img src="https://www.notino.hu/fotocache/gallery/ba/7/HB%20The%20Scent%20Intense_1017_BP%20Banner_web.jpg" alt="Banner 1"></div>
   <div><img src="https://cdn.notinoimg.com/c=85/images/gallery/ba/4/PL_Dior_Homme23_Desktop_1035x340.jpg" alt="Banner 2"></div>
   <div><img src="images/j.jpg" alt="Banner 3"></div>
</div>

<!-- ✅ Product Section: Untouched -->
<section class="products">
   <h1 class="title">Parfums Category</h1>

   <div class="box-container">
      <?php
      $type = isset($_GET['type']) ? $_GET['type'] : '';

      $select_products = $conn->prepare("SELECT * FROM `products` WHERE `type` = ?");
      $select_products->execute([$type]);
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
      } else {
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>
</section>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Slick Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<!-- Initialize the Sliders -->
<script>
   $(document).ready(function(){
      // ✅ Banner Auto Slider with Arrows
      $('.banner-slider').slick({
         dots: true,
         infinite: true,
         autoplay: true,
         autoplaySpeed: 2200,
         arrows: true,
         fade: false,
         slidesToShow: 1,
         slidesToScroll: 1,
         pauseOnHover: false
      });
   });
</script>






















<?php include 'includes/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>


</body>
</html>