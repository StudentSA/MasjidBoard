<?php require("config/config.php"); ?>
<section id="notice-container" class="float-container">
    <h1 class="tch snotice">Notifications</h1>
</section>
<?php
   $sql = "SELECT * from notices ORDER BY start_date ASC";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) {
?>
<div class="float-box-fluid Asr">
  <h5 class="card-header"><?php echo $row['title'];?></h5>
  <div class="card-body">
    <p class="card-text"><?php echo $row['description'];?></p>
    
  </div>
</div>
<?php 
        }
   }    
?>
