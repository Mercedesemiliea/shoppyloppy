<?php
session_start();
include 'db.php'; 



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
   
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

   
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
   
    if (array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId] += $quantity; 
    } else {
        $_SESSION['cart'][$productId] = $quantity; 
    }

    header('Location: cart.php');
    exit();
}


$totalQuantity = 0;
$totalPrice = 0;
$cartItems = array();
foreach ($_SESSION['cart'] as $productId => $quantity) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($product) {
        $totalQuantity += $quantity;
        $totalPrice += $product['price'] * $quantity;
        $product['quantity'] = $quantity; 
        $cartItems[] = $product;
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Din Varukorg</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'header.php'; ?>
</head>
<body>
<?php include "navbar.php"; ?>
<div class="cart-background">
<div class="cart-container">
    <h2>Din Varukorg</h2>
    <p>Totalt antal produkter: <?= $totalQuantity ?></p>
    <p>Totalpris: <?= $totalPrice ?> kr</p>

    <?php if (empty($cartItems)): ?>
        <p>Din varukorg är tom.</p>
    <?php else: ?>
        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-item">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p><?= htmlspecialchars($item['description']) ?></p>
                    <form action="update_cart.php" method="post">
        <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
        <p>
             
            <button type="submit" name="decrease" value="true">-</button>
            <?= htmlspecialchars($item['quantity']) ?>
            <button type="submit" name="increase" value="true">+</button>
        </p>
                    <p>Antal: <?= htmlspecialchars($item['quantity']) ?></p>
                    <p>Pris: <?= htmlspecialchars($item['price']) ?> kr</p>
                </div>
            <?php endforeach; ?>
        </div>
</div>
            </div>
    <?php endif; ?>
    <?php include "footer.php"; ?>
</body>
</html>
