<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>WAO - Change Password</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    </head>
    <body>

    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
         <div class="login-panel panel panel-primary">
           <div class="panel-heading">
            <h3 class="panel-title" align="center">WAO - Change Password</h3></div>
            <div class="panel-body">
            <!-- <form class="m-t" role="form" action="includes/process.php" method="POST">-->
            <form class="m-t" role="form" action="includes/process.php" method="POST">
            <fieldset> 
             <div class="form-group">
             <input class="form-control" placeholder="Enter old Password" name="password" type="password" required>
             </div>
			 
			 <div class="form-group">
             <input class="form-control" placeholder="New Password" name="NewPassword" type="password" required>
             </div>

             <div class="form-group">
             <input class="form-control" placeholder="Confirm Password" name="ConfirmPassword" type="password" required>
             </div>
			
              <input type="submit" value="Submit" name="passChangeButton" class="btn btn-lg btn-success"/>
             </fieldset>
             </form>
             </div>
          </div>
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


