<?php
    include '../lib/functions.php';
    $conn = DBConnect();
    $sql = "SELECT * FROM schools";
    $result = $conn->query($sql);

    include '../header.php';

?>

    <h2>Schools</h2>
    <p>
        On this page you can see a list of all the available schools and add new ones.
    </p>

    <table class="table table-striped table-hover" style="border: 1px solid #3498db; border-radius: 5px; ">
        <thead style="border-bottom: 1px solid #3498db;">
            <tr>
                <td style="width: 50px; text-align: center;">#</td>
                <td style="width: auto;">School name</td>
                <td style="width: 110px;"></td>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo '
                            <tr class="active">
                                <td style="text-align: center;">
                                    '.$row['id'].'
                                </td>
                                <td>
                                    '.$row['name'].'
                                </td>
                                <td>
                                    <a href="/pages/school_members.php?school='.$row["id"].'" type="button" class="btn btn-xs btn-success">View members</a>
                                </td>
                            </tr>
                        ';
                    }
                } else {
                    echo "<tr><td colspan='2'>There are no schools in the database</td></tr>";
                }
            ?>
        </tbody>
    </table>

<?php
    showMsgs();
?>

<form class="form-horizontal" method="post" action="/pages/add_school.php">
    <fieldset>
        <legend>Add school</legend>
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">School name</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputName" name="name" placeholder="School name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-primary">Add school</button>
            </div>
        </div>
    </fieldset>
</form>

<?php include '../footer.php'; ?>