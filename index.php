<!DOCTYPE html>
<?php require("./config/config.php"); ?>
<?php 
    date_default_timezone_set("Africa/Johannesburg");
    $date_now=time();
    $tomorrow = strtotime("tomorrow 00:00:00");
    $seconds_remaining = ($tomorrow-$date_now)+5;
?>
<html lang="en-us">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap core CSS -->
 <link href="./admin/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./css/styles.css" />
<link rel="stylesheet" type="text/css" href="./css/colors.css" />
 
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Ubuntu:300" rel="stylesheet">
<link rel="shortcut icon" type="image/x-icon" href="kaba.ico">
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./js/islamicdate.js"></script>
<script type="text/javascript" src="./js/livetime.js"></script>
<title><?= $masjidName ?> - <?= $masjidArea?></title>
<meta http-equiv="refresh" content="<?= $seconds_remaining ?>">
</head>
<body onload="startTime()">
<?php include ("navigation.php"); ?>
<?php #Get Salaah Times for today.
    $date_now=date("Y-m-d");
    $month=date("m");
    $date=date("d");
    $day=date("l");
    $edate=date("l, j F");
    // Establishing Connection with Server by passing server_name, user_id and password as a parameter
    $conn = new mysqli($host, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed to DB: " . $conn->connect_error);
    }
    $sehri_end=null;
    $sunrise=null;
    $zawwal=null;
    $perpetual_magrib_athaan=null;

    $fajr_athaan=null;
    $fajr_salaah=null;
    $zuhr_athaan=null;
    $zuhr_salaah=null;
    $asr_athaan=null;
    $asr_salaah=null;
    $magrib_athaan=null;
    $magrib_salaah=null;
    $esha_athaan=null;
    $esha_salaah=null;
    $jummah_athaan=null;
    $jummah_salaah=null;

    $fajr_c_date=null;
    $fajr_c_athaan=null;
    $fajr_c_salaah=null;

    $asr_c_date=null;
    $asr_c_athaan=null;
    $asr_c_salaah=null;

    $esha_c_date=null;
    $esha_c_athaan=null;
    $esha_c_salaah=null;

    $changeperiod=$displayChangesWithinDays;

    if ($stmt = $conn->prepare("select fajr_athaan, fajr_salaah, zuhr_athaan, zuhr_salaah, asr_athaan, asr_salaah, magrib_athaan, magrib_salaah, esha_athaan, esha_salaah, jummah_athaan, jummah_salaah FROM m_timetable where sdate =?")) {
        /* bind parameters for markers */
        $stmt->bind_param("s", $date_now);
        /* execute query */
        $stmt->execute();
        /* bind result variables */
        $stmt->store_result();
        /* fetch value */
        if ($stmt->num_rows == 1) {
          $stmt->bind_result($fajr_athaan, $fajr_salaah, $zuhr_athaan, $zuhr_salaah, $asr_athaan, $asr_salaah, $magrib_athaan, $magrib_salaah, $esha_athaan, $esha_salaah, $jummah_athaan, $jummah_salaah);
          $stmt->fetch();
        }
        /* close stmt */
        $stmt->close();
    }

    if ($stmt = $conn->prepare("select sehri, sunrise, zawal, maghrib FROM p_timetable where month = ? and date =? ")) {
        /* bind parameters for markers */
        $stmt->bind_param("ii", $month, $date);
        /* execute query */
        $stmt->execute();
        /* bind result variables */
        $stmt->store_result();
        /* fetch value */
        if ($stmt->num_rows == 1) {
          $stmt->bind_result($sehri_end, $sunrise, $zawwal,  $perpetual_magrib_athaan);
          $stmt->fetch();
        }
        /* close stmt */
        $stmt->close();
    }

    //Use Perpetual Time for Magrib if enabled.
    if ($enableSalaahTimeChanges) {
        $magrib_athaan = $perpetual_magrib_athaan;
        $magrib_salaah = date('h:i',(strtotime($perpetual_magrib_athaan) + ($magribSalaahMinutesOffset*60)));
    }

    if ($enableSalaahTimeChanges) {
        /*Get Fajr Change date */
        if ($stmt = $conn->prepare("
                SELECT a.sdate,a.fajr_athaan,a.fajr_salaah FROM m_timetable AS a WHERE
                (a.fajr_athaan <> (
                    SELECT b.fajr_athaan
                    FROM m_timetable AS b
                    WHERE
                    a.sdate > b.sdate
                    ORDER BY b.sdate DESC
                    LIMIT 1
                ) or 
                a.fajr_salaah <> (
                    SELECT b.fajr_salaah
                    FROM m_timetable AS b
                    WHERE
                    a.sdate > b.sdate
                    ORDER BY b.sdate DESC
                    LIMIT 1
                ))
                and a.sdate >= NOW()
                and a.sdate <  NOW() + INTERVAL ? DAY
                limit 1
        ")) {
            /* bind parameters for markers */
            $stmt->bind_param("i", $changeperiod);
            /* execute query */
            $stmt->execute();
            /* bind result variables */
            $stmt->store_result();
            /* fetch value */
            if ($stmt->num_rows == 1) {
              $stmt->bind_result($fajr_c_date,$fajr_c_athaan,$fajr_c_salaah);
              $stmt->fetch();
            }
            /* close stmt */
            $stmt->close();
        }

        /*Get Asr Change date */
        if ($stmt = $conn->prepare("
                SELECT a.sdate,a.asr_athaan,a.asr_salaah FROM m_timetable AS a WHERE
                a.asr_athaan <> (
                    SELECT b.asr_athaan
                    FROM m_timetable AS b
                    WHERE
                    a.sdate > b.sdate
                    ORDER BY b.sdate DESC
                    LIMIT 1
                )
                and a.sdate >= NOW()
                and a.sdate <  NOW() + INTERVAL ? DAY
                limit 1
        ")) {
            /* bind parameters for markers */
            $stmt->bind_param("i", $changeperiod);
            /* execute query */
            $stmt->execute();
            /* bind result variables */
            $stmt->store_result();
            /* fetch value */
            if ($stmt->num_rows == 1) {
              $stmt->bind_result($asr_c_date,$asr_c_athaan,$asr_c_salaah);
              $stmt->fetch();
            }
            /* close stmt */
            $stmt->close();
        }

        /*Get Esha Change date */
        if ($stmt = $conn->prepare("
                SELECT a.sdate,a.esha_athaan,a.esha_salaah FROM m_timetable AS a WHERE
                a.esha_athaan <> (
                    SELECT b.esha_athaan
                    FROM m_timetable AS b
                    WHERE
                    a.sdate > b.sdate
                    ORDER BY b.sdate DESC
                    LIMIT 1
                )
                and a.sdate >= NOW()
                and a.sdate <  NOW() + INTERVAL ? DAY
                limit 1
        ")) {
            /* bind parameters for markers */
            $stmt->bind_param("i", $changeperiod);
            /* execute query */
            $stmt->execute();
            /* bind result variables */
            $stmt->store_result();
            /* fetch value */
            if ($stmt->num_rows == 1) {
              $stmt->bind_result($esha_c_date,$esha_c_athaan,$esha_c_salaah);
              $stmt->fetch();
            }
            /* close stmt */
            $stmt->close();
        }
    }
?>
<?php include ("timebar.php"); ?>

<section class="float-container">

    <div class="float-box Fajr">
        <div class="box-title">Fajr Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($fajr_athaan)) ?></div>
        <div class="box-title">Fajr Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($fajr_salaah)) ?></div>
    </div>

    <div class="float-box Zuhr">
        <div class="box-title">Zuhr Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($zuhr_athaan)) ?></div>
        <div class="box-title">Zuhr Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($zuhr_salaah)) ?></div>
    </div>

    <div class="float-box Asr">
        <div class="box-title">Asr Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($asr_athaan)) ?></div>
        <div class="box-title">Asr Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($asr_salaah)) ?></div>
    </div>

    <div class="float-box Maghrib">
        <div class="box-title">Maghrib Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($magrib_athaan)) ?></div>
        <div class="box-title">Maghrib Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($magrib_salaah)) ?></div>
    </div>

    <div class="float-box Esha">
        <div class="box-title">Esha Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($esha_athaan)) ?></div>
        <div class="box-title">Esha Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($esha_salaah)) ?></div>
    </div>

    <div class="float-box Jumuah">
        <div class="box-title">Jummah Azaan</div>
        <div class="box-time box-break"><?= date('h:i',strtotime($jummah_athaan)) ?></div>
        <div class="box-title">Jummah Salaah</div>
        <div class="box-time"><?= date('h:i',strtotime($jummah_salaah)) ?></div>
    </div>

</section>

<section class="float-container">

    <div class="float-box Black">
        <div class="box-title">Sehri Ends</div>
        <div class="box-time"><?= date('h:i',strtotime($sehri_end)) ?></div>
    </div>

    <div class="float-box Black">
        <div class="box-title">Sunrise</div>
        <div class="box-time"><?= date('h:i',strtotime($sunrise)) ?></div>
    </div>

    <div class="float-box Black">
        <div class="box-title">Ishraaq</div>
        <div class="box-time"><?= date('h:i',strtotime('+12 minutes',strtotime($sunrise))) ?></div>
    </div>

    <div class="float-box Zawwal">
        <div class="box-title">Zawwal</div>
        <div class="box-time"><?= date('h:i',strtotime($zawwal)-180) ?>-<?= date('h:i',strtotime($zawwal)+120) ?></div>
    </div>

</section>
<?php
    if ($enableZuhrChanges) {
        include ("includes/zuhrchangebanner.php");
    }

    if ($enableSalaahTimeChanges) {
        include ("includes/salaahtimechanges.php");
    }

    
        include ("includes/notifications.php");
    
?>

<div style="height='30px'">
    <h1>&nbsp;</h1>
</div>

<?php include ("footer.php"); ?>
</body>
</html>
