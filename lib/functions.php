<?php
    // connects to the database and returns the connection resource
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

    // associate a member with a school
    function addAssociation($member_id, $school_id) {
        $conn = DBConnect();

        $stmt = $conn->prepare("INSERT INTO association (member_id, school_id) VALUES (? ,?)");
        $stmt->bind_param('dd', $member_id, $school_id);
        $stmt->execute();
    }

    // redirects to the given URL using JS
    function redirect($url) {
        echo "
            <script type='text/javascript'>
                window.location='".$url."';
            </script>
        ";
    }

    // shows all the messages currently stored in the session
    function showMsgs() {
        if (isset($_SESSION['ok_msgs']) && count($_SESSION['ok_msgs'])) {
            showOkMsgs();
        }
        else {
            showErrors();
        }
    }

    // shows ok messages currently stored in the session
    function showOkMsgs() {
        if (isset($_SESSION['ok_msgs']) && count($_SESSION['ok_msgs'])) {
            showAlerts($_SESSION['ok_msgs'], 'success');
            $_SESSION['ok_msgs']=[];
        }
    }

    // shows error messages currently stored in the session
    function showErrors() {
        if (isset($_SESSION['errors']) && count($_SESSION['errors'])) {
            showAlerts($_SESSION['errors'], 'danger');
            $_SESSION['errors']=[];
        }
    }

    // shows an alert for each of the $msgs with an $alertType type
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