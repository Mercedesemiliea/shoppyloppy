<?php 
$host = "localhost";
$dbname = "pokemonshopdb";
$username = "root";
$password = "root";

try {
    $pdo = new PDO ("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Databasanlutningen misslyckades: " . $e->getMessage();
    exit;
}

try {
    $stmt = $pdo->query("SELECT p.id, p.name, p.description, p.price FROM products p JOIN popular_products pp ON p.id = pp.product_id");
    $popularProducts = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Kunde inte hämta produkter: " . $e->getMessage();
    exit;
}