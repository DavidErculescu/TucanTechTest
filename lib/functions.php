<?php
    function DBConnect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "toucantech";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function addAssociation($member_id, $school_id) {
        $conn = DBConnect();

        $stmt = $conn->prepare("INSERT INTO association (member_id, school_id) VALUES (? ,?)");
        $stmt->bind_param('dd', $member_id, $school_id);
        $stmt->execute();
    }

    function redirect($url) {
        echo "
            <script type='text/javascript'>
                window.location='".$url."';
            </script>
        ";
    }

    function showMsgs() {
        if (isset($_SESSION['ok_msgs']) && count($_SESSION['ok_msgs'])) {
            showOkMsgs();
        }
        else {
            showErrors();
        }
    }

    function showOkMsgs() {
        if (isset($_SESSION['ok_msgs']) && count($_SESSION['ok_msgs'])) {
            showAlerts($_SESSION['ok_msgs'], 'success');
            $_SESSION['ok_msgs']=[];
        }
    }

    function showErrors() {
        if (isset($_SESSION['errors']) && count($_SESSION['errors'])) {
            showAlerts($_SESSION['errors'], 'danger');
            $_SESSION['errors']=[];
        }
    }

    function showAlerts($msgs, $alertType) {
        foreach ($msgs as $msg) {
            echo '
                <div class="alert alert-dismissible alert-'.$alertType.'">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>'.($alertType=="success" ? "Message: " : "Error: ").':</strong>'.$msg.'
                </div>
            ';
        }
    }

?>