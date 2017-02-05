<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ToucanTech test</title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br/>
                    <br/>
                    <nav class="navbar navbar-inverse">
                        <div class="container-fluid">

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                <ul class="nav navbar-nav">
                                    <li><a href="/">Home</a></li>
                                    <?php
                                        if (file_exists('lib/setup_run') || file_exists('../lib/setup_run')) {
                                            ?>
                                                <li><a href="/pages/schools.php">Schools</a></li>
                                                <li><a href="/pages/members.php">Members</a></li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </nav>

                </div>
            </div>
