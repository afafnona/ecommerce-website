<?php
session_start();
include 'includes/connect.php';

if (!isset($_SESSION['user_id'])) {
   echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EssenzaLux Shop</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="heading">
            <h3>Login Required</h3>
            <p><a href="home.php">Home</a> <span> / Orders</span></p>
        </div>

        <section class="orders">
            <div class="box" style="text-align: center;">
                <p style="font-size: 1.2rem;">To view your orders, please log in to your account.</p>
                <a href="login.php" class="btn" style="margin-top: 1rem;">Login</a>
            </div>
        </section>

        <script src="js/script.js"></script>
    </body>
    </html>
   ';
   exit();
} else {
   $user_id = $_SESSION['user_id'];
}

$message = [];

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'Cart item deleted!';
}

if (isset($_POST['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   $message[] = 'Deleted all from cart!';
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = filter_var($_POST['qty'], FILTER_SANITIZE_NUMBER_INT);
   $qty = max(1, min(99, $qty)); // limit between 1 and 99
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'Cart quantity updated!';
}

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EssenzaLux Shop</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
 
</head>
<body>

<!-- header section starts -->
<?php include 'includes/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Shopping Cart</h3>
   <p><a href="home.php">Home</a> <span> / Cart</span></p>
</div>

<!-- Messages -->
<?php if (!empty($message)) : ?>
   <div class="messages">
      <?php foreach ($message as $msg) : ?>
         <div class="message"><?= htmlspecialchars($msg) ?></div>
      <?php endforeach; ?>
   </div>
<?php endif; ?>

<!-- shopping cart section starts -->
<section class="products">
   <h1 class="title">Your Cart</h1>
   <div class="box-container">
      <?php
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);

         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
               $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
               $grand_total += $sub_total;
      ?>
      
      <form action="" method="post" class="box">
<input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">

<div class="close-btn">
   <button type="submit" name="delete" onclick="return confirm('Delete this item?');">
      <i class="fas fa-times"></i>
   </button>
</div>



   <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>"><i class="fas fa-eye"></i></a>
   <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="<?= htmlspecialchars($fetch_cart['name']); ?>">
   <div class="name"><?= $fetch_cart['name']; ?></div>
   <div class="flex">
      <div class="price"><span></span><?= $fetch_cart['price']; ?>DH</div>
      <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
      <button type="submit" name="update_qty" class="fas fa-edit" title="Update Quantity"></button>
   </div>
   <div class="sub-total">Sub total : <span><?= $sub_total; ?>DH</span></div>
</form>
      <?php
            }
         } else {
            echo '<p class="empty">Your cart is empty.</p>';
         }
      ?>
   </div>

   <div class="cart-total">
      <p>Cart total : <span><?= $grand_total; ?>DH</span></p>
      <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
   </div>

   <div class="more-btn">
      <form action="" method="post">
         <button type="submit" class="delete-btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>" name="delete_all" onclick="return confirm('Delete all from cart?');">Delete All</button>
      </form>
      <a href="menu.php" class="btn">Continue Shopping</a>
   </div>
</section>

<!-- footer section starts -->
<?php include 'includes/footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>
<script>
   function confirmDelete() {
   return confirm("Voulez-vous vraiment supprimer cet article ?");
}
</script>

</body>
</html>
