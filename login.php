<?php
session_start();
if (isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    $color = $_SESSION['color'];
    unset($_SESSION['msg']);
    unset($_SESSION['color']);
    echo '<h2 style="color:'. $color .'">' . $msg . '</h2>';
}

if(isset($_POST) && !empty($_POST)) {
    var_dump($_POST);
    $workers = json_decode(file_get_contents('./workers.json'));
    foreach($workers as $worker) {
        if($worker->name == $_POST['name'] && $worker->password == $_POST['password']) {
            $_SESSION['id'] = $worker->name;
            $_SESSION['msg'] = 'Sveiki prisijungę!';
            $_SESSION['color'] = 'green';
            header('Location: http://localhost/bank-u2/sarasas.php');
            die;
        }
    } 
    $_SESSION['msg'] = 'Duomenys neteisingi. Prašome bandyti dar kartą';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bankas</title>
    <style>
        body {
            background:whitesmoke; 
            margin-left: 20px; 
            margin-top: 100px; 
            width: 500px; 
            text-align:center
        }
        h1 {
            color: red;
            word-spacing: 10px;
        }
        div {
            padding: 10px;
            font-size: 20px;
        }
        input {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <img src="./euros.jpg" alt="Euro logo">
    <h1>MY EUROS BANK</h1>
    <form action="" method="post" style="padding-top: 20px;">
        <div>
            <label for="name">Prisijungimo vardas:</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="password">Slaptažodis:</label>
            <input type="text" name="password">
        </div>
        <div>
            <input type="submit" name="login" value="Log In">
        </div>
    </form>
</body>
</html>