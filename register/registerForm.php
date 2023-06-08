<?php session_start();

//Connect to database
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>JOBOAS - Registration Form</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">JOBOAS</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <?php //include("includes/notification.php"); ?>
                    <?php //include("includes/userprofile.php"); ?>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                  <?php //include("includes/nav.php"); ?>  
                </div>
            </nav>

            <div id="page-wrapper">
			 
			 <div class="row">
              <div class="col-lg-12">
              <h2 class="page-header">Registration Form</h2>
              </div>                  
            </div>        
          <div class="row col-md-12 col-sm-12 col-xs-12">
                   
			
			 <form method="post" action="../includes/process.php" class="form-horizontal form-label-left" novalidate>
               <!--First Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">First Name <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="name" class="form-control col-md-7 col-xs-12"  name="firstname"  required type="text">
               </div>
               </div>
               
               <!--Middle Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Middle Name</label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="middle" class="form-control col-md-7 col-xs-12"  name="middle"   type="text">
               </div>
               </div>
               
               <!--Last Name-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Last Name <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="last" class="form-control col-md-7 col-xs-12"  name="lastname"  required="required" type="text">
               </div>
               </div>
			   
			   <!--Date Of Birth-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Date of Birth<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="dob" class="form-control col-md-7 col-xs-12"  name="dob"  required="required" type="text" readonly>
               </div>
               </div>
               
               <!--Gender-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Gender <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="gender" class="form-control col-md-7 col-xs-12"  name="gender"  required="required">
               <option value="">--Select--</option>
               <option value="Male">Male</option>
               <option value="Female">Female</option>
               </select>
               </div>
               </div>
               
               <!--Username-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="username" class="form-control col-md-7 col-xs-12" placeholder="Note: Don't use your email as username"  
               name="username"  required="required" type="text"><span id="status"></span>
               </div>
               </div>
               
               <!--Password-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Password<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="password" class="form-control col-md-7 col-xs-12"  name="password" data-validate-length="" required type="password" placeholder="">
               </div>
               </div>
               
               <!--Re-type Password-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Re-type Password<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="password2" class="form-control col-md-7 col-xs-12"  name="password2" data-validate-linked="password"  required="required" type="password">
               </div>
               </div>
             
               <!--Nationality-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nationality <span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <select id="national" class="form-control col-md-7 col-xs-12"  name="national"  required="required">
               <option value="">--Select--</option>
               <?php
	             //while($row = $query1->fetch())
	             //{
	             //echo '<option value ="'.$row['id'].'">'.$row['value'].'</option><br>';
	             // }           
                  ?>
               </select>
               </div>
               </div>
               
               <!--Postal Addres-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Postal Address<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="address" class="form-control col-md-7 col-xs-12"  name="address"  required="required" type="text">
               </div>
               </div>
               
               <!--Phone Number-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Phone Number<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="phone" class="form-control col-md-7 col-xs-12"  name="phone"  required="required" type="text" data-validate-minmax="10,100">
               </div>
               </div>
               
               <!--Email Address-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="email" class="form-control col-md-7 col-xs-12"  name="email"  required="required" type="email">
              <span id="emailStatus"></span>
               </div>
               </div>
               
               
               
                <!--Capture Image-->
               <div class="item form-group">
               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"></label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <img id="captcha" src="../securimage/securimage_show.php" alt="CAPTCHA Image" />
               <a href="#" onclick="document.getElementById('captcha').src = '../securimage/securimage_show.php?' + Math.random(); return false">[Try other codes ]</a>
               </div>
               </div>
               
               <!--Write text image-->
               <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="captcha_code">Write Text as seen above<span class="required">*</span> </label>
               <div class="col-md-6 col-sm-6 col-xs-12">
               <input id="securtyCode" class="form-control col-md-7 col-xs-12"  name="captcha_code"  required="required" type="text">
               </div>
               </div>
               
               <div class="ln_solid"></div>
               <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                 <button id="send" type="submit" class="btn btn-success">Submit</button>
                 <button type="reset" class="btn btn-primary">Clear</button>
                </div>
               </div>
             </form>
			
			 
			
			
			</div>
			
			
			
           </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
		
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>
		
		<!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>
		
		<!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>
		<script>
            $(document).ready(function() {
               $('#dataTables-example').DataTable({
                responsive: true
              });
            });
/////////////////////////////////////////
/////////////////////////////////////////
/////////GET DISTRICT LIST///////////////
/////////////////////////////////////////
/////////////////////////////////////////
function loadDistrictList(str)
   {

  if (str=="")
  {
	  
  document.getElementById("districtList").innerHTML="<option  value='' >--select--</option>";
  return;
  } 
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
 else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("districtList").innerHTML=xmlhttp.responseText;
    }
  }
  
 xmlhttp.open("GET","includes/districtList.php?q="+str,true);

 xmlhttp.send();
   }			
			
			
			
       
//////////////////////////////////////////
///////////////////////////////////////////
//////PROCESSING REQUIREST FROM MODALS////
///////////////////////////////////////////
////////////////////////////////////////// 

<!-----Add New User----->
 $(document).ready(function(){
     
     $(document).on('click','#getadduser', function(e){
     e.preventDefault();
	 
     var user_id = $(this).data('id'); // get id of clicked row
	 
	 
	 $('#addUser-content').html(''); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'includes/addUser.php',
          type: 'POST',
          data: 'userID='+user_id,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#addUser-content').html(''); // blank before load.
          $('#addUser-content').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#addUser-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });
});



/////////////////////////////////////
////////////FACILITY////////////////
///////////////////////////////////

<!-----Add New Facility----->
 $(document).ready(function(){
     
     $(document).on('click','#getaddFacility', function(e){
     e.preventDefault();
	 
     var user_id = $(this).data('id'); // get id of clicked row
	 
	 
	 $('#addFacility-content').html(''); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'includes/addFacility.php',
          type: 'POST',
          data: 'userID='+user_id,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#addFacility-content').html(''); // blank before load.
          $('#addFacility-content').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#addFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });
});



<!-----Delete Facility----->
 $(document).ready(function(){
     
     $(document).on('click','#getdeleteF', function(e){
     e.preventDefault();
	 
     var fac_id = $(this).data('id'); // get id of clicked row
	 
	 
	 $('#deleteFacility-content').html(''); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click
 
     $.ajax({
          url: 'includes/deleteFacility.php',
          type: 'POST',
          data: 'fac_id='+fac_id,
          dataType: 'html'
     })
     .done(function(data){
          console.log(data); 
          $('#deleteFacility-content').html(''); // blank before load.
          $('#deleteFacility-content').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
     })
     .fail(function(){
          $('#deleteFacility-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });
});

        
</script>
		
		
		
<!-- Morris Charts JavaScript -->
<script src="../js/raphael.min.js"></script>
<script src="../js/morris.min.js"></script>
<script src="../js/morris-data.js"></script>		
</body>
</html>