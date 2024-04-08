<?php include 'header.php'; ?>
<body>
    <?php include "navbar.php"; ?>
    <div class="login-background">
    <div class="login-image"></div>
        <div class="login-container">
            <h1>Logga in</h1>
            <form action="login.php" method="post">
            <label for="username">Användarnamn:</label>
<input type="text" name="username" id="username" required>
            
                <label for="password">Lösenord:</label>
                <input type="password" name="password" id="password" required>
                <button type="submit">Logga in</button>
            </form>
            <p>Har du inget konto? <a href="register.php">Registrera dig här</a></p>
        </div>
        <div class="pokemon-image-arceus "></div>
        <div class="pokemon-image-rehiram"></div>
        
    </div>
    <?php include "footer.php"; ?>
</body>