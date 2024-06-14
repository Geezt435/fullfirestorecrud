<?php
include('config.php');
include('firebaseRDB.php');

$email = $_POST['email'];
$password = $_POST['password'];

if($email == "" || $password == ""){
    echo "Email and Password cannot be empty";
} else {
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
    $data = json_decode($retrieve, 1);

    if(count($data) == 0) {
        echo "Email not registered";
    } else {
        $id = array_keys($data)[0];
        if($data[$id]['password'] == $password) {
            $_SESSION['user'] = $data[$id];
            header('Location: crudphpfirebase/index.php');
        } else {
            echo "Login failed";
        }
    }
}