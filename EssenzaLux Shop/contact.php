<?php
include 'includes/connect.php';
session_start();

$user_id = $_SESSION['user_id'] ?? '';

if (isset($_POST['send'])) {
   $name = htmlspecialchars(filter_var($_POST['name'], FILTER_UNSAFE_RAW), ENT_QUOTES, 'UTF-8');
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$number = htmlspecialchars(filter_var($_POST['number'], FILTER_UNSAFE_RAW), ENT_QUOTES, 'UTF-8');
$msg = htmlspecialchars(filter_var($_POST['msg'], FILTER_UNSAFE_RAW), ENT_QUOTES, 'UTF-8');

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if ($select_message->rowCount() > 0) {
      $message[] = 'Message already sent!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);
      $message[] = 'Message sent successfully!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EssenzaLux Shop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>

      .contact .row {
         display: flex;
         flex-wrap: wrap;
         align-items: center;
         justify-content: center;
         gap: 2rem;
         padding: 2rem;
      }
      .contact .row .image img {
         max-width: 100%;
         border-radius: 12px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }
      .contact .row form {
         flex: 1 1 400px;
         background: #fff;
         padding: 2rem;
         border-radius: 12px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }
      .contact .row form h3 {
         margin-bottom: 1rem;
         color: #333;
         font-size: 2.5rem;
      }
      .contact .row form .box, 
      .contact .row form textarea {
         width: 100%;
         padding: 1rem;
         margin: 0.7rem 0;
         border: 1px solid #ccc;
         border-radius: 8px;
         background: #f9f9f9;
      }
      .contact .row form .btn {
         background-color: #bfa17f; 
         color: #fff;
         padding: 1rem 2rem;
         border: none;
         border-radius: 8px;
         font-size: 1.2rem;
         cursor: pointer;
         margin-top: 1rem;
         transition: background 0.3s;
      }
      .contact .row form .btn:hover {
         background-color: #a4886b;
      }

      /* Responsive */
      @media (max-width: 768px) {
         .contact .row {
            flex-direction: column;
         }
         .contact .row .image, 
         .contact .row form {
            width: 100%;
         }
      }

      .alert {
   background-color: #d4edda;
   color: #155724;
   padding: 10px 15px;
   border: 1px solid #c3e6cb;
   border-radius: 8px;
   margin: 20px auto;
   font-size: 1.1rem;
   width: 90%;
   max-width: 600px;
   text-align: center;
}


   </style>
</head>
<body>

<?php include 'includes/user_header.php'; ?>

<div class="heading">
   <h3>Contact Us</h3>
   <p><a href="home.php">Home</a> <span>/ Contact</span></p>
</div>
<?php
if (!empty($message)) {
   foreach ($message as $msg) {
      echo '<div class="alert">'.$msg.'</div>';
   }
}
?>
<section class="contact">
   <div class="row">

      <div class="image">
         <img src="images/favicon.jpg" alt="Contact Image">
      </div>

      <form action="" method="post">
         <h3>We'd love to hear from you!</h3>
         <input type="text" name="name" class="box" placeholder="Your Name" maxlength="50" required>
         <input type="tel" name="number" class="box" placeholder="Phone Number" pattern="[0-9]{10}" required>
         <input type="email" name="email" class="box" placeholder="Your Email" maxlength="50" required>
         <textarea name="msg" class="box" placeholder="Your Message" maxlength="500" rows="6" required></textarea>
         <input type="submit" value="Send Message" name="send" class="btn">
      </form>

   </div>
</section>

<?php include 'includes/footer.php'; ?>

<script>
   setTimeout(() => {
      const alert = document.querySelector('.alert');
      if (alert) {
         alert.remove();
      }
   }, 5000);
</script>

<script src="js/script.js"></script>
</body>
</html>
