<?php require("../admin/db_info.php"); ?>
<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $uusername and $upassword
$uusername=$_POST['username'];
$upassword=$_POST['password'];

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// To protect MySQL injection for Security purpose
$uusername = stripslashes($uusername);
$upassword = stripslashes($upassword);
$uusername = mysqli_real_escape_string($conn, $uusername);
$upassword = mysqli_real_escape_string($conn, $upassword);

$sql = "select * from admin where password='$upassword' AND username='$uusername'";
$result = mysqli_query($conn, $sql);
print ($result->num_rows);
if ($result->num_rows == 1) {
    $_SESSION['login_user']=$uusername; // Initializing Session
    echo "<script> location.href='/admin/salaahtimes.php'; </script>";
} else {
    $error = "Username or Password is invalid";
}
$conn->close();
}
}
?>