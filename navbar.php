<?php include 'header.php'; ?>
<header>
    
    <nav class="navbar">

    
    <span class="iconify" data-icon="arcticons:pokemon-home" ></span>



        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="cart.php"><span class="material-icons">shopping_bag</span> Cart</a></li>
        </ul>
        
        <div class="nav-search">
            <form action="products.php" method="get">
                <input type="text" name="search" placeholder="Sök pokemon..">
                <button type="submit">Sök</button>  

            </form>
        </div>
    </nav>
</header>
