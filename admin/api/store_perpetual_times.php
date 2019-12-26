<?php require("../db_info.php"); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['perpetual_data']) ) {
	$salaah_data= json_decode($_POST['perpetual_data']);
        if (count($salaah_data) === 366) {
            // Establishing Connection with Server by passing server_name, user_id and password as a parameter
            $conn = new mysqli($host, $username, $password, $database);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            //Itterate over the data and store.
            $sql = "INSERT INTO p_timetable (month, date, sehri, fajr, sunrise, zawal, asr_s, asr_h, maghrib, esha)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE
                month = ?, date = ?, sehri = ?, fajr = ?,
                sunrise = ?, zawal = ?, asr_s = ?, asr_h = ?, maghrib = ?, esha = ?";

            $stmt = $conn->prepare($sql);
            if ( $stmt===false ) {
                echo "Error in Prepare";
            }
            foreach ($salaah_data as $row) {
                $bind_values = array_merge($row, $row);
                //var_dump($bind_values);
                $bind_res = $stmt->bind_param("ssssssssssssssssssss", ...$bind_values);
                if ( $bind_res ) {
                    $stmt->execute();
                    //echo "UPDATE EXECUTED!";
                } else {
                    echo "ERROR in bind";
                }
            }
            $stmt->close();

        } else {
            echo "Appears to be too much data?" . count($salaah_data);
        }
        echo "Done";
    }
}
?>
