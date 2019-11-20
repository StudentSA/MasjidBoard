<!DOCTYPE html>
<?php require("./config/config.php"); ?>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/styles.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400|Ubuntu:300" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="kaba.ico">
    <script type="text/javascript" src="./js/islamicdate.js"></script>
    <script type="text/javascript" src="./js/livetime.js"></script>
    <title><?= $masjidName ?> - <?= $masjidArea?></title>
</head>
<body onload="startTime()">
<?php include ("navigation.php"); ?>
<?php include ("timebar.php"); ?>


<div style="height:50px"> </div>

<section class="livestreaming">
    <embed src="http://livemasjid.com/minimount.php?mount=<?= $masjidStreamingMountName ?>" width="400" height="150"></embed>
</section>

<section class="livestreaming">
<p> To stream this masjid directly from livemasjid.com please visit <a style="color:blue" href="http://livemasjid.com/<?= $masjidStreamingMountName ?>"> <?= $masjidStreamingMountName ?> </a>.
</section>



<?php include ("footer.php"); ?>
</body>
</html>
