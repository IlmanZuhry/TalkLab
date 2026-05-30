<?php
require_once '../core.php';

$app = new manz();
$mentor = $app->getCurrentMentor();

if (!$mentor) {
    header('Location: loginad.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TALKLAB - Profil Mentor</title>
    <?php include 'inc/layout_css.php'; ?>
</head>
<body>
    <?php include 'inc/header.php'; ?>
    <?php include 'inc/sidebar.php'; ?>

    
</body>
</html>
