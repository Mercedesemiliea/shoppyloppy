<?php 

include 'header.php'; 
$cartItemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
    <nav class="navbar">
        <span class="iconify" data-icon="arcticons:pokemon-home"></span>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li class="cart-icon">
            <a href="cart.php">
                <span class="material-icons">shopping_bag</span>
                <span class="cart-count"><?php echo $cartItemCount; ?></span>
            </a>
        </li>
    </ul>
        <?php if (isset($_SESSION['username'])): ?>
        <p>Inloggad som <?= htmlspecialchars($_SESSION['username']); ?></p>
    <?php endif; ?>
        <div class="nav-search">
            <form action="products.php" method="get">
                <input type="text" name="search" placeholder="Sök Pokémon..">
                <button type="submit">Sök</button>
            </form>
        </div>
    </nav>
