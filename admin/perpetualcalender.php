<?php include('session.php');?>
<?php require("../admin/db_info.php"); ?>
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
            var container = document.getElementById('salaahtable');
            var hot = new Handsontable(container, {
                data: [],
                colHeaders: [ 'Month', 'Day', 'Sehri', 'Fajr', 'Sunrise', 'Zawal',
                             'Asr Shafi', 'Asr Hanafi', 'Maghrib', 'Esha'],
                columns: [
                    {data: 'month', type: 'numeric', readOnly: true},
                    {data: 'date', type: 'numeric', readOnly: true},
                    {data: 'sehri', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'fajr', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'sunrise', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'zawal', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'asr_s', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'asr_h', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'maghrib', type: 'time', timeFormat: 'HH:mm', correctFormat: true},
                    {data: 'esha', type: 'time', timeFormat: 'HH:mm', correctFormat: true}
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
                'url':'api/get_perpetual_times.php/',
                'success': function (res) {
                    hot.loadData(res);
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
                salaah_data = JSON.stringify(hot.getData());
                jQuery.ajax({
                    type: "POST",
                    'url':'api/store_perpetual_times.php',
                    data: {"perpetual_data": salaah_data},
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
                    <h1 class="display-4">Perpetual Calender Management</h1>
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
