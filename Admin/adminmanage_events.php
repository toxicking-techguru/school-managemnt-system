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
include('titleheader.php');

//Add event functionality
if(isset($_POST['add_event'])) {
    $con = mysqli_connect('localhost', 'root', '', 'sms');

    if($con == false){
        echo "Connection not successful";
    }
    
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    
    $qry = "INSERT INTO `school_calendar`(`event_name`, `event_date`) VALUES ('$event_name', '$event_date')";
    $run = mysqli_query($con, $qry);
    
    if($run == true){
        ?>
        <script>
            alert('Event added successfully');
            window.open('adminmanage_events.php', '_self');
        </script>
        <?php
    }
}

//Delete event functionality
if(isset($_POST['delete_event'])) {
    $con = mysqli_connect('localhost', 'root', '', 'sms');

    if($con == false){
        echo "Connection not successful";
    }
    
    $event_id = $_POST['event_id'];
    
    $qry = "DELETE FROM `school_calendar` WHERE `id`='$event_id'";
    $run = mysqli_query($con, $qry);
    
    if($run == true){
        ?>
        <script>
            alert('Event deleted successfully');
            window.open('adminmanage_events.php', '_self');
        </script>
        <?php
    }
}

?>

<br><h1 align="center"> School Calendar</h1><br>
<div>
    <form method="post" action="adminmanage_events.php">
        <table align="center" border="1" style="width:70%; margin-top:40px;">
            <tr>
                <th>Event Name</th>
                <td><input type="text" name="event_name" placeholder="Enter Event Name" required></td>
            </tr>
            <tr>
                <th>Event Date</th>
                <td><input type="date" name="event_date" placeholder="Enter Event Date" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="add_event" value="Add Event"></td>
            </tr>
        </table>
    </form>
</div>

<div style="margin-top: 40px">
    <table align="center" border="1" style="width:70%">
        <tr>
            <th>Event ID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Action</th>
        </tr>
        <?php
        $con = mysqli_connect('localhost','root','','sms');

        if($con == false){
            echo "Connection not successful";
        }

        $qry = "SELECT * FROM `school_calendar`";
        $run = mysqli_query($con,$qry);
        
        if(mysqli_num_rows($run) > 0) {
            while($data = mysqli_fetch_assoc($run)) {
                ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['event_name']; ?></td>
                    <td><?php echo $data['event_date']; ?></td>
                    <td>
                        <form method="post" action="adminmanage_events.php">
<input type="hidden" name="event_id" value="<?php echo $data['id']; ?>">
<input type="submit" name="delete_event" value="Delete">
</form>
</td>
</tr>
<?php
         }
     }
     ?>
</table>

</div>






