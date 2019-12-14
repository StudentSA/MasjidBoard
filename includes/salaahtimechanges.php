<?php require("config/config.php"); ?>
<section id="notice-container" class="float-container">
    <h1 class="tch snotice">Salaah Time Changes</h1>
</section>

<section class="float-container">

<div class="change-box Grey">
    <div class="block-title">Fajr</div>
    <div class="changes full-width"><div class="change-date"  > <?php echo ((!empty($fajr_c_date))?date('l jS F',strtotime($fajr_c_date)):'') ?>  </div></div>
    <div class="changes half-width"><div class="azaan-change" > <?php echo ((!empty($fajr_c_athaan))?date('h:i',strtotime($fajr_c_athaan)):'') ?> </div></div>
    <div class="changes half-width"><div class="jamaat-change"> <?php echo ((!empty($fajr_c_salaah))?date('h:i',strtotime($fajr_c_salaah)):'') ?> </div></div>
</div>

<div class="change-box Grey">
    <div class="block-title">Asr</div>
    <div class="changes full-width"><div class="change-date"  > <?php echo ((!empty($asr_c_date))?date('l jS F',strtotime($asr_c_date)):'') ?>  </div></div>
    <div class="changes half-width"><div class="azaan-change" > <?php echo ((!empty($asr_c_athaan))?date('h:i',strtotime($asr_c_athaan)):'') ?> </div></div>
    <div class="changes half-width"><div class="jamaat-change"> <?php echo ((!empty($asr_c_salaah))?date('h:i',strtotime($asr_c_salaah)):'') ?> </div></div>
</div>

<div class="change-box Grey">
    <div class="block-title">Esha</div>
    <div class="changes full-width"><div class="change-date"  > <?php echo ((!empty($esha_c_date))?date('l jS F',strtotime($esha_c_date)):'') ?>  </div></div>
    <div class="changes half-width"><div class="azaan-change" > <?php echo ((!empty($esha_c_athaan))?date('h:i',strtotime($esha_c_athaan)):'') ?> </div></div>
    <div class="changes half-width"><div class="jamaat-change"> <?php echo ((!empty($esha_c_salaah))?date('h:i',strtotime($esha_c_salaah)):'') ?> </div></div>
</div>

</section>