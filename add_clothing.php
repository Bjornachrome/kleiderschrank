<?php
session_start();
require_once "includes/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: pages/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $color = $_POST["color"];
    $user_id = $_SESSION["user_id"];

    $imagePath = null;

    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "img/";
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Prüfen, ob es sich um ein Bild handelt
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            die("Datei ist kein gültiges Bild.");
        }

        // Erlaubte Formate
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            die("Nur JPG, JPEG, PNG & GIF-Dateien sind erlaubt.");
        }

        // Datei verschieben
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $imageName;
        } else {
            die("Fehler beim Hochladen des Bildes.");
        }
    }

    // Daten speichern
    $stmt = $pdo->prepare("INSERT INTO clothes (user_id, name, category, color, image) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $name, $category, $color, $imagePath])) {
        header("Location: view_closet.php");
        exit();
    } else {
        echo "Fehler beim Speichern.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kleidung hinzufügen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<h2>Kleidung hinzufügen</h2>
<form action="add_clothing.php" method="post" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name des Kleidungsstücks" required>
    <select name="category" required>
        <option value="Shirt">Shirt</option>
        <option value="Hose">Hose</option>
        <option value="Jacke">Jacke</option>
        <option value="Schuhe">Schuhe</option>
    </select>
    <input type="text" name="color" placeholder="Farbe" required>
    <input type="file" name="image" accept="image/*">
    <button type="submit">Speichern</button>
</form>

</body>
</html>
