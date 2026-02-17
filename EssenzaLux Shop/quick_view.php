<?php
include 'includes/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';

include 'includes/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>EssenzaLux Shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'includes/user_header.php'; ?>

<section class="quick-view">
   <h1 class="title">Quick View</h1>

   <?php
   $pid = $_GET['pid'];
   $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $select_products->execute([$pid]);

   if($select_products->rowCount() > 0){
      while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>

   <!-- 🔹 Affichage du produit sélectionné -->
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

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
<button type="submit" name="add_to_cart" class="cart-btn" id="addCartBtn">add to cart</button>

   </form>

   <!-- ✅ Produits similaires -->
   <section class="products">
      <h2 class="title">Nos recommandations</h2>
      <div class="box-container">
         <?php
         $product_category = $fetch_products['category'];
         $product_id = $fetch_products['id'];

         $select_similar = $conn->prepare("SELECT * FROM `products` WHERE category = ? AND id != ? LIMIT 3");
         $select_similar->execute([$product_category, $product_id]);

         if($select_similar->rowCount() > 0){
            while($similar_product = $select_similar->fetch(PDO::FETCH_ASSOC)){
         ?>
         <form action="" method="post" class="box">
            <input type="hidden" name="pid" value="<?= $similar_product['id']; ?>">
            <input type="hidden" name="name" value="<?= $similar_product['name']; ?>">
            <input type="hidden" name="price" value="<?= $similar_product['price']; ?>">
            <input type="hidden" name="image" value="<?= $similar_product['image']; ?>">

            <a href="quick_view.php?pid=<?= $similar_product['id']; ?>" class="fas fa-eye"></a>
            <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

            <img src="uploaded_img/<?= $similar_product['image']; ?>" alt="">
            <a href="category.php?category=<?= $similar_product['category']; ?>" class="cat"><?= $similar_product['category']; ?></a>

            <div class="name"><?= $similar_product['name']; ?></div>

            <div class="flex">
               <div class="price">
                  <?= $similar_product['price']; ?>DH
                  <?php if (!empty($similar_product['old_price']) && $similar_product['old_price'] > $similar_product['price']) { ?>
                     <small class="old-price"><?= $similar_product['old_price']; ?>DH</small>
                     <span class="discount-badge">
                        <i class="fas fa-star"></i>
                        -<?= round((($similar_product['old_price'] - $similar_product['price']) / $similar_product['old_price']) * 100) ?>%
                     </span>
                  <?php } ?>
               </div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
            </div>
         </form>
         <?php
            }
         } else {
            echo '<p class="empty">Aucun produit similaire trouvé.</p>';
         }
         ?>
      </div>
   </section>

   <?php
      }
   } else {
      echo '<p class="empty">Produit introuvable.</p>';
   }
   ?>
</section>

<?php include 'includes/footer.php'; ?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
