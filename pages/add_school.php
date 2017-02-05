<?php
    session_start();
    include '../lib/functions.php';

    $name = trim($_POST['name']);
    if (isset($_POST['name']) && !empty($name)) {
        $conn = DBConnect();
        $stmt = $conn->prepare("INSERT INTO schools (name) VALUES (?)");
        $stmt->bind_param('s', $name);
        $stmt->execute();

        $_SESSION['ok_msgs'][]='School added successfully.';
    } else {
        $_SESSION['errors'][]='Could not add school! No name given.';
    }

    redirect('/pages/schools.php');
?>