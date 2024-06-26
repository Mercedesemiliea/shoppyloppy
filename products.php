<?php
session_start();
?>

<!DOCTYPE html>
<html lang="sv">
<?php include 'header.php'; ?>

<body>
    <?php include "navbar.php"; ?>
    <div class="products-background">
        <div class="category-links">
            <?php
            include "db.php";
            $stmt = $pdo->prepare("SELECT id, name FROM categories");
            $stmt->execute();
            $categories = $stmt->fetchAll();
            $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
            $search = isset($_GET['search']) ? $_GET['search'] : null;
            $dir = isset($_GET['dir']) && $_GET['dir'] === 'desc' ? 'desc' : 'asc';
            foreach ($categories as $category): ?>
                <a
                    href="products.php?category_id=<?php echo $category['id']; ?><?php echo $search ? '&search=' . $search : ''; ?>
                    <?php echo '&dir=' . $dir; ?>"><?php echo htmlspecialchars($category['name']); ?>
                </a>
            <?php endforeach; ?>

            <!-- Sorteringsform -->
            <form action="products.php" method="get">
                Sortera efter pris:
                <select name="dir" onchange="this.form.submit()">
                    <option value="asc" <?php echo $dir == 'asc' ? 'selected' : ''; ?>>Lågt till Högt</option>
                    <option value="desc" <?php echo $dir == 'desc' ? 'selected' : ''; ?>>Högt till Lågt</option>
                </select>
                <?php if ($category_id): ?>
                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category_id); ?>">
                <?php endif; ?>
                <?php if ($search): ?>
                    <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <?php endif; ?>
            </form>
        </div>

        <div class="products-container">
            <?php
            $whereConditions = [];
            $params = [];

            $productsPerPage = 12;
            $currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $offset = ($currentPage - 1) * $productsPerPage;

            if ($category_id) {
                $whereConditions[] = "products.category_id = ?";
                $params[] = $category_id;
            }


            if ($search) {
                $whereConditions[] = "(products.name LIKE ? )";
                $params[] = '%' . $search . '%';
            }

            $whereSQL = !empty($whereConditions) ? " WHERE " . implode(" AND ", $whereConditions) : "";

            $limitSQL = " LIMIT $productsPerPage OFFSET $offset";

            $countSQL = "SELECT COUNT(*) FROM products" . $whereSQL;
            $stmt = $pdo->prepare($countSQL);
            $stmt->execute($params);
            $totalRows = $stmt->fetchColumn();
            $totalPages = ceil($totalRows / $productsPerPage);

            $query = "SELECT products.* FROM products 
                      LEFT JOIN categories ON products.category_id = categories.id"
                . $whereSQL
                . " ORDER BY products.price $dir" . $limitSQL;
            $stmt = $pdo->prepare($query);
            $stmt->execute($params);
            $products = $stmt->fetchAll();

            foreach ($products as $product) {
                echo "<div class='product'>";
                echo "<a href='productDetails.php?id=" . $product['id'] . "'>";
                echo "<img src='public/{$product['image_url']}' alt='{$product['name']}'>";
                echo "<h2>{$product['name']}</h2>";
                echo "<p>{$product['description']}</p>";
                echo "<p>{$product['price']} kr</p>";
                echo "</div>";
                echo "</a>";
            }
            ?>
            <div class="pagination-container">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {

                    echo "<div class='pagination'>";
                    echo "<a href='products.php?page=$i";
                    echo $category_id ? "&category_id=$category_id" : "";
                    echo $search ? "&search=$search" : "";
                    echo "&dir=$dir'>$i</a> ";
                    echo '</div>';
                }

                ?>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>

</html>