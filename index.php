<?php
    include('config.php');
    include('firebaseRDB.php');

    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }else{
        header('Location: crudphpfirebase/index.php');
    }