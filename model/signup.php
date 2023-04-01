<?php

if (isset($_POST['signup'])) { 

    $username = $_POST['username'];
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];

    if (emptyInputSignup($username, $userEmail, $userPassword) !== false) {
        header("Location: ?option=error");        
        exit();
    }
    if (invalidUsername($username) !== false) {
        header("Location: ?option=error");
        exit();
    }
    if (invalidEmail($userEmail) !== false) {
        header("Location: ?option=error");
        exit();
    }
    if (invalidPassword($userPassword) !== false) {
        header("Location: ?option=error");
        exit();
    }   

    if (userExists($connection, $username, $userEmail) !== false) {
        header("Location: ?option=error");
        exit();
    }

    createUser($connection, $username, $userEmail, $userPassword);    
    exit();
}