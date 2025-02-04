<?php
$host = "localhost";
$dbname = "kleiderschrank_db";
$username = "root";  // Ändere das für dein Setup
$password = "";      // Dein MySQL-Passwort

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}
?>
