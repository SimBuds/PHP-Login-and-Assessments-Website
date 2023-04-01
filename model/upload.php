<?php 


    if (isset($_POST['upload'])) {
    if (empty($_FILES['file']['name'])) {
        header("Location: ?option=error");
        exit();
    }

    // Checking if the file is the right size
    if($_FILES['file']['size'] > 10000) {
        header("Location: ?option=error");
        exit();
    }

    // Checking if the file is empty
    if($_FILES['file']['error'] !== 0) {
        header("Location: ?option=error");
        exit();
    }

    if($_FILES['file']['type'] !== 'text/plain') {
        header("Location: ?option=error");
        exit();
    }

    if(file_exists('data/' . $_FILES['file']['name'])) {
        header("Location: ?option=error");
        exit();
    }

    if(!move_uploaded_file($_FILES['file']['tmp_name'], 'data/' . $_FILES['file']['name'])) {
        header("Location: ?option=error");
        exit();
    }    

    $file = $_FILES['file']['name'];
    $file = "data/$file";
    $user = 1;

    upload($connection, $file, $user);
    exit();
}