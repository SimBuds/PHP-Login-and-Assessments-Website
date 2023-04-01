<?php
 session_start()
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Casey's Assignment 3</title>
    <meta name="description" content="Assignment 3">
    <meta name="author" content="Casey Hsu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <nav>

        <?php
        if (isset($_SESSION['username'])){
            echo "<a href='?option=assessments'>Assessments</a>";
            echo "<a href='?option=upload'>Upload Assessments</a>";
            echo "<a href='?option=logout'>Log Out</a>";
        } else {
            echo "<a href='?option=login'>Log In</a>";
            echo "<a href='?option=signup'>Sign Up</a>";
        }
        ?>
    </nav>
</header>

<h1>Welcome to Casey's PHP Application</h1>