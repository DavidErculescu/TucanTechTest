<?php
include '../lib/functions.php';

$conn = DBConnect();

// get memebers from DB
$result_member = $conn->query("SELECT * FROM members;");

$members=[];
while ($member = $result_member->fetch_assoc()) {
    $member['schools']=[];

    // for each member get all the schools he is associated with through the association table
    $stmt = $conn->prepare('
        SELECT schools.name FROM association
        JOIN schools ON 
          association.school_id = schools.id
        WHERE association.member_id= ?;
    ');
    $stmt->bind_param('d', $member['id']);
    $stmt->execute();
    $result_school = $stmt->get_result();
    while ($school = $result_school->fetch_assoc()) {
        // add the school name to the member's school list
        $member['schools'][] = $school['name'];
    }

    $members[] = $member;
}

include '../header.php';

?>

<h2>Members</h2>
<p>
    On this page you can see a list of all the members and add new ones.
</p>

<table class="table table-striped table-hover" style="border: 1px solid #3498db; border-radius: 5px; ">
    <thead style="border-bottom: 1px solid #3498db;">
        <tr>
            <td style="width: 50px; text-align: center;">#</td>
            <td>Member name</td>
            <td>Member email</td>
            <td>Member schools</td>
        </tr>
    </thead>
    <tbody>
        <?php
            if (count($members)) {
                foreach ($members as $member) {
                    echo '
                        <tr class="active">
                            <td style="text-align: center;">'.$member["id"].'</td>
                            <td>'.$member["name"].'</td>
                            <td>'.$member["email"].'</td>
                            <td>'.implode(", ", $member["schools"]).'</td>
                        </tr>
                    ';
                }
            } else {
                echo "<tr><td colspan='4'>There are no members in the database</td></tr>";
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
                        // get schools to build UI school multi select
                        $result = $conn->query("SELECT id, name FROM schools");
                        if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {
                                echo  '<option value='.$row["id"].'>'.$row["name"].'</option>';
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
    <input type="hidden" name="redirect" value="/pages/members.php"/>
</form>

<?php include '../footer.php'; ?>