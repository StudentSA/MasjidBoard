<?php require("../admin/db_info.php"); ?>
<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$conn = new mysqli($host, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

session_start();// Starting Session
// Storing Session
if (isset($_SESSION['login_user'])){
    $user_check=$_SESSION['login_user'];
} else {
    $user_check="";
}
// SQL Query To Fetch Complete Information Of User
$sql = "select username from admin where username='$user_check'";
$result = mysqli_query($conn, $sql);

if ($result->num_rows != 1) {
    // output data of each row
    $conn->close();
    header('Location: index.php'); // Redirecting To Home Page
} else {
    $login_session = $user_check;
}

?>