<?php
if (isset($_POST['add_to_cart'])) {

    if ($user_id == '') {
        header('Location: login.php');
        exit();
    } else {

        $pid = htmlspecialchars(strip_tags($_POST['pid']));
        $name = htmlspecialchars(strip_tags($_POST['name']));
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); 
        $image = htmlspecialchars(strip_tags($_POST['image']));
        $qty = filter_var($_POST['qty'], FILTER_VALIDATE_INT); 

    
        if ($price === false || $price <= 0) {
            $message[] = 'Le prix n\'est pas valide.';
        }
        if ($qty === false || $qty <= 0) {
            $message[] = 'La quantité n\'est pas valide.';
        }
        if (empty($message)) {

            $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE pid = ? AND user_id = ?");
            $check_cart->execute([$pid, $user_id]);

            if ($check_cart->rowCount() > 0) {
                $update_qty = $conn->prepare("UPDATE `cart` SET quantity = quantity + ? WHERE pid = ? AND user_id = ?");
                $update_qty->execute([$qty, $pid, $user_id]);
                $message[] = 'Quantité mise à jour dans le panier !';
            } else {
                $insert_cart = $conn->prepare("INSERT INTO `cart` (user_id, pid, name, price, quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
                $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
                $message[] = 'Produit ajouté au panier !';
            }
        }
    }
}
?>
