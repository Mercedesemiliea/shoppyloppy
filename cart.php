<?php
session_start();
include 'db.php';



if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];


        if (isset($_POST['update_cart'])) {
            if (isset($_POST['decrease'])) {

                $_SESSION['cart'][$productId] -= 1;
                if ($_SESSION['cart'][$productId] < 1) {
                    unset($_SESSION['cart'][$productId]);
                }
            } elseif (isset($_POST['increase'])) {

                $_SESSION['cart'][$productId] += 1;
            }
        } elseif (isset($_POST['add_to_cart'])) {

            $quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

            if (array_key_exists($productId, $_SESSION['cart'])) {
                $_SESSION['cart'][$productId] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = $quantity;
            }
        }
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
    <div class="pokemon-slogan-image"></div>
        <div class="cart-container">
            <h2>Din Varukorg</h2>
            <p>Totalt antal produkter:
                <?= $totalQuantity ?>
            </p>
            <p>Totalpris:
                <?= $totalPrice ?> kr
            </p>

            <?php if (empty($cartItems)): ?>
                <div class="emty-cart">
                <p>Din varukorg är tom.</p>
                </div>
                
            <?php else: ?>
                <div class="scroll-container">
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <h3>
                            <?= htmlspecialchars($item['name']) ?>
                        </h3>
                        <p>
                            <?= htmlspecialchars($item['description']) ?>
                        </p>
                        <form action="cart.php" method="post">
                            <input type="hidden" name="product_id" value="<?= $item['id'] ?>">
                            <input type="hidden" name="update_cart" value="true">
                            <button type="submit" name="decrease" value="true">-</button>
                            <?= htmlspecialchars($item['quantity']) ?>
                            <button type="submit" name="increase" value="true">+</button>
                        </form>
                        <p>Antal:
                            <?= htmlspecialchars($item['quantity']) ?>
                        </p>
                        <p>Pris:
                            <?= htmlspecialchars($item['price'] * $item['quantity']) ?> kr
                        </p>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>
        </div>
        
        
        <div class="checkout-container">
        <h2>Fyll i dina uppgifter</h2>
        <form action="confirmation.php" method="post">
            <div class="form-group">
                <label for="name">Namn:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">E-post:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="address">Adress:</label>
                <input type="text" id="address" name="address" required>
            </div>

            <div class="form-group">
                <label for="postcode">Postnummer:</label>
                <input type="text" id="postcode" name="postcode" required>
            </div>

            <div class="form-group">
                <label for="city">Stad:</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefon:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <p>Totalt antal produkter:
                <?= $totalQuantity ?>
            </p>
            <p>Totalpris:
                <?= $totalPrice ?> kr
            </p>
            <button type="submit" class="checkout-button">Betala</button>
        </form>
        <?php endif; ?>
                    


    </div>


    <?php include "footer.php"; ?>
</body>

</html>