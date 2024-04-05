<?php include 'header.php'; ?>
<body>
    <?php include "navbar.php"; ?>
    <div class="register-background">
    <div class="pokemon-image-background"></div>
        <div class="register-container">
            <h1>Registrera</h1>
            <form action="register.php" method="post">
                <label for="email">E-post:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Lösenord:</label>
                <input type="password" name="password" id="password" required>
                <label for="confirmPassword">Bekräfta lösenord:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <button type="submit">Registrera</button>
            </form>
            <p>Har du redan ett konto? <a href="login.php">Logga in här</a></p>
            
        </div>
        <div class="pokemon-image-dragonite"></div>
    </div>
    <?php include "footer.php"; ?>
</body>