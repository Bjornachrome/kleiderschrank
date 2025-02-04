<?php
session_start();
require_once "includes/header.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mein Kleiderschrank</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <h1>Willkommen bei Mein Kleiderschrank</h1>
        <p>Organisiere deine Kleidung, plane Outfits und behalte den Überblick über deine Lieblingsstücke.</p>
    </header>

    <section>
        <?php if (isset($_SESSION["user_id"])): ?>
            <h2>Hallo, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
            <p><a href="view_closet.php" class="btn">Zum Kleiderschrank</a></p>
            <p><a href="outfit_planner.php" class="btn">Outfit Planer</a></p>
        <?php else: ?>
            <p><a href="pages/login.php" class="btn">Jetzt anmelden</a> oder <a href="pages/register.php" class="btn">registrieren</a></p>
        <?php endif; ?>
    </section>

</body>
</html>
