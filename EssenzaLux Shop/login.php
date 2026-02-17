<?php
include 'includes/connect.php';
session_start();
ob_start();

function redirectMsg($type, $text, $show_signup = false) {
    $_SESSION['message'] = ['type' => $type, 'text' => $text];
    if ($show_signup) $_SESSION['show_signup'] = true;
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pass = $_POST['pass'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: home.php');
        exit;
    } else {
        redirectMsg('error', 'Incorrect email or password.');
    }
}

if (isset($_POST['ok'])) {
    $name = htmlspecialchars($_POST['name2']);
    $email = filter_var($_POST['email2'], FILTER_SANITIZE_EMAIL);
    $number = htmlspecialchars($_POST['number2']);
    $pass = $_POST['pass2'] ?? '';
    $cpass = $_POST['cpass'] ?? '';

    if ($pass !== $cpass) {
        redirectMsg('error', 'Passwords do not match.', true);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount()) {
        redirectMsg('error', 'Email already exists.', true);
    }

    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $insert = $conn->prepare("INSERT INTO users (name, email, number, password) VALUES (?, ?, ?, ?)");
    $insert->execute([$name, $email, $number, $hashed_pass]);

    redirectMsg('success', 'Account created! You can now log in.');
}

ob_end_flush();
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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
.login-google-container {
    text-align: center;
    padding: 20px 0;
}
</style>
<style>
.google-login-button {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
</style>


</head>

<body>
<!-- header section starts  -->
<?php include 'includes/user_header.php'; ?>
<!-- header section ends -->
<div class="corps">
<?php if (isset($_SESSION['message'])): ?>
    <script>
        window.addEventListener("DOMContentLoaded", () => {
            const message = <?= json_encode($_SESSION['message']['text']) ?>;
            const type = <?= json_encode($_SESSION['message']['type']) ?>;

            showAlert(message, type);
        });
    </script>
    <?php unset($_SESSION['message']); ?>
<?php endif; ?>

<div class="container-l" id="container">
        <div class="form-container-l sign-up">
        <form method="post" action="">
                <h1>Create Account</h1>
                <div class="login-google-container">
    <div id="g_id_onload"
         data-client_id="528733963744-h3pfoj7n063l4egj0p772jugq1h1p3je.apps.googleusercontent.com"
         data-context="signin"
         data-ux_mode="popup"
         data-login_uri="http://localhost:8086/EssenzaLux Shop/google-login-handler.php"
         data-auto_prompt="false">
    </div>

    <div class="g_id_signin"
         data-type="standard"
         data-shape="pill"
         data-theme="outline"
         data-text="continue_with"
         data-size="large"
         data-logo_alignment="left">
    </div>
</div>
<script src="https://accounts.google.com/gsi/client?hl=en" async defer></script>

                <span>or use your email for registeration</span>
                <input type="text" name="name2" placeholder="Name">
                <input type="tel" name="number2" placeholder="Number">
                <input type="email" name="email2" placeholder="Email">
                <input type="password" name="pass2" placeholder="Password">
                <input type="password" name="cpass" placeholder="Confirm your password">
                <button type="submit" name="ok">Sign Up</button>

            </form>
        </div>
        <div class="form-container-l sign-in">
            <form method="post" action="">
                <h1>Sign In</h1>
                <div class="google-login-button">
    <div id="g_id_onload"
         data-client_id="528733963744-h3pfoj7n063l4egj0p772jugq1h1p3je.apps.googleusercontent.com"
         data-context="signin"
         data-ux_mode="popup"
         data-login_uri="http://localhost:8086/EssenzaLux Shop/google-login-handler.php"
         data-auto_prompt="false"
         data-locale="en">
    </div>

    <div class="g_id_signin"
         data-type="standard"
         data-shape="pill"
         data-theme="outline"
         data-text="continue_with"
         data-size="large"
         data-logo_alignment="center">
    </div>
</div>

                <span>or use your email password</span>
                <input  name="email" type="email" placeholder="Email">
                <input name="pass" type="password" placeholder="Password">
                <a href="javascript:void(0);" onclick="document.getElementById('container').classList.add('active');">Don't Have an Account?</a>
                <button type="submit" name="submit">Sign In</button>

            </form>
        </div>
        <div class="toggle-container-l">
            <div class="toggle-l">
                <div class="toggle-l-panel toggle-l-left login-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden-l" id="login">Sign In</button>
                </div>
                <div class="toggle-l-panel toggle-l-right">
                    <h1>Hello, Friend!</h1><br><br>
                    <button class="hidden-l" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
      container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
      container.classList.remove("active");
    });
  });
</script>

<script>
function showAlert(message, type = 'info') {
    const alertBox = document.createElement('div');
    alertBox.className = `custom-alert ${type}`;
    alertBox.innerText = message;

    Object.assign(alertBox.style, {
        position: 'fixed',
        top: '20px',
        left: '50%',
        transform: 'translateX(-50%)',
        backgroundColor: type === 'error' ? '#ff4d4d' : '#4BB543',
        color: 'white',
        padding: '15px 25px',
        borderRadius: '8px',
        zIndex: 9999,
        boxShadow: '0 2px 10px rgba(0,0,0,0.2)',
        fontSize: '16px',
        transition: 'opacity 0.5s ease-in-out',
    });

    document.body.appendChild(alertBox);

    setTimeout(() => {
        alertBox.style.opacity = '0';
        setTimeout(() => alertBox.remove(), 500);
    }, 3000);
}
</script>
<!--footer secsion-->
<footer class="footer">
   <div class="credit">&copy; created <?= date('Y'); ?> by <span> </span>^_^</div>
</footer>

<script>
  window.addEventListener("DOMContentLoaded", () => {
    <?php if (!empty($_SESSION['show_signup'])): ?>
      document.getElementById("container")?.classList.add("active");
      <?php unset($_SESSION['show_signup']); ?>
    <?php endif; ?>
  });
</script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
