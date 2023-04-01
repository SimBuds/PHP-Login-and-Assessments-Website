<?php 

if (isset($_POST['login'])) {

    // Grabbing user information from the form
    $username = $_POST['username'];
    $userPassword = $_POST['userPassword'];
    
    // Checking if the user input is empty
    if (emptyInputLogin($username, $userPassword) !== false) {
        header("Location: ?option=error");
        exit();
    }

    // Checking if the user exists
    loginUser($connection, $username, $userPassword);
    header("Location: ?option=assessments");
    exit();
}
