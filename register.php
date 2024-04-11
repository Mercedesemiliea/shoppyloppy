<?php
session_start();

include 'db.php'; 
include '../shoppyloppy/componens/registerUser.php';


$registrationSuccess = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    $registerSuccess = registerUser($pdo, $username, $email, $password, $confirmPassword);

    if ($registerSuccess) {
        $_SESSION['username'] = $username;
        $_SESSION['registrationSuccess'] = true; 
        header('Location: userRegisterThanks.php');
        exit();
    } else {
        $registrationSuccess = false;
        echo 'Registrering misslyckades.';
    }
}

if (isset($_SESSION['registrationSuccess'])) {
    $registrationSuccess = $_SESSION['registrationSuccess'];
    unset($_SESSION['registrationSuccess']);
}



    
?>





<body>
    <?php include "navbar.php"; ?>
    <div class="register-background">
        <div class="pokemon-image-background"></div>
        <div class="register-container">

            <?php if ($registrationSuccess) : ?>
                <div class="success-message">
                    <p>Registreringen lyckades!</p>
                    <a href="login.php">Logga in här</a></p>
                </div>
            <?php else: ?>

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
        <?php endif; ?>
        </div>
        <div class="pokemon-image-dragonite"></div>
    </div>
    <?php include "footer.php"; ?>
</body>

