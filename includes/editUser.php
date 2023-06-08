<?php session_start();
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();   
// $id=$_POST['id'];
$member_id = $_POST['id'];
$getF = $db->getMembersById($member_id);
$row=$getF->fetch();
$firstname=$row['firstname'];
$lastname=$row['lastname'];
$gender=$row['gender'];
$phone=$row['phone'];
$email=$row['email'];

// $tableid = $_POST['user_id'];
// $getF=$db->getsystemUsersById($tableid);
// $row=$getF->fetch();
// $level=$row['level'];
// $tableid=$row['user_id'];

// $selectreg=$db->getAllRASName();
?>

<form  action="includes/process.php" method="post"  class="form-horizontal form-label-left">
<!-- First Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">First Name<span
                    class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="firstname" class="form-control col-md-7 col-xs-12" data-validate-length-range=""
                   data-validate-words="" name="firstname" value="<?php echo $firstname; ?>" placeholder="" required="required" type="text">
        </div>
    </div>

    <!--Last Name-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Last Name<span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="lastname" class="form-control col-md-7 col-xs-12" data-validate-length-range=""
                   data-validate-words="" name="lastname" value="<?php echo $lastname; ?>" placeholder="" required="required" type="text">
        </div>
    </div>

    <!--Gender-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender<span
                    class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <select id="gender" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                    data-validate-words="2" name="gender" placeholder="" required="required">
                <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>

    

    <!--Email Address-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span
                    class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="email" id="email" name="email" required="required"
                   class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>"><span id="emailStatus"></span>
        </div>
    </div>

    <!--Phone number-->
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Phone Number<span
                    class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="phone" name="phone" required="required" value="<?php echo $phone; ?>" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

     <div class="ln_solid"></div>
     <div class="form-group">
     <div class="col-md-6 col-md-offset-3">
     <input type="submit"  id="send"  class="btn btn-success" name="editUser" value="Save"/>
     <input type="reset" class="btn btn-default" value="Clear"/>
    <input type="hidden" name="member_id" value="<?php echo $member_id; ?>"/>
     
     </div>
     </div>

</form>	 