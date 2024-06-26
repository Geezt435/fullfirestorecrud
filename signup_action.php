<?php
include('config.php');
include('firebaseRDB.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if($name == "" || $email == "" || $password == ""){
    echo "Name, Email and Password cannot be empty";
} else {
    $rdb = new firebaseRDB($databaseURL);
    $retrieve = $rdb->retrieve("/user", "email", "EQUAL", $email);
    $data = json_decode($retrieve, true);

    if(isset($data['email'])) {
        echo "Email already registered";
    }else{
        $insert = $rdb->insert("/user", [
            "name" => $name,
            "email" => $email,
            "password" => $password
        ]);

        $result = json_decode($insert, 1);
        if(isset($result['name'])) {
            echo "Signup Success, please login";
        } else {
            echo "Signup failed";
        }
    }
}