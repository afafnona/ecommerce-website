<?php
include 'includes/connect.php';
use Dompdf\Dompdf;
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   header('location:home.php');
   exit;
}

if (isset($_POST['submit'])) {

   $name = htmlspecialchars(trim($_POST['name']));
   $number = htmlspecialchars(trim($_POST['number']));
   $email = htmlspecialchars(trim($_POST['email']));
   $method = htmlspecialchars(trim($_POST['method']));
   $address = htmlspecialchars(trim($_POST['address']));
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Vérifier que le panier n'est pas vide
   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if ($check_cart->rowCount() > 0) {

      if ($address == '') {
         $message[] = 'Please enter your address before placing an order.';
      } else {
         // Insertion dans la table orders
         $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $order_id = $conn->lastInsertId();

         $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart_items->execute([$user_id]);

         while ($cart_item = $select_cart_items->fetch(PDO::FETCH_ASSOC)) {
            $product_id = $cart_item['pid'];
            $quantity = $cart_item['quantity'];

            $insert_item = $conn->prepare("INSERT INTO `order_items` (order_id, product_id, quantity) VALUES (?, ?, ?)");
            $insert_item->execute([$order_id, $product_id, $quantity]);
         }

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'Order placed successfully!';
         $show_success_alert = true;

         // Inclure Dompdf
         require_once 'dompdf/autoload.inc.php';

         // Créer une instance Dompdf
         $dompdf = new Dompdf();
         $dompdf->set_option('isHtml5ParserEnabled', true);
         $dompdf->set_option('isRemoteEnabled', true);

         $select_order_items = $conn->prepare("
            SELECT oi.quantity, p.name, p.price 
            FROM order_items oi 
            JOIN products p ON oi.product_id = p.id 
            WHERE oi.order_id = ?
         ");
         $select_order_items->execute([$order_id]);

         $order_rows = '';
         $total = 0;
         while ($item = $select_order_items->fetch(PDO::FETCH_ASSOC)) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            $order_rows .= "<tr>
                              <td>{$item['name']}</td>
                              <td>{$item['quantity']}</td>
                              <td>DH {$item['price']}</td>
                              <td>DH " . number_format($subtotal, 2) . "</td>
                           </tr>";
         }

         $html = "
            <h2 style='text-align:center;'>EssenzaLux - Order Receipt</h2>
            <hr>
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Phone:</strong> " . htmlspecialchars($number) . "</p>
            <p><strong>Address:</strong> " . htmlspecialchars($address) . "</p>
            <p><strong>Payment Method:</strong> " . htmlspecialchars($method) . "</p>
            <hr>
            <h3>Order Details</h3>
            <table width='100%' border='1' cellspacing='0' cellpadding='5'>
               <thead>
                  <tr>
                     <th>Product</th>
                     <th>Quantity</th>
                     <th>Unit Price</th>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  {$order_rows}
                  <tr>
                     <td colspan='3'><strong>Total</strong></td>
                     <td><strong>DH " . number_format($total, 2) . "</strong></td>
                  </tr>
               </tbody>
            </table>
            <p style='text-align:center;'>Thank you for shopping with us!</p>
         ";

         $dompdf->loadHtml($html);
         $dompdf->setPaper('A4', 'portrait');
         $dompdf->render();

         // Option 1: enregistrer sur serveur
         if (!is_dir('orders_pdf')) {
            mkdir('orders_pdf', 0777, true);
         }
         $pdf_file = 'orders_pdf/order_' . $order_id . '.pdf';
         file_put_contents($pdf_file, $dompdf->output());

         // Option 2: afficher directement le PDF dans le navigateur (décommenter pour activer)
         $dompdf->stream("order_{$order_id}.pdf", ["Attachment" => true]);

         exit; // STOPPER le script après le stream PDF

      }

   } else {
      $message[] = 'Your cart is empty.';
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>EssenzaLux Shop</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
   
   
   
   
   <link rel="stylesheet" href="css/style.css" />
   
</head>

<body>

   <?php include 'includes/user_header.php'; ?>

   <div class="heading">
      <h3>Checkout</h3>
      <p><a href="home.php">Home</a> <span> / Checkout</span></p>
   </div>

   <section class="checkout">

      <h1 class="title">Order Summary</h1>

      <form method="post">

         <div class="cart-items">
            <h3>Cart Items</h3>
            <?php
            $grand_total = 0;
            $cart_items = [];
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if ($select_cart->rowCount() > 0) {
               while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                  ?>
                  <p>
                     <span class="name"><?= htmlspecialchars($fetch_cart['name']); ?></span>
                     <span class="price">DH <?= htmlspecialchars($fetch_cart['price']); ?> x <?= htmlspecialchars($fetch_cart['quantity']); ?></span>
                  </p>
                  <?php
               }
            } else {
               echo '<p class="empty">Your cart is empty!</p>';
            }
            ?>
            <p class="grand-total"><span class="name">Grand Total :</span><span class="price">DH <?= $grand_total; ?></span></p>
            <a href="cart.php" class="btn">View Cart</a>
         </div>

         <input type="hidden" name="total_products" value="<?= htmlspecialchars(implode($cart_items)); ?>" />
         <input type="hidden" name="total_price" value="<?= htmlspecialchars($grand_total); ?>" />

         <?php
         $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

         <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_profile['name']); ?>" />
         <input type="hidden" name="number" value="<?= htmlspecialchars($fetch_profile['number']); ?>" />
         <input type="hidden" name="email" value="<?= htmlspecialchars($fetch_profile['email']); ?>" />
         <input type="hidden" name="address" value="<?= htmlspecialchars($fetch_profile['address']); ?>" />

         <div class="user-info">
            <h3>Your Info</h3>
            <p><i class="fas fa-user"></i><span><?= htmlspecialchars($fetch_profile['name']); ?></span></p>
            <p><i class="fas fa-phone"></i><span><?= htmlspecialchars($fetch_profile['number']); ?></span></p>
            <p><i class="fas fa-envelope"></i><span><?= htmlspecialchars($fetch_profile['email']); ?></span></p>
            <a href="update_profile.php" class="btn">Update Info</a>

            <h3>Delivery Address</h3>
            <p><i class="fas fa-map-marker-alt"></i><span>
                  <?php
                  if (empty($fetch_profile['address'])) {
                     echo 'Please enter your address';
                  } else {
                     echo htmlspecialchars($fetch_profile['address']);
                  }
                  ?>
               </span></p>
            <a href="update_address.php" class="btn">Update Address</a>

            <select name="method" class="box" required>
               <option value="credit card">Credit Card</option>
               <option value="Paypal">Paypal</option>
               <option value="cash on delivery">Cash on Delivery</option>
            </select>

            <input type="submit" value="Place Order" class="btn <?= empty($fetch_profile['address']) ? 'disabled' : '' ?>" style="width:100%; background:var(--red); color:black;" name="submit" />
         </div>

      </form>

   </section>

   <?php include 'includes/footer.php'; ?>

   <script src="js/script.js"></script>

   <?php if (isset($show_success_alert) && $show_success_alert): ?>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
      Swal.fire({
         title: 'Order Confirmed!',
         text: 'Your order has been placed successfully. Products will arrive within 5 hours.',
         icon: 'success',
         confirmButtonText: 'OK'
      });
   </script>
   <?php endif; ?>

</body>

</html>
