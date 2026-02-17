<?php
include 'includes/connect.php';
session_start();

// Redirection si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
   ?>
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
   <?php
   exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Your Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/user_header.php'; ?>

<div class="heading">
   <h3>Your Orders</h3>
   <p><a href="home.php">Home</a> <span> / Orders</span></p>
</div>

<section class="orders">
   <h1 class="section-title">Your Orders</h1>
   <div class="orders-grid">
   <?php
   $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
   $select_orders->execute([$user_id]);

   if ($select_orders->rowCount() > 0) {
      while ($order = $select_orders->fetch(PDO::FETCH_ASSOC)) {
         $order_id = $order['id'];
   ?>
   <div class="order-card">
      <div class="order-header">
        <h3>🛍️ Order Details</h3>

         <span class="order-date"><?= htmlspecialchars($order['placed_on']); ?></span>
      </div>

      <div class="order-info">
         <p><strong>Client:</strong> <?= htmlspecialchars($order['name']); ?></p>
         <p><strong>Phone:</strong> <?= htmlspecialchars($order['number']); ?></p>
         <p><strong>Address:</strong> <?= htmlspecialchars($order['address']); ?></p>
         <p><strong>Total:</strong> <span class="price"><?= htmlspecialchars($order['total_price']); ?>DH</span></p>
         <p><strong>Status:</strong> 
            <span class="badge <?= $order['payment_status'] === 'pending' ? 'pending' : 'paid' ?>">
               <?= htmlspecialchars($order['payment_status']); ?>
            </span>
         </p>
      </div>

      <div class="product-list">
         <?php
         $select_items = $conn->prepare("
            SELECT p.name, p.image, oi.quantity 
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
         ");
         $select_items->execute([$order_id]);

         if ($select_items->rowCount() > 0) {
            while ($item = $select_items->fetch(PDO::FETCH_ASSOC)) {
         ?>
         <div class="product-item">
            <img src="uploaded_img/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
            <div class="product-details">
               <p><?= htmlspecialchars($item['name']); ?></p>
               <small>Quantity: <?= htmlspecialchars($item['quantity']); ?></small>
            </div>
         </div>
         <?php
            }
         } else {
            echo "<p class='no-products'>No products found.</p>";
         }
         ?>
      </div>
   </div>
   <?php
      }
   } else {
      echo '<p class="empty">You have no orders yet.</p>';
   }
   ?>
   </div>
</section>


<?php include 'includes/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
