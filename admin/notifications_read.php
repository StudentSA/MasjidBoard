<?php include('session.php');?>
<?php require("../admin/db_info.php"); ?>
<?php
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: notifications_index.php");
    } else {
        $sql = "SELECT * from notices WHERE id = ".(int)$id;

        $result = $conn->query($sql);
       
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
        }else{
            $_SESSION['notices'][] = array("msg"=>"Notice not found!","type"=>"alert-danger");
            header("Location: notifications_index.php");
        }
       
    }
?>
<!DOCTYPE html>
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
    
    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script> 
 
  </head>

 
<body>
<?php include ("navigation.php"); ?>
<div class="container">
     
     
<div class="card">
  <div class="card-header">
    View Notice > <?php echo $data['title'];?>
  </div>
  <div class="card-body">
    <p class="card-text"><?php echo $data['description'];?></p>
    <a href="notifications_submit.php?id=<?php echo $data['id'];?>&action=edit" class="btn btn-primary">Edit</a>
  </div>
  <div class="card-footer text-muted">
    Valid Till - <?php echo $data['start_date'];?> to <?php echo $data['end_date'];?>
  </div>
</div>
     
      
</div> <!-- /container -->
  </body>
</html>