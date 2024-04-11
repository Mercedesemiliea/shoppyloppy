<?php
session_start();

?>

<body>
    <?php include "navbar.php"; ?>
    <div class="register-thanks-container">
        <div class="success-message">
            <h1>Välkommen <?= htmlspecialchars($_SESSION['username']); ?></h1>
            <p>Tack för att du registrerade dig. <?= htmlspecialchars($_SESSION['username']); ?> 
                Du är nu en del av en
                fantastisk gemenskap som delar ditt intresse för Pokémons.</p>
            <p><a href="login.php">Logga in</a> för att fortsätta.</p>
        </div>
        <div class="user-register-pokemon-image-dragonite"></div>
        <div class="user-register-pokemon-image-gardevoir"></div>
    </div>
    <div class="user-register-pokemon-image"></div>
    <?php include "footer.php"; ?>
</body>