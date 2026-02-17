<?php
include 'includes/connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
   header('location:home.php');
   exit;
}

$user_id = $_SESSION['user_id'];

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);

if ($select_profile->rowCount() === 0) {
   header('location:home.php');
   exit;
}

$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

// Gérer image externe, image locale ou image par défaut
if (isset($fetch_profile['profile_image']) && trim($fetch_profile['profile_image']) !== '') {
   if (filter_var($fetch_profile['profile_image'], FILTER_VALIDATE_URL)) {
      $profile_image = $fetch_profile['profile_image']; // URL (Google login)
   } elseif (file_exists("user_images/" . $fetch_profile['profile_image'])) {
      $profile_image = "user_images/" . $fetch_profile['profile_image']; 
   } else {
      $profile_image = "user_images/default.jpg"; 
   }
} else {
   $profile_image = "user_images/default.jpg"; 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EssenzaLux Shop</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'includes/user_header.php'; ?>

<section class="user-details">
   <div class="user">
   <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile Picture">

      <p><i class="fas fa-user"></i><span><?= htmlspecialchars($fetch_profile['name']) ?></span></p>
      <p><i class="fas fa-phone"></i><span><?= htmlspecialchars($fetch_profile['number']) ?></span></p>
      <p><i class="fas fa-envelope"></i><span><?= htmlspecialchars($fetch_profile['email']) ?></span></p>

      <a href="update_profile.php" class="btn">Update Info</a>

      <p class="address">
         <i class="fas fa-map-marker-alt"></i>
         <span><?= empty($fetch_profile['address']) ? 'Please enter your address' : htmlspecialchars($fetch_profile['address']) ?></span>
      </p>

      <a href="update_address.php" class="btn">Update Address</a>
   </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
