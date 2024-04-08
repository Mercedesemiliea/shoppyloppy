<!DOCTYPE html>
<html lang="sv">
<?php include 'header.php'; ?>
<body>
    <?php include "navbar.php"; ?>
    <div class="product-detail-backgorund">
    <div class="product-detail-container">
        <?php
        include "db.php";

        
        $productId = isset($_GET['id']) ? $_GET['id'] : null;

        if ($productId) {
           
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
            $stmt->execute(['id' => $productId]);
            $product = $stmt->fetch();

            if ($product) {
                
                echo "<h2>" . htmlspecialchars($product['name']) . "</h2>";
                echo "<img src='public/" . htmlspecialchars($product['image_url']) . "' alt='" . htmlspecialchars($product['name']) . "' style='width:300px;'>";
                echo "<p>" . htmlspecialchars($product['description']) . "</p>";
                echo "<p>Pris: " . htmlspecialchars($product['price']) . " kr</p>";

                echo "<form action='cart.php' method='post'>";
                echo "<input type='hidden' name='product_id' value='{$product['id']}'>";
                echo "<input type='number' name='quantity' value='1' min='1'>"; 
                echo "<button type='submit' name='add_to_cart'>Lägg till i kundvagnen</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "<p>Produkten kunde inte hittas.</p>";
            }
        } else {
            echo "<p>Ingen produkt vald.</p>";
        }
        ?>
    </div>
    <div class="product-details-image"></div>
</div>
    <?php include "footer.php"; ?>
</body>
</html>
