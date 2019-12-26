<?php require("../db_info.php"); ?>
<?php
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $conn = new mysqli($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select month, date,
             DATE_FORMAT(sehri, \"%H:%i\") as sehri,
             DATE_FORMAT(fajr, \"%H:%i\") as fajr,
             DATE_FORMAT(sunrise, \"%H:%i\") as sunrise,
             DATE_FORMAT(zawal, \"%H:%i\") as zawal,
             DATE_FORMAT(asr_s, \"%H:%i\") as asr_s,
             DATE_FORMAT(asr_h, \"%H:%i\") as asr_h,
             DATE_FORMAT(maghrib, \"%H:%i\") as maghrib,
             DATE_FORMAT(esha, \"%H:%i\") as esha
             from p_timetable
             order by month,date asc";
    $result = $conn->query($sql);

    $json_response = array();
    //while($row = mysqli_fetch_array($result)) {
    while($row = $result->fetch_assoc()) {
        array_push($json_response,$row);
    }

    $conn->close();
    header('Content-Type: application/json');
    echo json_encode($json_response);
?>
