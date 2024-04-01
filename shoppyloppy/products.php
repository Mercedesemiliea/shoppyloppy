<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="UTF-8">
        <title>E-handel</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include "navbar.php"; ?>
        <div class="products-background">
            <div class="products-container">
                <?php
                    include "db.php";
                    $stmt = $pdo->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $products = $stmt->fetchAll();
                    foreach ($products as $product) {
                        echo "<div class='product'>";
                        //echo "<img src='images/{$product['image']}' alt='{$product['name']}'>";
                        echo "<h2>{$product['name']}</h2>";
                        echo "<p>{$product['description']}</p>";
                        echo "<p>{$product['price']} kr</p>";
                        echo "</div>";
                    }
                ?>
            </div>
        </div>
        <?php include "footer.php"; ?>
    </body>
    </html>
        