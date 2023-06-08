<?php session_start(); 
include "../lib/dbconnect.php";
$db = new dbClass();
$db->connect();
if(isset($_SESSION['userid']))
{
 header("Location:../?pg=dash");
}
elseif(!empty($_SESSION['userReg']))
{
$username=$_SESSION['userReg'];
$password=$_SESSION['passReg'];
$db->login($username,$password);
}
else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>WAO - Login Page</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
         <div class="login-panel panel panel-primary">
           <div class="panel-heading">
            <h3 class="panel-title" align="center">WAO - Log In Form</h3></div>
            <div class="panel-body">
            <form class="m-t" role="form" action="../includes/process.php" method="POST">
            <fieldset>
	         <div class="form-group">
             <input class="form-control" placeholder="Username" name="username" type="text" required autofocus>
             </div>
             <div class="form-group">
             <input class="form-control" placeholder="Password" name="password" type="password" required>
             </div>
             <div class="checkbox">
             </div>
              <input type="submit" value="Sign In" name="loginButton" class="btn btn-lg btn-success"/>
             </fieldset>
             </form>
             </div>
          </div>
		<p align="center">
		<a href="../register/">
		<span style="color:#293f95;text-decoration:none;">Not Registered? Register here</span></a>  |  <a href="forgotpassword.php"><span style="color:#293f95;text-decoration:none;">Forgot Password?</span></a>
		</p>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>
<?php } ?>