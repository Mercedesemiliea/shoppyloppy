<?php
session_start();
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

   
    if ($password == $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

       
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hashedPassword]);

       
        $_SESSION['username'] = $username;
        header("Location: index.php"); 
        exit();
    } else {
        echo "Lösenorden matchar inte.";
    }
}
?>



<?php include 'header.php'; ?>

<body>
    <?php include "navbar.php"; ?>
    <div class="register-background">
        <div class="pokemon-image-background"></div>
        <div class="register-container">
            <h1>Registrera</h1>
            <form action="register.php" method="post">
                <label for="username">Användarnamn:</label>
                <input type="text" name="username" id="username" required>

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