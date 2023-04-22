<?php
// Start session and check if user is logged in as admin
session_start();
if (!isset($_SESSION['uid'])){
    header('Location: login.php');
    exit();
}
include('header.php');
include('titleheader.php');
include('header.php');
// Connect to database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'sms';
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// If the form is submitted
if (isset($_POST['submit'])) {
    // Get the student ID, attendance status, and date
    $student_id = $_POST['student_id'];
    $attendance_status = $_POST['attendance_status'];
    $date = $_POST['date'];

    // Insert the attendance record into the database
    $sql = "INSERT INTO attendance (student_id, date, attendance_status) VALUES ($student_id, '$date', '$attendance_status')";
    if (mysqli_query($conn, $sql)) {
        echo 'Attendance updated successfully';
    } else {
        echo 'Error updating attendance: ' . mysqli_error($conn);
    }
}

// Get the list of students from the database
$sql = "SELECT * FROM student";
$result = mysqli_query($conn, $sql);

// Display the list of students with a form to mark them as present or absent
echo '<form method="post">';
echo '<table>';
echo '<tr><th>Student ID</th><th>Name</th><th>Attendance Status</th><th>Date</th></tr>';
echo '<tr>';
echo '<td><select name="student_id">';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
}
echo '</select></td>';
echo '<td>';
echo '<select name="attendance_status">';
echo '<option value="Present">Present</option>';
echo '<option value="Absent">Absent</option>';
echo '</select>';
echo '</td>';
echo '<td><input type="date" name="date"></td>';
echo '<td><input type="submit" name="submit" value="Submit"></td>';
echo '</tr>';
echo '</table>';
echo '</form>';

// Close database connection
mysqli_close($conn);
?>
