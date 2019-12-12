
    <div class="col-md-12">
    <?php 

    if(isset($_SESSION['notices'])){

    $notices = $_SESSION['notices'];


    if(count($notices)>0){

     foreach($notices as $notice){
?>

<div class="alert <?php echo isset($notice['type'])?$notice['type']:"alert-primary";?>" role="alert">
  <?php echo $notice['msg'] ;?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>

    <?php 
        }
    }

    unset($_SESSION['notices']);

} ?>
</div>
