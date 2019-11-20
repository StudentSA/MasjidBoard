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

<section class="bankdetails">
    <table class="bankdetails_t" border="1" cellpadding="0" cellspacing="0">
        <tbody>
            <tr valign="middle" bgcolor="#000000"> 
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Bank</font></div></td>
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">[BANK NAME]</font></div></td>
            </tr>
            <tr valign="middle" bgcolor="#000000"> 
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Account Holder</font></div></td>
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">[Account Name]</font></div></td>
            </tr>
            <tr valign="middle" bgcolor="#000000"> 
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Branch Code</font></div></td>
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">[CODE]</font></div></td>
            </tr>
            <tr valign="middle" bgcolor="#000000"> 
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Account Number</font></div></td>
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">[ACC NUM]</font></div></td>
            </tr>
            <tr valign="middle" bgcolor="#000000"> 
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Referance</font></div></td>
                <td height="30"><div align="center"><font color="#FFFFFF" size="4">Lillah</font></div></td>
            </tr>
        </tbody>
    </table>
</section>

<section>
    <p>
	<pre>
        For Cash donations please contact:
        Brother [NAME]
        Cell: [NUM]

	Alternatively:
	Brother [NAME]
	Cell: [NUM]
	</pre>
    </p>
</section>

<?php include ("footer.php"); ?>
</body>
</html>
