<!--

This file stores the global configuration for the website to allow it to be reused

-->

<?php

//

//Site Information

//

    $masjidName = "Jummah Masjid";

    $masjidArea = "XYZ";



    $masjidAddress = "Number Road, Area, City, Provence, Country";

    $masjidGoogleMapsLink = "https://goo.gl/...";



    $masjidWebsiteURL = "http://www.masjid.com/";
    $masjidStreamingMountName = "masjid";

    //Is Jummah Performed?
    $enableJummahTime=true;

    //Does zuhr time chnage on Sundays and Public Holidays? if so, please specify the times.

    $enableZuhrChanges=true;

    $zuhr_athaan_change = "12:30";

    $zuhr_salaah_change = "12:45";

    //Use Perpetual Calender for Magrib time otherwise database masjid timetable will be used/
    $enablePerpetualMagrib=false;
    //The Athan will display as per perpetual with Salaah delay set below.
    $magribSalaahMinutesOffset=0;


    //Display salaah times changes?

    $enableSalaahTimeChanges=true;

    $displayChangesWithinDays=22;



    //Display configured notices?

    $enableNoticeBoard=true;



//

//Database Information - Place where salaah times and perpetual calanders are stored

//

    $host="localhost";

    $username="masjid";

    $password="somestrongpassword";

    $database="masjid_board";


?>

