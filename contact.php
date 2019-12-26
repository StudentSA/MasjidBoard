<!DOCTYPE html>
<?php require("./config/config.php"); ?>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css" />
    <link rel="stylesheet" type="text/css" href="./css/colors.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Ubuntu:300" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="kaba.ico">
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/islamicdate.js"></script>
    <script type="text/javascript" src="./js/livetime.js"></script>
    <title><?= $masjidName ?> - <?= $masjidArea?></title>
</head>
<body onload="startTime()">
<?php include ("navigation.php"); ?>
<?php include ("timebar.php"); ?>

<section class="contactdetails">
    <h3>Contact Details</h3>
    <table class="bankdetails_t" border="1" cellpadding="0" cellspacing="0" style="width:500px">
        <tbody>
            <tr>
                <td colspan=2><b>Molana XYZ</b></td>
            </tr>
            <tr>
                <td><b>Cell:</b></td>
                <td><i>083 123 4567</i></td>
            </tr>
            <tr>
                <td><b>Tel:</b></td>
                <td><i>tbd</i></td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td><i>tbd</i></td>
            </tr>
            <tr>
                <td colspan=2>&nbsp;</td>
            </tr>
        </tbody>
    </table>

</section>

<?php include ("footer.php"); ?>
</body>
</html>
