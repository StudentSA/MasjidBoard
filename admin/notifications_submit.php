<?php 
    include('session.php');
    require("../admin/db_info.php"); 

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_GET['id'];
        $title = "Update Notice";
        $btnTitle = "Update";
    }else{
        $title = "Create A Notice";
        $btnTitle = "Create";
    }

    $action = $_GET['action'];

   


    
    if ( $id!=null ) {
        
        if($action!=null && $action=="del"){
             $sql = 
             $result = $conn->query($sql);
             $stmt = $conn->prepare("DELETE from notices WHERE id = ?");
             $stmt->bind_param("i",$id);
             $stmt->execute();
             $_SESSION['notices'][] = array("msg"=>"Notice deleted successfully!",
                                            "type"=>"alert-success");
                                            
            header("Location: notifications_index.php");
        
        }

        $sql = "SELECT * from notices WHERE id = ".(int)$id;

        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $name = $data['title'];
            $desc = $data['description'];
            $start_date = $data['start_date'];
            $end_date = $data['end_date'];
        }
    }


    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['title'];
        $desc = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
       
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Title';
            $valid = false;
        }
         
        if (empty($desc)) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        } 
         
        if (empty($start_date)) {
          $startError = 'Please enter Start Date';
          $valid = false;
        }else{
            $start_date .= " 00:00:00";
        } 
       
        if (empty($end_date)) {
            $endError = 'Please enter End Date';
            $valid = false;
        } else{
            $end_date .= " 23:59:59";
        } 
         
        
        if ($valid) {
        
            if($id!=null){
                
                $stmt = $conn->prepare("UPDATE notices SET title=?,description=?,
                                        start_date=?,end_date=? 
                                        WHERE id=?");
                $stmt->bind_param("ssssi",$name , $desc,
                $start_date, $end_date,$id); 
                $_SESSION['notices'][] = array("msg"=>"Notice updated successfully!",
                                               "type"=>"alert-info");
            }else{

                $stmt = $conn->prepare("INSERT INTO notices SET title=?,
                                    description=?,start_date=?,
                                    end_date=?");
                $stmt->bind_param("ssss",$name , $desc,
                $start_date, $end_date);
                $_SESSION['notices'][] = array("msg"=>"Notice created successfully!",
                                               "type"=>"alert-success");
            }
           
            $stmt->execute();
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
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="./css/table.css" rel="stylesheet">
    
    <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script> 
    

  </head>

 
<body>
<?php include ("navigation.php"); ?>
    
<div class="container">
    <form class="form-horizontal" action="notifications_submit.php<?php echo (!empty($id)?'?id='.$id:'') ?>" method="post">
            
         <div class="row">
       
         <div class="col-md-12">
             <h3><?php echo $title;?></h3>
         </div>   
  
         
         <div class="form-group col-md-6">
             <label class="control-label">Name</label>
                 <input name="title" class="form-control <?php echo !empty($nameError)?'is-invalid':'';?>" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                 <?php if (!empty($nameError)): ?>
                    <div class="invalid-feedback">
                        <?php echo $nameError;?>
                    </div>
                 <?php endif; ?>
           </div>
           <div class="form-group  col-md-12">
             <label class="control-label">Description</label>
              <textarea name="description" rows="4" cols="50" class="form-control  <?php echo !empty($descriptionError)?'is-invalid':'';?>"  placeholder="Describe this Notification" 
                 value="<?php echo !empty($desc)?$desc:'';?>" ><?php echo !empty($desc)?$desc:'';?></textarea>
                 <?php if (!empty($descriptionError)): ?>
                    <div class="invalid-feedback">
                        <?php echo $descriptionError;?>
                    </div>
                 <?php endif;?>
           </div>
           <div class="form-group  col-md-6">
             <label class="control-label">Start Date</label>
             <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input type="text" name="start_date" class="form-control <?php echo !empty($startError)?'is-invalid':'';?>" 
                    value="<?php echo !empty($start_date)?$start_date:'';?>">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
             </div>
             <?php if (!empty($startError)): ?>
                    <div class="invalid-feedback">
                        <?php echo $startError;?>
                    </div>    
             <?php endif;?>
            
           </div>
           <div class="form-group  col-md-6">
             <label class="control-label">End Date</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input type="text" name="end_date" class="form-control  <?php echo !empty($endError)?'is-invalid':'';?>" value="<?php echo !empty($end_date)?$end_date:'';?>">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
                 <?php if (!empty($endError)): ?>
                    <div class="invalid-feedback">
                        <?php echo $endError;?>
                    </div>  
                 <?php endif;?>
             
           </div>        

           <div class="form-actions  col-md-6">
               <button type="submit" class="btn btn-success"><?php echo $btnTitle;?></button>
               <a class="btn  btn-warning" href="notifications_index.php">Back</a>
             </div>
         
     </div>
     </form>
</div> <!-- /container -->
  </body>
</html>