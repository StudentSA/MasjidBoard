<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: ./salaahtimes.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../kaba.ico">

    <title>Signin</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUser" class="sr-only">Username</label>
        <input name= "username" type="text" id="name" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
        <span><?php echo $error; ?></span>
      </form>

    </div> <!-- /container -->
  </body>
</html>
