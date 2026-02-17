<?php

include 'includes/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'includes/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>about us</h3>
   <p><a href="home.php">Home</a> <span> / About</span></p>
</div>

<!-- about section starts  -->

<section class="about">

   <div class="row">

      <div class="image">
         <img src="images/about-us.avif" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>At Essenza Lux, we are devoted to the art of fragrance, offering an exclusive collection of perfumes that embody elegance, sophistication, and timeless beauty. Every essence we craft is a reflection of our passion for luxury and detail, designed to awaken the senses and leave a lasting impression. Our commitment to quality ensures that each fragrance is made from the finest ingredients, sourced from trusted, world-renowned suppliers. When you choose Essenza Lux, you’re not just selecting a perfume—you’re embracing an experience that speaks to your individuality and style. We believe that scent is personal, which is why every bottle is thoughtfully curated to reflect depth, character, and charm. With a seamless shopping experience, exceptional customer care, and beautifully designed packaging, we go beyond the ordinary to make your journey with us unforgettable. Choose Essenza Lux—where every scent tells a story, and every story begins with you.

</p>
         <a href="menu.php" class="btn">our products</a>
      </div>

   </div>

</section>

<!-- steps section starts  -->

<section class="steps">

   <h1 class="title">simple steps</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/bag.gif" alt="">
         <h3>choose order</h3>
         <p>Experience the excellence of our service.</p>
      </div>

      <div class="box">
         <img src="images/delivery-truck.gif" alt="">
         <h3>fast delivery</h3>
         <p>Choose convenience with our fast delivery.</p>
      </div>

      <div class="box">
         <img src="images/people.gif" alt="">
         <h3>enjoy our servie</h3>
         <p>Enjoy the ease of ordering from us.</p>
      </div>

   </div>

</section>

<!-- reviews section starts  -->
<section class="reviews">

   <h1 class="title">customer's reivews</h1>

   <div class="swiper reviews-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <img src="images/personaaa73c.jpg" alt="">
            <p>Essenza Lux exceeded my expectations! The fragrance I received was absolutely divine elegant, long-lasting, and truly luxurious.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Tiana Williams</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/customer-review.webp" alt="">
            <p>Essenza Lux تعرّف المعنى الحقيقي للفخامة. كل عطر يروي قصة متقنة. وخدمة العملاء كانت مثالية، مما جعل التجربة كاملة من كل النواحي</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Sofia H.</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/4e0938008a4d985402b315d69595add6.jpg" alt="">
            <p>Essenza Lux m’a complètement charmée. Le parfum que j’ai choisi est à la fois élégant et intense, sans jamais être envahissant. Il tient toute la journée et me donne un vrai sentiment de confiance.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>David Brown</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/lamia.jpg" alt="">
            <p>What a delightful experience! Shopping at Essenza Lux felt like stepping into a world of elegance and charm. "</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Joseph </h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/hmad.jpg" alt="">
            <p> I’m absolutely in love with Essenza Lux perfumes. The fragrance transports me it’s luxurious, sensual, and long-lasting. Plus, the customer service was incredibly professional and friendly. Highly recommended!</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>hannibal lecter</h3>
         </div>

         <div class="swiper-slide slide">
            <img src="images/koyute.jpg" alt="">
            <p>에센자 럭스에 완전히 매료되었습니다. 제가 선택한 향수는 우아하면서도 강렬하지만 부담스럽지 않았어요. 하루 종일 지속되며 자신감을 높여줍니다.</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Ji-woo</h3>
         </div>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<!-- footer section starts  -->
<?php include 'includes/footer.php'; ?>
<!-- footer section ends -->

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   grabCursor: true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
      slidesPerView: 1,
      },
      700: {
      slidesPerView: 2,
      },
      1024: {
      slidesPerView: 3,
      },
   },
});

</script>

<!-- Scroll to Top Button -->
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