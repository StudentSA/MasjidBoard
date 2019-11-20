<?php require("./config/config.php"); ?>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<div id="nav">
    <label for="show-menu" class="show-menu" id="toggle"><span></span></label>
    <input type="checkbox" id="show-menu" role="button">
<ul id="menu">
    <li id="myname"><span id="nav_name"> <?= strtoupper($masjidName) ?> - <?= strtoupper($masjidArea)?> </span></li>
    <li <?= ($activePage == 'register')    ? 'class="active"':''; ?> ><a href="./register.php">Register</a></li>
    <li <?= ($activePage == 'contact')    ? 'class="active"':''; ?> ><a href="./contact.php">Contact</a></li>
    <li <?= ($activePage == 'contribute')   ? 'class="active"':''; ?> ><a href="./contribute.php">Contribute</a></li>
    <li <?= ($activePage == 'livestreaming')   ? 'class="active"':''; ?> ><a href="./livestreaming.php">Live Streaming</a></li>
    <li <?= ($activePage == 'recordings')     ? 'class="active"':''; ?> ><a href="https://www.livemasjid.com/<?= $masjidStreamingMountName ?>">Recordings</a></li>
    <li <?= ($activePage == 'index')  ? 'class="active"':''; ?> ><a href="./index.php">Home</a></li>
</ul>
</div>
