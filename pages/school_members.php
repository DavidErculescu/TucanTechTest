<?php
include '../lib/functions.php';
include '../header.php';

$conn = DBConnect();

$school = NULL;
if (isset($_GET['school']) && !empty(trim($_GET['school']))) {
    $stmt = $conn->prepare('SELECT * FROM schools WHERE id = ?');
    $stmt->bind_param('d', $_GET['school']);
    $stmt->execute();

    $result_school = $stmt->get_result();
    $school = $result_school->fetch_assoc();
}

if (!$school) {
    $_SESSION['errors'][]='Could not find selected school!';
    redirect('/pages/schools.php');
}

$stmt = $conn->prepare('
    SELECT members.* FROM association
    JOIN members ON 
      association.member_id = members.id
    WHERE association.school_id= ?;
');
$stmt->bind_param('d', $school['id']);
$stmt->execute();
$result_members = $stmt->get_result();

$members = [];
while ($member = $result_members->fetch_assoc()) {
    $members[] = $member;
}

?>

    <h2>Members of <?php echo $school['name']; ?></h2>
    <p>
        On this page you can see a list of all the members associated with the <?php echo $school['name']; ?> school and add new ones to it.
    </p>

    <table class="table table-striped table-hover" style="border: 1px solid #3498db; border-radius: 5px; ">
        <thead style="border-bottom: 1px solid #3498db;">
        <tr>
            <td style="width: 50px; text-align: center;">#</td>
            <td>Member name</td>
            <td>Member email</td>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($members)) {
            foreach ($members as $member) {
                echo '
                    <tr class="active">
                        <td style="text-align: center;">' . $member["id"] . '</td>
                        <td>' . $member["name"] . '</td>
                        <td>' . $member["email"] . '</td>
                    </tr>
                ';
            }
        } else {
            echo "<tr><td colspan='4'>There are no members for this school</td></tr>";
        }
        ?>
        </tbody>
    </table>

<?php
showMsgs();
?>

    <form class="form-horizontal" method="post" action="/pages/add_member.php">
        <fieldset>
            <legend>Add member</legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Member name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Member name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Member email</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Member email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSchools" class="col-lg-2 control-label">Member schools</label>
                <div class="col-lg-10">
                    <select  class="form-control" id="inputSchools" name="schools[]" multiple>
                        <?php
                        $sql = "SELECT id, name FROM schools";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo  '<option '.($row["id"]==$school["id"] ? "selected='selected'" : "").' value='.$row["id"].'>'.$row["name"].'</option>';
                                echo '<br>';
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add member</button>
                </div>
            </div>
        </fieldset>

        <input type="hidden" name="redirect" value="/pages/school_members.php?school=<?php echo $school['id']; ?>"/>
    </form>

<?php include '../footer.php'; ?>