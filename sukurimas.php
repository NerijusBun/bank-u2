<?php

session_start();

if(strlen($_POST['name']) < 3 || strlen($_POST['surname']) < 3) {
    $_SESSION['msg'] = 'Vardas arba pavardė trumpesni negu 3 raidės';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if(strlen($_POST['personal_id']) != 11) {
    $_SESSION['msg'] = 'Netinkamas asmens kodo ilgis';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if($_POST['personal_id'][0] != 1 && $_POST['personal_id'][0] != 2 &&
 $_POST['personal_id'][0] != 3 && $_POST['personal_id'][0] != 4 && 
 $_POST['personal_id'][0] != 5 && $_POST['personal_id'][0] != 6) {
    $_SESSION['msg'] = 'Asmens kodo pirmas skaitmuo netinkamas';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if($_POST['personal_id'][1] != 1 && $_POST['personal_id'][1] != 2 &&
 $_POST['personal_id'][1] != 3 && $_POST['personal_id'][1] != 4 && 
 $_POST['personal_id'][1] != 5 && $_POST['personal_id'][1] != 6 &&
 $_POST['personal_id'][1] != 7 && $_POST['personal_id'][1] != 8 &&
 $_POST['personal_id'][1] != 9 && $_POST['personal_id'][1] != 0) {
    $_SESSION['msg'] = 'Asmens kodo antras skaitmuo netinkamas';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if($_POST['personal_id'][2] != 1 && $_POST['personal_id'][2] != 2 &&
 $_POST['personal_id'][2] != 3 && $_POST['personal_id'][2] != 4 && 
 $_POST['personal_id'][2] != 5 && $_POST['personal_id'][2] != 6 &&
 $_POST['personal_id'][2] != 7 && $_POST['personal_id'][2] != 8 &&
 $_POST['personal_id'][2] != 9 && $_POST['personal_id'][2] != 0) {
    $_SESSION['msg'] = 'Asmens kodo tečias skaitmuo nėra tinkamas';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if($_POST['personal_id'][3] != 0 && $_POST['personal_id'][3] != 1) {
    $_SESSION['msg'] = 'Asmens kodo ketvirtas skaitmuo netinkamas';
    $_SESSION['color'] = 'red';
    header('Location: http://localhost/bank-u2/sukurti.php');
    die;
}

if($_POST['personal_id'][3] == 0 ) {
    if($_POST['personal_id'][4] != 1 && $_POST['personal_id'][4] != 2 &&
    $_POST['personal_id'][4] != 3 && $_POST['personal_id'][4] != 4 && 
    $_POST['personal_id'][4] != 5 && $_POST['personal_id'][4] != 6 &&
    $_POST['personal_id'][4] != 7 && $_POST['personal_id'][4] != 8 &&
    $_POST['personal_id'][4] != 9) {
        $_SESSION['msg'] = 'Asmens kodo penktas skaitmuo netinkamas';
        $_SESSION['color'] = 'red';
        header('Location: http://localhost/bank-u2/sukurti.php');
        die;
    }    
} else {
    if($_POST['personal_id'][4] != 1 && $_POST['personal_id'][4] != 2 &&
    $_POST['personal_id'][4] != 0) {
        $_SESSION['msg'] = 'Asmens kodas nėra tinkamas';
        $_SESSION['color'] = 'red';
        header('Location: http://localhost/bank-u2/sukurti.php');
        die;
    }    
}

$content = file_get_contents('users.json');

if($content == '') {
    $users = [];
} else {
    $users = json_decode($content);
}
$id = file_get_contents('id.json');
if(!empty($users)) {
    foreach ($users as $user) {
        if($user->personal_id == $_POST['personal_id']) {
            $_SESSION['msg'] = 'Toks asmens kodas jau yra sistemoje';
            $_SESSION['color'] = 'red';
            header('Location: http://localhost/bank-u2/sukurti.php');
            die;
        }
    }
}
$accountNo = 'LT' . rand(10,99) . '70770' . rand(10000000000, 99999999999);

$user = [
    'id' => $id,
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'personal_id' => $_POST['personal_id'],
    'account_no' => $accountNo,
    'funds' => 0,
];
file_put_contents('id.json', ++$id);
$users[] = $user;

file_put_contents('users.json', json_encode( $users));
$_SESSION['msg'] = 'Naujas vartotojas sukurtas';
$_SESSION['color'] = 'green';
header('Location: http://localhost/bank-u2/sukurti.php');