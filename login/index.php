<?php session_start(); 
include "../lib/dbconnect.php";
include "header.php";
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
<!-- <?php //include("header.php");?> -->
<section>
<div class="container">
  <div class="row form-login">
    <div class="col-sm-12 col-md-8 cta">
      <div class="card card-signin my-5">
        <div class="card-body">
              <h3>Mtandao wa CCM wa Maombi ya Uwakilishi wa Madiwa na Wabunge</h3>
              <hr style="color: #0f74a8; box-shadow: 2px 1px 1px 1px #0f74a8;">



              <!-- <div class="cta"> -->
          <!-- <div class="card card-signin my-5">
          <div class="card-body"> -->
            <div id="Carousel" class="carousel slide carousel-fade">
                <ol class="carousel-indicators">
                    <li data-target="Carousel" data-slide-to="0" class="active"></li>
                    <li data-target="Carousel" data-slide-to="1"></li>
                    <li data-target="Carousel" data-slide-to="2"></li>
                    <li data-target="Carousel" data-slide-to="3"></li>
                    <li data-target="Carousel" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner">
                  <div class="item active">
                        <img src="../img/6.jpg" class="img-responsive" width="90%">
                    </div>

                    <div class="item">
                        <img src="../img/1.jpg" class="img-responsive" width="90%">
                    </div>

                   <div class="item">
                     <img src="../img/2.jpg" class="img-responsive"  width="90%">
                    </div>

                   <div class="item">
                     <img src="../img/3.jpg" class="img-responsive"  width="90%">
                    </div>

                    <div class="item">
                     <img src="../img/4.jpg" class="img-responsive" width="90%">
                    </div>

                    <div class="item">
                     <img src="../img/5.jpg" class="img-responsive" width="90%">
                    </div>
                </div>

                <a class="left carousel-control" href="#Carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#Carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
        </div>

                <!-- </div>
                
              </div> -->
          <!-- </div> -->


<br>

              <h4 style="color: red;">MUHIMU KWA WAOMBAJI WOTE</h4>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<h5 style="color: #000;">Sifa za Mwombaji</h5>
              <ol>
              <li>Awe raia wa Tanzania Mwanachama wa CCM</li> 
              <li>Aombe Password/Kinywila na Username/Jina la kimfumo </li>  
                 
              </ol>

              
              <div class="cta">
                <p>Kwa maelezo zaidi jinsi ya kutumia mfumo huu pakua maelezo haya
                  <object data="filename44.pdf" type="application/pdf">
                <a href="instructions222ee.pdf" target="_blank" style="color: blue;">Instructions on how to Apply?</a>
                </object>
                </p>
                
              </div>
        </div>
      </div>
    </div>

     <div class=" col-sm-12 col-md-4 cta">
     <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <hr class="my-4">
            <form class="form-signin form-group" role="form" action="../includes/process.php" method="POST">
              <div class="form-group">
                <label for="exampleInputEmail1"><b>Username</b></label>
                <input type="text" name="username" class="form-control" placeholder="Enter Your Username"  required autofocus>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
              </div> 
               <input type="submit" value="Login" name="loginButton" class="btn btn-lg btn-success btn-block"/>

               <div class="form-group">
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<small style="text-decoration:none; color:#000; font-weight:bold;">Are you new applicant?<a href="../register/">Register</a></small>
              </div>
              <p>
                <b>HELP DESK:</b> <br> +255716157506
              </p>
            </form>
            
              
          </div>
        </div> 
          </div>

  </div>
</div>
</section>
<!--footer-main-->
<?php include("footer.php"); 
} 
?>
<!--End footer-main-->
