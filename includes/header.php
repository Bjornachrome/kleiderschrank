<?php session_start(); ?>
<nav>
    <a href="../index.php">Startseite</a>
    <?php if (isset($_SESSION["user_id"])): ?>
        <a href="../view_closet.php">Mein Kleiderschrank</a>
        <a href="../outfit_planner.php">Outfit Planer</a>
        <a href="../pages/logout.php">Logout</a>
    <?php else: ?>
        <a href="../pages/login.php">Login</a>
        <a href="../pages/register.php">Registrieren</a>
    <?php endif; ?>
</nav>
