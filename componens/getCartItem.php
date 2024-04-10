<?php
function getCartItems($pdo) {
    $totalQuantity = 0;
    $totalPrice = 0;
    $cartItems = [];

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
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
    }

    return [
        'totalQuantity' => $totalQuantity,
        'totalPrice' => $totalPrice,
        'cartItems' => $cartItems
    ];
}
