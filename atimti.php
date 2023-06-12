<?php 
session_start();
if(!isset($_SESSION['id'])) {
    header('Location: http://localhost/bank-u2/login.php');
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>
</head>
<body>
    <?php 
        require_once('./menu.php');
    ?>
    <form action="nuskaiciavimas.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
        <input type="text" name="funds">
        <input type="submit" value="Nuskaičiuoti lėšas">
    </form>
</body>
</html>