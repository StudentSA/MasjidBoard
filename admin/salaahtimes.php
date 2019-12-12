<?php include('session.php');?>
<?php require("../admin/db_info.php"); ?>
<?php
    if (isset($_GET['y'])) {
        $sel_year=$_GET['y'];
    }else{
        $sel_year=date("Y");
    }
    if (isset($_GET['m'])) {
        $sel_month=$_GET['m'];
    }else{
        $sel_month=date("m");
    }
    $curr_year=date("Y");
    $next_year=$curr_year+1;
    $dateObj   = DateTime::createFromFormat('!m', $sel_month);
    $sel_monthName = $dateObj->format('F'); 
    $url=strtok($_SERVER["REQUEST_URI"],'?');
    
    if(isset($_POST["time_table_id"])) {
        
        //var_dump($_POST);
        //var_dump($_GET['uid']);
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $conn = new mysqli($host, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $timeTablesId = $_POST['time_table_id'];
        

        foreach( $timeTablesId as $key=>$val){

                $fajr_athaan=$_POST["fajr_athaan"][$key].":00";
                $fajr_salaah=$_POST["fajr_salaah"][$key].":00";
                $zuhr_athaan=$_POST["zuhr_athaan"][$key].":00";
                $zuhr_salaah=$_POST["zuhr_salaah"][$key].":00";
                $asr_athaan=$_POST["asr_athaan"][$key].":00";
                $asr_salaah=$_POST["asr_salaah"][$key].":00";
                $magrib_athaan=$_POST["magrib_athaan"][$key].":00";
                $magrib_salaah=$_POST["magrib_salaah"][$key].":00";
                $esha_athaan=$_POST["esha_athaan"][$key].":00";
                $esha_salaah=$_POST["esha_salaah"][$key].":00";
                $jummah_athaan=$_POST["jummah_athaan"][$key].":00";
                $jummah_salaah=$_POST["jummah_salaah"][$key].":00";
                
                // sql to update a record
                $stmt = $conn->prepare("UPDATE m_timetable SET fajr_athaan=?,fajr_salaah=?,zuhr_athaan=?,zuhr_salaah=?,
                                        asr_athaan=?,asr_salaah=?,magrib_athaan=?,magrib_salaah=?,esha_athaan=?,esha_salaah=?,
                                        jummah_athaan=?,jummah_salaah=? WHERE uid=?");
                $stmt->bind_param("ssssssssssssi",$fajr_athaan , $fajr_salaah,
                                    $zuhr_athaan, $zuhr_salaah, 
                                    $asr_athaan, $asr_salaah, 
                                    $magrib_athaan, $magrib_salaah, 
                                    $esha_athaan, $esha_salaah, 
                                    $jummah_athaan, $jummah_salaah, 
                                    $val );
                $stmt->execute();
        }

        $stmt->close();
        $conn->close();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../kaba.ico">

    <title>Musjid Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="./css/table.css" rel="stylesheet">
    
    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script> 
    <script type="text/javascript" src="./js/jquery.plugin.js"></script> 
    <script type="text/javascript" src="./js/jquery.timeentry.js"></script>
    <script type="text/javascript">
        $(document).ready(function() 
        { 
            var timepickers = $('.timepicker').timeEntry({show24Hours: true,spinnerImage: '',beforeSetTime: colorBlocks});
            
            function colorBlocks(oldTime, newTime, minTime, maxTime) {  
                var otime = $(this)[0].getAttribute('ovalue');
                var ntime= ('0' + newTime.getHours()).slice(-2) + ":" + ('0' + newTime.getMinutes()).slice(-2);
                console.log("Ntime: "+ntime);
                console.log("Otime: "+otime);
                if ( ntime !== otime) { 
                    $(this).css("background-color", "red");
                } else {
                    $(this).css("background-color", "white");
                }
                return newTime; 
            }
        } 
        ); 
    </script>
  </head>

  <body>
  
    <?php include ("navigation.php"); ?>
    
    <!-- Begin page content -->
    <main role="main" class="container">
    <div class="container-fluid">
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">    
            <div class="row">&nbsp;</div>
            <div class="row justify-content-md-center bg-light">
                    <h1 class="display-4">Salaah Time Management</h1>
            </div>
            <div class="row justify-content-md-center bg-light">
                <div class="col-3"></div>
                <div class="col-2 ml-auto">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Year
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo $url."?y=".$curr_year."&m=".$sel_month ?>"><?= $curr_year ?></a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$next_year."&m=".$sel_month ?>"><?= $next_year ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-1"><span id="year" class="align-middle font-weight-bold"> <?= $sel_year ?> </span></div>
                <div class="col-2">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Month
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=1" ?>">January</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=2" ?>">February</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=3" ?>">March</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=4" ?>">April</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=5" ?>">May</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=6" ?>">June</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=7" ?>">July</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=8" ?>">August</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=9" ?>">September</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=10" ?>">October</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=11" ?>">November</a>
                            <a class="dropdown-item" href="<?php echo $url."?y=".$sel_year."&m=12" ?>">December</a>
                        </div>
                    </div>
                </div>
                <div class="col-1"><span id="month" class="align-middle font-weight-bold"> <?= $sel_monthName ?> </span></div>
                <div class="col-3"></div>
            </div>
            <div class="row justify-content-md-center bg-light">&nbsp;</div>
            <div class="row justify-content-md-center bg-light">
                <?php
                    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
                    $conn = new mysqli($host, $username, $password, $database);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    } 
                    
                    $sql = "select uid,sdate, 
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
                    
                    if ($result->num_rows > 0) {
                        echo "<form  method=\"post\" action=\"".$url."?y=".$sel_year."&m=".$sel_month."&uid=".$row["uid"]."\">
                        <table>";
                        echo "<thead>";
                        echo "<tr><td colspan=\"13\"  class=\"align-right\"><input class=\"btn btn-secondary save-btn \" type=\"submit\" value=\"Save\" /></td></tr>";

                        echo "<tr>
                                    <th style=\"width: 70px;\">Date</th>
                                    <th>Fajr Athaan</th>
                                    <th>Fajr Salaah</th>
                                    <th>Zuhr Athaan</th>
                                    <th>Zuhr Salaah</th>
                                    <th>Asr Athaan</th>
                                    <th>Asr Salaah</th>
                                    <th>Magrib Athaan</th>
                                    <th>Magrib Salaah</th>
                                    <th>Esha Athaan</th>
                                    <th>Esha Salaah</th>           
                                    <th>Jummah Athaan</th>
                                    <th>Jummah Salaah</th>
                                    
                             </tr>";       
                        echo "</thead>";
                        echo "<tbody>";              
                        // output data of each row

                      

                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td colspan=\"13\"><table><tr>
                                    <td>" . $row["sdate"] . "</td>
                                 
                                    <td><input type=\"hidden\" name=\"time_table_id[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["uid"] . "\" value=\"" . $row["uid"]  . "\"/>
                                    <input type=\"text\" name=\"fajr_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["fajr_athaan"] . "\" value=\"" . $row["fajr_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"fajr_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["fajr_salaah"] . "\" value=\"" . $row["fajr_salaah"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"zuhr_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["zuhr_athaan"] . "\" value=\"" . $row["zuhr_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"zuhr_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["zuhr_salaah"] . "\" value=\"" . $row["zuhr_salaah"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"asr_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["asr_athaan"] . "\" value=\"" . $row["asr_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"asr_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["asr_salaah"] . "\" value=\"" . $row["asr_salaah"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"magrib_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["magrib_athaan"] . "\" value=\"" . $row["magrib_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"magrib_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["magrib_salaah"] . "\" value=\"" . $row["magrib_salaah"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"esha_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["esha_athaan"] . "\" value=\"" . $row["esha_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"esha_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["esha_salaah"] . "\" value=\"" . $row["esha_salaah"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"jummah_athaan[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["jummah_athaan"] . "\" value=\"" . $row["jummah_athaan"]  . "\"/></td>
                                    <td><input type=\"text\" name=\"jummah_salaah[]\" id=\"timepicker".$row["uid"]."fa"."\" class=\"timepicker\" ovalue=\"" . $row["jummah_salaah"] . "\" value=\"" . $row["jummah_salaah"]  . "\"/></td>
                                 
                                 </tr></table></td></tr>";
                        }
                        echo "<tr><td colspan=\"13\" class=\"align-right\"><input class=\"btn btn-secondary  save-btn \" type=\"submit\" value=\"Save\" /></td></tr>";

                        echo "</tbody>";
                        echo "</table></form>";
                    } else {
                        echo "Table Empty - 0 results";
                    }
                    
                    $conn->close();
                ?>
            </div>
            <div class="row">&nbsp;</div>
        </div>
        <div class="col-1"></div>
    </div>
    </div>
    </main>
    
  </body>
</html>
