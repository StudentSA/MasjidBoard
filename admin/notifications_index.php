<?php include('session.php');?>
<?php require("../admin/db_info.php"); ?>
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
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> 
    <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 
    <script>
    $(document).ready(function() {
            $('#noticeTable').DataTable();
        } );
</script>   
 
  </head>

 
<body>
<?php include ("navigation.php"); ?>
    
    <div class="container">
            <div class="row">
                <h3>Notices</h3>
            </div>
            <div class="row">
            <?php include ("includes/toast.php"); ?>
                <p>
                    <a href="notifications_submit.php" class="btn btn-success">Create</a>
                </p>
             
                <table id="noticeTable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                    
                       $sql = "SELECT * from notices ORDER BY start_date ASC";
                       $result = $conn->query($sql);
                       if ($result->num_rows > 0) { 


                            while ($row = $result->fetch_assoc()) {
                                      echo '<tr>';
                                      echo '<td>'. $row['title'] . '</td>';
                                      echo '<td>'. $row['start_date'] . '</td>';
                                      echo '<td>'. $row['end_date'] . '</td>';
                                      echo '<td align="middle"><div class="dropdown show">
                                      <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                      </a>
                                    
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="notifications_read.php?id='.$row['id'].'">View</a>
                                        <a class="dropdown-item" href="notifications_submit.php?id='.$row['id'].'&action=edit">Edit</a>
                                        <a class="dropdown-item" onclick="return confirm(\'Are you sure you want to delete the notice?\')" href="notifications_submit.php?id='.$row['id'].'&action=del">Delete</a>
                                      </div>
                                    </div></td>';
                                      echo '</tr>';
                            }
                        }
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>