<?php
include 'includes/connect.php';

$min_price = isset($_POST['min_price']) ? $_POST['min_price'] : null;
$max_price = isset($_POST['max_price']) ? $_POST['max_price'] : null;
$category = isset($_POST['category']) ? $_POST['category'] : null;

// Base query
$sql = "SELECT * FROM products WHERE 1";
$params = [];

// Add category filter
if ($category && $category !== 'all') {
    $sql .= " AND category = :category";
    $params[':category'] = $category;
}

// Add price filter
if ($min_price !== null && $max_price !== null) {
    $sql .= " AND price BETWEEN :min_price AND :max_price";
    $params[':min_price'] = $min_price;
    $params[':max_price'] = $max_price;
}

$stmt = $conn->prepare($sql);
$stmt->execute($params);

if ($stmt->rowCount() > 0) {
    while ($fetch_products = $stmt->fetch(PDO::FETCH_ASSOC)) {
        include 'includes/product_box.php';
    }
} else {
    echo '<p class="empty">Aucun produit trouvé avec les filtres sélectionnés.</p>';
}
?>
