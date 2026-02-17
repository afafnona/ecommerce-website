<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\EssenzaLux Shop');

include '../includes/connect.php';

session_start();

if(!isset($_SESSION['admin_id'])){
   header('location:home.php');
   exit;
}

$user_id = $_SESSION['admin_id'];

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);

   if(!empty($name)){
      $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
      $update_name->execute([$name, $user_id]);
   }

   if(!empty($email)){
      $update_email = $conn->prepare("UPDATE `admin` SET email = ? WHERE id = ?");
      $update_email->execute([$email, $user_id]);
   }

   if(!empty($number)){
      $update_number = $conn->prepare("UPDATE `admin` SET number = ? WHERE id = ?");
      $update_number->execute([$number, $user_id]);
   }
   
   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $select_prev_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
   $select_prev_pass->execute([$user_id]);
   $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
   $prev_pass = $fetch_prev_pass['password'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass != $empty_pass){
      if($old_pass != $prev_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'password updated successfully!';
         }else{
            $message[] = 'please enter a new password!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   
<!-- Header section starts  -->
<?php include 'includes/admin_header.php'; ?>
<!-- Header section ends -->

<section class="form-container update-form">

   <form action="" method="post">
      <h3>Update Profile</h3>
      <input type="text" name="name" placeholder="Name" class="box" maxlength="50">
      <input type="email" name="email" placeholder="Email" class="box" maxlength="50">
      <input type="number" name="number" placeholder="Number" class="box" min="0" max="9999999999" maxlength="10">
      <input type="password" name="old_pass" placeholder="Enter your old password" class="box" maxlength="50">
      <input type="password" name="new_pass" placeholder="Enter your new password" class="box" maxlength="50">
      <input type="password" name="confirm_pass" placeholder="Confirm your new password" class="box" maxlength="50">
      <input type="submit" value="Update Now" name="submit" class="btn">
   </form>

</section>

<?php include 'includes/footer.php'; ?>

<!-- Custom JavaScript file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
