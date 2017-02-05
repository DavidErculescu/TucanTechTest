<?php
    include '../lib/functions.php';
    include '../lib/config.php';
    session_start();

    if (file_exists('../lib/setup_run')) {
        $_SESSION['errors'][]='Setup has already run!';
        redirect('/');
    }

    $conn = new mysqli($servername, $username, $password);

    //Here o create the databse woth the name toucantech that i will use for this demo
    $sql = "CREATE DATABASE ".$dbname.";";
    if ($conn->query($sql) === FALSE) {
        $_SESSION['errors'][]='Setup could not create database! '.$conn->error;
        redirect('/');
    }

    $conn->select_db($dbname);

    //Here i create the table where i'm going to store memvers
    $sql = "CREATE TABLE Members (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(50)
    )";
    if ($conn->query($sql) === FALSE) {
        $_SESSION['errors'][]='Setup could not create members table! '.$conn->error;
        redirect('/');
    }
    //Here i create the table where i'm going to store schools
    $sql = "CREATE TABLE Schools (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL
    )";
    if ($conn->query($sql) === FALSE) {
        $_SESSION['errors'][]='Setup could not create schools table! '.$conn->error;
        redirect('/');
    }

    //Here i create the table where i'm going to store associations
    $sql = "CREATE TABLE Association (
    member_id INT(6) NOT NULL,
    school_id INT(6) NOT NULL
    )";
    if ($conn->query($sql) === FALSE) {
        $_SESSION['errors'][]='Setup could not create association table! '.$conn->error;
        redirect('/');
    }
    $conn->close();

    file_put_contents('../lib/setup_run','Setup ran successfully');
    redirect('/');
?>