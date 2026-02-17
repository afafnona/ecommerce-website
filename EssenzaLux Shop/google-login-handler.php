<?php
include 'includes/connect.php'; 
session_start();

if (isset($_POST['credential'])) {
    $id_token = $_POST['credential'];

    $payload = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $id_token)[1]))), true);

    $email = $payload['email'] ?? null;
    $name = $payload['name'] ?? null;
    $picture = $payload['picture'] ?? null;

    if ($email && $name) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $_SESSION['user_id'] = $user['id'];
        } else {
            $insert = $conn->prepare("INSERT INTO users (name, email, number, password) VALUES (?, ?, ?, ?)");
            $default_password = password_hash('default_password', PASSWORD_DEFAULT); 
            $insert->execute([$name, $email, '', $default_password]);
            $user_id = $conn->lastInsertId();
            $_SESSION['user_id'] = $user_id;
        }
        header('Location: profile.php');
        exit;
    } else {
        echo "Login failed: missing email or name.";
    }
} else {
    echo "No ID token received.";
}
?>
