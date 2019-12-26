<?php require("../db_info.php"); ?>
<?php
    if (isset($_GET['year'])) {
        $sel_year=$_GET['year'];
    }else{
        $sel_year=date("Y");
    }
    if (isset($_GET['month'])) {
        $sel_month=$_GET['month'];
    }else{
        $sel_month=date("m");
    }

    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $conn = new mysqli($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "select sdate,
            DATE_FORMAT(fajr_athaan, \"%H:%i\") as fajr_athaan, DATE_FORMAT(fajr_salaah, \"%H:%i\") as fajr_salaah,
            DATE_FORMAT(zuhr_athaan, \"%H:%i\") as zuhr_athaan, DATE_FORMAT(zuhr_salaah, \"%H:%i\") as zuhr_salaah,
            DATE_FORMAT(asr_athaan, \"%H:%i\") as asr_athaan, DATE_FORMAT(asr_salaah, \"%H:%i\") as asr_salaah,
            DATE_FORMAT(magrib_athaan, \"%H:%i\") as magrib_athaan, DATE_FORMAT(magrib_salaah, \"%H:%i\") as magrib_salaah,
            DATE_FORMAT(esha_athaan, \"%H:%i\") as esha_athaan, DATE_FORMAT(esha_salaah, \"%H:%i\") as esha_salaah,
            DATE_FORMAT(jummah_athaan, \"%H:%i\") as jummah_athaan, DATE_FORMAT(jummah_salaah, \"%H:%i\") as jummah_salaah
            from m_timetable
            where YEAR(sdate) = $sel_year AND MONTH(sdate) = $sel_month
            order by sdate asc";
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
