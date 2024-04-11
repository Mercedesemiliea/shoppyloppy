<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        echo 'Fel användarnamn eller lösenord';
    }
}

?>
<?php include 'header.php'; ?>
<body>
    <?php include "navbar.php"; ?>
    <div class="login-background">
    <div class="login-image"></div>
        <div class="login-container">
            <h1>Logga in</h1>
            <?php if (!empty($error)): ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php endif; ?>

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