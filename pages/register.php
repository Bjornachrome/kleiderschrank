<?php
require_once "../includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    if ($stmt->execute([$username, $email, $password])) {
        echo "Erfolgreich registriert!";
        header("Location: login.php");
        exit();
    } else {
        echo "Fehler bei der Registrierung.";
    }
}
?>

<form method="post">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="email" name="email" placeholder="E-Mail" required>
    <input type="password" name="password" placeholder="Passwort" required>
    <button type="submit">Registrieren</button>
</form>
