<?php require("../db_info.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['year']) && isset($_POST['month']) && isset($_POST['salaah_data']) && isset($_POST['date_data']) ) {
        $year= $_POST['year'];
        $month= $_POST['month'];
	$salaah_data= json_decode($_POST['salaah_data']);
	$date_data= json_decode($_POST['date_data']);
        if (count($salaah_data) === count($date_data)) {
            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
            $conn = new mysqli($host, $username, $password, $database);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //Prepare SQL query
            $sql = "INSERT INTO m_timetable (sdate,fajr_athaan,fajr_salaah,zuhr_athaan,zuhr_salaah,asr_athaan,asr_salaah,
                magrib_athaan,magrib_salaah,esha_athaan,esha_salaah,jummah_athaan,jummah_salaah)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE
                fajr_athaan = ?, fajr_salaah = ?,
                zuhr_athaan = ?, zuhr_salaah = ?,
                asr_athaan = ?, asr_salaah = ?,
                magrib_athaan = ?, magrib_salaah = ?,
                esha_athaan = ?, esha_salaah = ?,
                jummah_athaan = ?, jummah_salaah = ?";

            $stmt = $conn->prepare($sql);
            if ( $stmt===false ) {
                echo "Error in Prepare";
            }
            //Itterate over the data and store.
            foreach ($date_data as $key=>$date) {
                //echo "$key - $date - $salaah_data[$key] <br>";
                $bind_values = array_merge(array($date), $salaah_data[$key], $salaah_data[$key]);
                //var_dump($bind_values);
                $bind_res = $stmt->bind_param("sssssssssssssssssssssssss", ...$bind_values);
                if ( $bind_res ) {
                    $stmt->execute();
                    //echo "UPDATE EXECUTED!";
                } else {
                    echo "ERROR in bind";
                }
            }
            $stmt->close();
            echo "Done";
        }
    }
}
?>
