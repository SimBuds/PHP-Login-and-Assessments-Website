<?php

require DATA_PATH . "database.php";

// Signup Functions

function request($name, $default = '') {
    // Solution for getting what is sent to the GLOBAL variables
    return $_REQUEST[$name] ?? $default;
}

// Checking for empty input fields
function emptyInputSignup($username, $userEmail, $userPassword){
    $result = false;
    if (empty($username) || empty($userEmail) || empty($userPassword)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checking for invalid username
function invalidUsername($username){
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checking for invalid email
function invalidEmail($userEmail){
    $result = false;
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checking for invalid password
function invalidPassword($userPassword){
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $userPassword) || strlen($userPassword) < 8) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checking if username or email already exists
function userExists($connection, $username, $userEmail){
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;";
    $stmt = mysqli_stmt_init($connection);    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ?option=error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $userEmail);    
    mysqli_stmt_execute($stmt); 
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

// Creating a new user
function createUser($connection, $username, $userEmail, $userPassword){
    $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?);';
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('Location: ?option=error');
        exit();
    }
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $userEmail, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $_SESSION['username'] = $username;
    exit();
}


// Login Functions

// Checking for empty input fields
function emptyInputLogin($username, $userPassword){
    $result = false;
    if (empty($username) || empty($userPassword)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Checking if username exists
function loginUser($connection, $username, $userPassword){
    $userExists = userExists($connection, $username, $userPassword);
    if ($userExists === false) {
        header('Location: ?option=error');
        exit();
    }
    $hashedPassword = $userExists['password'];
    $checkPassword = password_verify($userPassword, $hashedPassword);
    if ($checkPassword === false) {
        header('Location: ?option=error');
        exit();
    }
    else if ($checkPassword === true) {
        $_SESSION['username'] = $userExists['username'];
        exit();
    }
}

// Assessments Functions

// Checking for empty input fields
function emptyInputAssessment($assessmentName, $assessmentType, $assessmentDate, $assessmentTime, $assessmentStatus, $username){
    $result = false;
    if (empty($assessmentName) || empty($assessmentType) || empty($assessmentDate) || empty($assessmentTime || empty($assessmentStatus || empty($username)))) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Creating a new assessment
function createAssessment($connection, $course, $type, $date, $time, $status, $userId){
    $sql = 'INSERT INTO assessments (course, type, date, time, status, userId) VALUES (?, ?, ?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ?option=error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssss", $course, $type, $date, $time, $status, $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    exit();
}

function getUserId($connection, $username){
    $sql = "SELECT * FROM users WHERE username = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ?option=error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['id'];
    }
    else {
        $result = false;
        return $result;
    }
}



// Getting assessments by userID
function getAssessments($connection, $userId){
    $sql = "SELECT * FROM assessments WHERE userId = ?;";
    $stmt = mysqli_stmt_init($connection);    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ?option=error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userId);    
    mysqli_stmt_execute($stmt); 
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

// Updating an assessment
function updateAssessment($connection, $id, $status, $userId){
    $sql = "UPDATE assessments SET id = ?, status = ? WHERE userId = ?;";
    $stmt = mysqli_stmt_init($connection);    
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ?option=error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $id, $status, $userId);    
    mysqli_stmt_execute($stmt); 
    mysqli_stmt_close($stmt);
    exit();
}

// Upload Functions

// Upload function that calls the createAssessment function
function upload($connection, $fileDestination, $userId){
    $file_handle = fopen($fileDestination, "r");
    while (!feof($file_handle)) {
        $row = fgetcsv($file_handle, 1000, ",");
        $course = $row[0];
        $type = $row[1];
        $date = $row[2];
        $time = $row[3];
        $status = $row[4];
        createAssessment($connection, $course, $type, $date, $time, $status, $userId);
    }
    fclose($file_handle);
    exit();
}