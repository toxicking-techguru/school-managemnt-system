<?php
session_start();

if(isset($_SESSION['uid'])) {
    header('location:admin/admindash.php');
}
?>

<!DOCTYPE html>
<html lang="en_US">
    <head>
        <meta charset="UTF-8">
        <title>Admin Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }
            h1 {
                text-align: center;
            }
            form {
                max-width: 400px;
                margin: 0 auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.2);
            }
            table {
                width: 100%;
            }
            td:first-child {
                width: 30%;
            }
            input[type="text"], input[type="password"] {
                padding: 10px;
                width: 100%;
                border: 1px solid #ccc;
                border-radius: 5px;
                margin-bottom: 10px;
            }
            input[type="submit"] {
                background-color: #4CAF50;
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }
            input[type="submit"]:hover {
                background-color: #3e8e41;
            }
        </style>
    </head>
    <body>
        <h1>Admin Login</h1>
        <form action="login.php" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="uname"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="login" value="Login"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

<?php
include('dbcon.php');

if(isset($_POST['login'])){
    
    $username = mysqli_real_escape_string($con,$_POST['uname']);
    $password = mysqli_real_escape_string($con,$_POST['pass']);
    
    $qry = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
    
    $run = mysqli_query($con,$qry);
    
    $row = mysqli_num_rows($run);
    
    if($row>=1)
    {
        $data = mysqli_fetch_assoc($run);
        $id = $data['id'];
        
        $_SESSION['uid']=$id;
        
        header('location:admin/admindash.php');
    }
    else
    {
?>
        <script>
            alert('Username Or Password Dont match');
            window.open('login.php','_self')
        </script>
<?php
    }
}
?>
