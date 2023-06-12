<?php

session_start();

if(!isset($_POST['id'])) {
    $_SESSION['msg'] = 'Nėra galimybės ištrinti tokio vartotojo';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sarasas.php');
    die;
}

$users = json_decode(file_get_contents('./users.json'));

$users2 = [];
foreach ($users as &$user) {
    if($user->id !== $_POST['id']) {
        $users2[] = $user;
    } else {
        if($user->funds > 0) {
            $_SESSION['msg'] = 'Vartotojo ištrynimas negalimas! Sąskaitoje yra lėšų';
            $_SESSION['color'] = 'red';
            header('Location: http://localhost/bank-u2/sarasas.php');
            die;
        }
    }
}

file_put_contents('users.json', json_encode( $users2));
$_SESSION['msg'] = 'Vartotojas ištrintas';
$_SESSION['color'] = 'green';
header('Location: http://localhost/bank-u2/sarasas.php');