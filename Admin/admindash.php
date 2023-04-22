<?php

session_start();
if(isset($_SESSION['uid']))
{
    echo "";
}
else{
    header('location: ../login.php');
}
 

include('header.php');
?>
    <div class="admintitle" align="center">
    <h4><a href="/logout.php" style="float:right; margin-right:30px; color:#fff; font-size:20px;">Logout</a></h4>
    <h1  align="center"> Welcome To Admin Dashboard </h1>
</div>

    
    <div class="dashboard">
        <table style="width:50%;" align="center">
            <tr>
                <td> 1.</td><td><a href="addstudent.php">add new student to the student</a></td>
            </tr>
            <tr>
                
                <td> 2.</td><td><a href="updatestudent.php">Update Student</a></td>
            </tr>
            <tr>
                <td> 4.</td><td><a href="deletestudent.php">Delete Student</a></td>
            </tr>
            <tr>
                <td> 5.</td><td><a href="adminmanage_events.php">manage school callender(add/delete) </a></td>
            </tr>
            <tr>
                <td> 6.</td><td><a href="addstudent_toClass.php">asignstudent to class  </a></td>
            </tr>
            <tr>
                <td> 7.</td><td><a href="attendance.php">amark student absent or present  </a></td>
            </tr>

            <tr>
                <td> 8.</td><td><a href="sms.php">sms  </a></td>
            </tr>
</body>
</html>
