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
    <link href="./css/handsontable.full.min.css" rel="stylesheet">

    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/handsontable.full.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function()
        {
            var year = <?=$sel_year?>;
            var month = <?=$sel_month?>;
            var container = document.getElementById('salaahtable');
            var hot = new Handsontable(container, {
                data: [],
                rowHeaders:[],
                rowHeaderWidth: 100,
                colHeaders: [ 'Fajr Athaan', 'Fajr Salaah', 'Zuhr Athaan', 'Zuhr Salaah', 'Asr Athaan', 'Asr Salaah',
                             'Magrib Athaan', 'Magrib Salaah', 'Esha Athaan', 'Esha Salaah', 'Jummah Athaan', 'Jummah Salaah'],
                columns: [
                    {data: 'fajr_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'fajr_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'zuhr_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'zuhr_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'asr_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'asr_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'magrib_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'magrib_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'esha_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'esha_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'jummah_athaan', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'jummah_salaah', type: 'time', timeFormat: 'HH:mm', correctFormat: true}
                ],
                filters: false,
                dropdownMenu: false,
                afterValidate: function (isValid, value, row, prop, source) {
                    if (!isValid) {
                        //disable save
                        $("#save-btn").prop('disabled', true);
                        $("#save-btn").removeClass("btn-success");
                        $("#save-btn").addClass("btn-danger");
                        $("#save-btn").addClass("not-allowed");
                        $("#save-btn").val("Fix Time Error");
                    } else {
                        //enable save
                        $("#save-btn").prop('disabled', false);
                        $("#save-btn").removeClass("btn-danger");
                        $("#save-btn").addClass("btn-success");
                        $("#save-btn").removeClass("not-allowed");
                        $("#save-btn").val("Save");
                    }
                },
                licenseKey: 'non-commercial-and-evaluation'
            });

            // For Loading
            jQuery.ajax({
                type: "GET",
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                'url':'api/get_salaah_times.php/',
                data: {year: year , month: month},
                'success': function (res) {
                    rows=$(res).map(function() {return this.sdate;}).get();
                    hot.loadData(res);
                    hot.updateSettings({rowHeaders:rows});
                    console.log("Data Loaded");
                },
                'error': function () {
                    console.log("Loading error");
                }
            });

            $("#save-btn").click(function(){
                //disable save
                $("#save-btn").prop('disabled', true);
                $("#save-btn").removeClass("btn-success");
                $("#save-btn").val("In Progress...");
                date_data = JSON.stringify(hot.getSettings().rowHeaders);
                salaah_data = JSON.stringify(hot.getData());
                jQuery.ajax({
                    type: "POST",
                    'url':'api/store_salaah_times.php',
                    data: {"year": year, "month": month, "salaah_data": salaah_data, "date_data": date_data},
                    'success': function () {
                        console.log("Data Saved");
                        $("#save-btn").prop('disabled', false);
                        $("#save-btn").addClass("btn-success");
                        $("#save-btn").val("Save");
                        alert("Data Saved");
                    },
                    'error': function () {
                        console.log("Saving error");
                        $("#save-btn").prop('disabled', false);
                        $("#save-btn").addClass("btn-success");
                        $("#save-btn").val("Save");
                        alert("Saving error");
                    }
                });
            });


           }
        );
    </script>
  </head>

  <body class="bg-light">

    <?php include ("navigation.php"); ?>

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
                <div id="salaahtable"></div>
            </div>
            <div class="row justify-content-md-center bg-light">&nbsp;</div>
            <div class="row justify-content-md-center bg-light">
                <input id="save-btn" class="btn btn-secondary save-btn" type="submit" value="Save"/>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
    </div>

  </body>
</html>
