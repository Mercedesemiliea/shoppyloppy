<!DOCTYPE html>
<html lang="sv">

<?php include 'header.php'; ?>
    </head>
    <body>
        <?php include "navbar.php"; ?>
            <div class="landingpage-background-container">
                <section class="hero">
                    <div class="login">
                <ul>
            <li><a href="login.php">Logga in</a></li>
            <li><a href="register.php">Registrera</a></li>
        </ul>
        </div>
                    <h1>Välkommen till Evolve Emporium</h1>
                    <div class="hero-catch">
                    <p> gotta catch em all </p>
                    </div>
                </section>
            </div>          
            <div class="landingpage-container">
                <div class="landingpage-background-content">
                    <p> Din ultimata destination 
                        för allt som hjärta kan begära från den spännande världen 
                        av Pokémon. I vårt omsorgsfullt sortiment hittar 
                        du allt från de senaste och mest eftertraktade Pokémons som inte finns någon 
                        annanstans. Oavsett om du är en erfaren Pokémon-tränare på 
                        jakt efter nästa legendariska tillägg till din samling, eller 
                        en nybörjare som just påbörjat ditt äventyr, har vi något för dig.
                        På Evolve Emporium är vi mer än bara en butik – vi är en gemenskap. 
                        Vi tror på att Pokémon-upplevelsen växer genom delning, upptäckt och 
                        vänskap. Därför strävar vi efter att skapa en plats där fans kan komma 
                        samman för att dela sina passioner, erfarenheter och, framför allt, 
                        sin kärlek till Pokémon.
                        Från den mytomspunna Mew till den ikoniska Pikachu, vår mission är att 
                        föra dessa fantastiska varelser till dig på ett sätt som berikar ditt 
                        äventyr och fördjupar din förbindelse med Pokémon-världen. 
                        Låt Evolve Emporium vara din guide och portal till allt det 
                        underbara som Pokémon har att erbjuda.
                        Utforska vårt sortiment idag och se vad som väntar på att upptäckas. 
                        Vem vet vilka nya favoriter och oväntade skatter som väntar på dig? 
                    </p>      
                </div>
                <div class="products-popular-container">
                    <h4>Populära produkter</h4>
                    <?php 
                    include "db.php";
                        foreach ($popularProducts as $product): ?>
                        <div class="popular-product">
                            <a href="productDetails.php?id=<?php echo $product['id']; ?>">
                            
                                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <p>Pris: <?php echo htmlspecialchars($product['price']); ?> kr</p></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php include "footer.php"; ?>
    </body>
</html>