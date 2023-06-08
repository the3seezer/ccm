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
            <h3 class="panel-title" align="center">WAO - Forgot Password</h3></div>
            <div class="panel-body">
            <form class="m-t" role="form" action="../includes/process.php" method="POST">
            <fieldset>
	         <div class="form-group">
             <input id="email" class="form-control" placeholder="Enter your Email" name="email" type="email" required autofocus>
             </div>
             
             <div class="checkbox">
             </div>
              <input type="submit" value="Submit" name="forgotPasswordButton" class="btn btn-lg btn-success"/>
             </fieldset>
             </form>
             </div>
          </div>
		<p align="center">
		<a href="../login/">
		<span style="color:#293f95;text-decoration:none;">Login Page</span></a>
		</p>
                </div>
            </div>
        </div>
		
		 <!--FORM VALIDATION SCRIPT -->
<!-- form validation -->
<script src="../js/validator/validator.js"></script>
<script>
        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function(e){
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
        </script>
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