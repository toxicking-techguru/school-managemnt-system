<?php

include('dbcon.php');

if(isset($_POST['register'])){
    
    $username = mysqli_real_escape_string($con,$_POST['uname']);
    $password = mysqli_real_escape_string($con,$_POST['pass']);
    
    $qry = "INSERT INTO `admin`(`username`, `password`) VALUES ('$username','$password')";
    
    $run = mysqli_query($con,$qry);
    
    if($run)
    {
        ?>
        <script>
            alert('Registration Successful');
            window.open('login.php','_self')
</script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Registration Failed');
            window.open('register.php','_self')
</script>
        <?php
    }
}

?>
