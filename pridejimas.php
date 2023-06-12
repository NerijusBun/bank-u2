<?php

session_start();

if (!isset($_POST)) {
    $_SESSION['msg'] = 'Atsiprašome - lėšų pridėti nepavyko';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sarasas.php');
    die;
}

$users = json_decode(file_get_contents('./users.json'));

foreach ($users as &$user) {
    if($user->id == $_POST['id']) {
        $user->funds += $_POST['funds'];
    }
}

file_put_contents('users.json', json_encode($users));
$_SESSION['msg'] = 'Lėšos pridėtos';
$_SESSION['color'] = 'green';
header('Location: http://localhost/bank-u2/sarasas.php');