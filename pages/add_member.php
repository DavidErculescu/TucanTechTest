<?php
    session_start();
    include '../lib/functions.php';

    if (
        isset($_POST['name']) &&
        isset($_POST['email']) &&
        isset($_POST['schools']) &&
        !empty(trim($_POST['name'])) &&
        !empty(trim($_POST['email'])) &&
        count($_POST['schools'])
    ) {
        $conn = DBConnect();

        $member_name = $_POST['name'];
        $stmt = $conn->prepare("INSERT INTO members (name, email) VALUES (?, ?)");
        $stmt->bind_param('ss', $member_name, $_POST['email']);
        $stmt->execute();

        $sql = 'SELECT id FROM members WHERE name="' . $member_name . '"';
        $member_id = $conn->query($sql);

        if ($member_id->num_rows > 0) {
            // output data of each row
            while ($row = $member_id->fetch_assoc()) {
                foreach ($_POST['schools'] as $school_id) {
                    addAssociation($row['id'], $school_id);
                }
            }
        }

        $_SESSION['ok_msgs'][]='Member added successfully.';
    } else {
        $_SESSION['errors'][]='Could not add member! Missing required data.';
    }

    redirect($_POST['redirect']);
?>