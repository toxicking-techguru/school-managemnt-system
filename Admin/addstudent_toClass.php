<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../login.php');
}
include('header.php');
include('titleheader.php');
include('../dbcon.php');

if (isset($_POST['assign'])) {
    // Loop through each student and insert their selected class into the class table
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'class_id_') === 0 && !empty($value)) {
            $student_id = substr($key, 9); // Extract the student id from the input name
            $class_id = mysqli_real_escape_string($con, $value);
            $qry = "INSERT INTO class (student_id, class_id) VALUES ('$student_id', '$class_id')";
            $run = mysqli_query($con, $qry);
            if (!$run) {
                echo "Error: " . mysqli_error($con);
                exit();
            }
        }
    }
    echo "<script>alert('Classes assigned successfully.');</script>";
}




$qry = "SELECT * FROM student";
$run = mysqli_query($con, $qry);

if (mysqli_num_rows($run) > 0) {
?>
    <br><h1 align="center"> Add Students to Class</h1><br>
    <form method="post" action="addstudent_toClass.php">
        <table align="center" border="1" style="width:70%; margin-top:40px;">
            <tr>
                <th>Roll No</th>
                <th>Full Name</th>
                <th>Select Class</th>
            </tr>
            <?php
            while ($data = mysqli_fetch_assoc($run)) {
                ?>
                <tr>
                    <td><?php echo $data['rollno'] ?></td>
                    <td><?php echo $data['name'] ?></td>
                    <td>
                        <select name="class_id_<?php echo $data['id'] ?>">
                            <option value="">Select Class</option>
                            <option value="1">Class 1</option>
                            <option value="2">Class 2</option>
                            <option value="3">Class 3</option>
                            <option value="4">Class 4</option>
                            <option value="5">Class 5</option>
                            <option value="6">Class 6</option>
                            <option value="7">Class 7</option>
                            <option value="8">Class 8</option>
                        </select>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <div style="text-align:center;">
            <input type="submit" name="assign" value="Assign" style="padding:10px;">
        </div>
    </form>
<?php
} else {
    echo "No students found in the database.";
}
