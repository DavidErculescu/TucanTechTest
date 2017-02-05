<?php
    include 'lib/functions.php';
    include 'header.php';

    showMsgs();
?>


    <div class="jumbotron">
        <h1>Welcome,</h1>
        <p>
            This is my way of solving the given requirements. As per those requirements this demo can add members with name and e-mail for each and then assinged them to one or many schools.
        </p>
        <p>
            Beside the required members, my demo can also manage schools. I have solved the <i>many-to-many</i> relation between members and schools using an association table.
        </p>
        <p>
            In order to be able to use the demo you have to set it up.
            <br/>
            First edit the <i>'lib/config.php'</i> file and modify the parameters.
            Then run the setup by clicking on the button below.
        </p>
        <?php
            if (!file_exists('lib/setup_run')) {
                ?>

                    <p>
                        <a class="btn btn-primary btn-lg" href="/pages/setup.php">Run setup</a>
                    </p>
                <?php
            }
            else {
                ?>
                    <p>
                        <a class="btn btn-primary btn-lg disabled" href="/pages/setup.php">Setup already ran</a>
                    </p>
                <?php
            }
        ?>


        <small>
            Dev time: (approx.) 3 hours
            <br/>
            UI improvements: (approx.) 2 hours
        </small>
    </div>

<?php
    include 'footer.php';
?>



