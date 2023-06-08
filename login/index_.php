<?php session_start(); 
include "../lib/dbconnect.php";
include("header.php");
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
<section class="cta">
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <div class="card card-signin my-5">
        <div class="card-body">
              <h3>Online Job Application Portal</h3>
              <hr style="color: #0f74a8; box-shadow: 2px 1px 1px 1px #0f74a8;">
              <h6 style="color: red;">MUHIMU KWA WAOMBAJI WOTE</h6>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small style="color: #000;"><b>Usajili wa waombaji</b></small>
              <ol>
              <li>Kila muombaji anatakiwa ajisajili kwa kujaza taarifa muhimu kama vile namba ya kidato cha nne,mwaka wa kumaliza,jina la muombaji,namba ya simu na anuani ya barua pepe (email) inayo fanya kazi.</li> 
              <li>Kila muombaji anatakiwa ajisajili mara moja tu . Mfumo hauta ruhusu kufanya usajili na kutuma maombi zaidi ya mara moja.</li>  
              <li>Hakikisha kila taarifa uanayo jaza unaihakiki kabla ya kwenda kipengele kingine.</li>  
              </ol>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small style="color: #000;"><b>Taarifa binafsi</b></small>
              <ol>
              <li>Majina yatakayo jazwa sehemu ya taarifa binafsi yawe kama yanavyoonekana katika vyeti vya taaluma.</li> 
              <li>Namba za mtihani wa kidato cha nne na sita iandikwe kwa kufuata muundo wa S0123-0001 au P0123-0001.Hakikisha namba unayo tumia ni sahihi.</li>   
              </ol>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small style="color: #000;"><b>Utumaji wa nyaraka</b></small>
              <ol>
              <li>Unatakiwa kuambatanisha nyaraka kwa kila taarifa ya kitaaluma ,leseni ya kazi na cheti cha kuzaliwa.</li> 
              <li>Cheti kinacho tumwa hakikisha kina ukubwa usio zidi MB 1.Inashauriwa kuscan cheti halisi kinachoonekana vizuri.</li>   
              <li>Barua ya maombi ielekezwe kwa KATIBU MKUU, OFISI YA RAIS, TAMISEMI. Unganisha barua ya maombi na INTERNSHIP letter.</li>   
              <li>Viambatanisho vyote vya nyaraka muhimu zinazohitajika katika mfumo ziwe katika muundo wa PDF tu.</li>   
              </ol>

              <div class="cta">
                <p>Kwa maelezo zaidi jinsi ya kutumia mfumo huu pakua maelezo haya 
                  <object data="filename.pdf" type="application/pdf">
                <a href="instructions.pdf" target="_blank" style="color: blue;">Instructions on how to Apply?</a>
                </object>
                </p>
                
              </div>
        </div>
      </div>
    </div>
  <div class="col-md-4">
     <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <hr class="my-4">
            <form class="form-signin form-group" >
              <div class="form-group">
                <label for="exampleInputEmail1"><b>Username</b></label>
                <input type="text" name="username" class="form-control" placeholder="Enter Your Username"  required autofocus>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
              </div>
              <div class="form-group">
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<small style="text-decoration:none;">Forgot password?<a href="forgotpassword.php">Reset Password</a></small>
              </div>
               <input type="submit" value="Login" name="loginButton" class="btn btn-lg btn-success btn-block"/>

               <div class="form-group cta">
                &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<small style="text-decoration:none;">Are you new applicant?<a href="../register/">Register</a></small>
              </div>
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
