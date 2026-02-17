<?php
include 'includes/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:home.php');
   exit;
}

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->execute([$user_id]);
$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submit'])) {
   if (!empty($_FILES['profile_image']['name'])) {
      $image = $_FILES['profile_image']['name'];
      $image_tmp_name = $_FILES['profile_image']['tmp_name'];
      $image_folder = 'user_images/' . $image;
      move_uploaded_file($image_tmp_name, $image_folder);

      $update_image = $conn->prepare("UPDATE `users` SET profile_image = ? WHERE id = ?");
      $update_image->execute([$image, $user_id]);
   }

   $name = htmlspecialchars(strip_tags($_POST['name']));
   $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
   $number = preg_replace('/[^0-9]/', '', $_POST['number']);

   if (!empty($name)) {
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if (!empty($email)) {
      $select_email = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND id != ?");
      $select_email->execute([$email, $user_id]);
      if ($select_email->rowCount() > 0) {
         $message[] = 'email already taken!';
      } else {
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
      }
   }

   if (!empty($number)) {
      $select_number = $conn->prepare("SELECT * FROM `users` WHERE number = ? AND id != ?");
      $select_number->execute([$number, $user_id]);
      if ($select_number->rowCount() > 0) {
         $message[] = 'number already taken!';
      } else {
         $update_number = $conn->prepare("UPDATE `users` SET number = ? WHERE id = ?");
         $update_number->execute([$number, $user_id]);
      }
   }

   $old_pass = $_POST['old_pass'];
   $new_pass = $_POST['new_pass'];
   $confirm_pass = $_POST['confirm_pass'];

   if (!empty($old_pass) || !empty($new_pass) || !empty($confirm_pass)) {
      $select_pass = $conn->prepare("SELECT password FROM `users` WHERE id = ?");
      $select_pass->execute([$user_id]);
      $fetch_pass = $select_pass->fetch(PDO::FETCH_ASSOC);

      if (!password_verify($old_pass, $fetch_pass['password'])) {
         $message[] = 'old password not matched!';
      } elseif ($new_pass !== $confirm_pass) {
         $message[] = 'confirm password not matched!';
      } else {
         if (!empty($new_pass)) {
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $update_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
            $update_pass->execute([$hashed_pass, $user_id]);
            $message[] = 'password updated successfully!';
         } else {
            $message[] = 'please enter a new password!';
         }
      }
   }
   header('Location: profile.php');
   exit;
}

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

<section class="form-container update-form">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>update profile</h3>
      <?php
if (!empty($message)) {
   foreach ($message as $msg) {
      echo '<div class="message">' . htmlspecialchars($msg) . '</div>';
   }
}
?>

      <input type="text" name="name" placeholder="<?= htmlspecialchars($fetch_profile['name']) ?>" class="box" maxlength="50">
      <input type="email" name="email" placeholder="<?= htmlspecialchars($fetch_profile['email']) ?>" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="number" name="number" placeholder="<?= htmlspecialchars($fetch_profile['number']) ?>" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="old_pass" placeholder="enter your old password" class="box" maxlength="50">
      <input type="password" name="new_pass" placeholder="enter your new password" class="box" maxlength="50">
      <input type="password" name="confirm_pass" placeholder="confirm your new password" class="box" maxlength="50">
      <label for="profile_image" class="custom-file-upload box">
      <i class="fas fa-upload"></i> Choisir une image
      </label>
      <input id="profile_image" type="file" name="profile_image" accept="image/*" style="display: none;">
      <input type="submit" value="update now" name="submit" class="btn">
   </form>
</section>

<?php include 'includes/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>
