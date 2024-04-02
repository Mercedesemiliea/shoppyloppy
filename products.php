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
        <div class="category-links">
            <?php
            include "db.php"; 
            $stmt = $pdo->prepare("SELECT id, name FROM categories");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            foreach ($categories as $category): ?>
                <a href="products.php?category_id=<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></a>
            <?php endforeach; ?>
        </div>
        <div class="products-container">
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : null;
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
            
            // Grundläggande fråga som alltid kommer att köras
            $query = "SELECT products.* FROM products 
                      LEFT JOIN categories ON products.category_id = categories.id";
            $whereConditions = [];
            $params = [];
            
            // Kontrollerar om en kategori är vald
            if ($category_id) {
                $whereConditions[] = "products.category_id = ?";
                $params[] = $category_id;
            }

            // Lägger till söklogik för både produktnamn och kategorinamn
            if ($search) {
                $whereConditions[] = "(products.name LIKE ? OR categories.name LIKE ?)";
                $params[] = '%' . $search . '%';
                $params[] = '%' . $search . '%';
            }
            
            // Om det finns villkor, lägg till dem till frågan
            if (!empty($whereConditions)) {
                $query .= " WHERE " . implode(" AND ", $whereConditions);
            }
            
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $products = $stmt->fetchAll();
            
            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<img src='public/{$product['image_url']}' alt='{$product['name']}'>";
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
