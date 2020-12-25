<?php
    date_default_timezone_set("Africa/Johannesburg");
    $edate=date("l, j F");
?>
<section class="float-container">
    <div class="timebar">
        <div class="timebar-date"> <?= $edate ?> </div>
        <div class="timebar-date"> <div id="idate"> <script>document.write(writeIslamicDate());</script> </div> </div>
        <div class="timebar-date"> <div id="txt"></div> </div>
    </div>
</section>
