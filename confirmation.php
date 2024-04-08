<?php
session_start();
include 'db.php';

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
?>



<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
<body>
<?php include "navbar.php"; ?>
<div class="order-confirmation-container">
<div class="order-confirmation">
            <h2>Orderbekräftelse</h2>
            <p>Hej <?= htmlspecialchars($_POST['name']); ?>, tack för att du handlar hos oss! Din order har mottagits och bearbetas.</p>
    
            <div class="order-details">
                <h3>Orderinformation</h3>
                <p>Datum: <?= date('Y-m-d'); ?></p>
                
                <h4>Produkter:</h4>
                <ul>
                    <?php
                    include "db.php";
                    foreach ($cartItems as $item) {
                        echo "<li>" . htmlspecialchars($item['name']) . " - Antal: " . htmlspecialchars($item['quantity']) . " - Pris: " . htmlspecialchars($item['price']) . " kr/st</li>";
                    }
                    ?>
                </ul>
                <p>Totalt antal produkter: <?= $totalQuantity; ?></p>
                <p>Totalpris: <?= htmlspecialchars($totalPrice); ?> kr</p>
                <div class="customer-details">
                <h3>Leveransadress:</h3>
                <p><?= htmlspecialchars($_POST['address']); ?></p>
                <p><?= htmlspecialchars($_POST['postcode']) . " " . htmlspecialchars($_POST['city']); ?></p>

                <h3>Kontakt:</h3>
                <p>E-post: <?= htmlspecialchars($_POST['email']); ?></p>
                <p>Telefon: <?= htmlspecialchars($_POST['phone']); ?></p>
            </div>
            </div>



            <div class="next-steps">
                <h3>Nästa steg:</h3>
                <p>Du kommer snart att få ett e-postmeddelande med en spårningslänk så att du kan följa din leverans.</p>
                <p>Har du några frågor? Vår kundtjänst är här för att hjälpa dig. Kontakta oss på <a href="mailto:support@EvolveEmporium.com">support@EvolveEmporium.com</a>.</p>
            </div>
        </section>

        <section class="customer-action">
            <a href="products.php" class="continue-shopping-btn">Fortsätt handla</a>
        </section>
    </div>
    <div class="order-confirmation-image">
        
    </div>
<?php include "footer.php"; ?>  
</body>
</html>