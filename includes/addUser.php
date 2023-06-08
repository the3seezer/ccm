<?php
session_start();

//Connect to database
include("../lib/dbconnect.php");
$db = new dbClass();
$db->connect();
$sel=$db->getWPCategory(); 
					                   
?>

<form action="includes/process.php" method="post" class="form-horizontal form-label-left">

    <!-- First Name-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="firstname">First Name<span
                    class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input id="firstname" class="form-control col-md-7 col-xs-12" data-validate-length-range=""
                   data-validate-words="" name="firstname" placeholder="" required="required" type="text">
        </div>
    </div>

    <!--Last Name-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="lastname">Last Name<span class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input id="lastname" class="form-control col-md-7 col-xs-12" data-validate-length-range=""
                   data-validate-words="" name="lastname" placeholder="" required="required" type="text">
        </div>
    </div>

    <!--Gender-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="gender">Gender<span
                    class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <select id="gender" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                    data-validate-words="2" name="gender" placeholder="" required="required">
                <option value="">--Select--</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>


    <!--User name-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="Username">Username<span class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range=""
                   data-validate-words="" name="username" placeholder="" required="required" type="text"><span
                    id="status"></span>
        </div>
    </div>

    <!--Password -->
    <div class="item form-group">
        <label for="password" class="control-label col-md-2 col-sm-2 col-xs-12">Password</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input id="password" type="password" name="password" data-validate-length-range="8"
                   class="form-control col-md-7 col-xs-12" required="required">
        </div>
    </div>

    <!--Repeat Password -->
    <div class="item form-group">
        <label for="password2" class="control-label col-md-2 col-sm-2 col-xs-12">Repeat Password</label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input id="password2" type="password" name="password2" data-validate-linked="password"
                   class="form-control col-md-7 col-xs-12" required="required">
        </div>
    </div>

    <!--User Level-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="gender">User level<span class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <select id="userlevel" class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                    data-validate-words="2" name="userlevel" placeholder="" required="required">
                <option value="">--Select--</option>
                <option value="All">Administrator</option>
                <?php 
                    while($row=$sel->fetch()) {
                    $wpc_id=$row['wpc_id'];
                    $wpname =$row['name'];
                ?>
                <option value="<?=$wpc_id?>"><?= $wpname ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="item form-group" style="display:none;" id="loader">
        <div class="text-center"><i class="fa fa-spinner fa-spin text-primary"></i></div>
    </div>

    <div id="show"></div>

    <!--Email Address-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email <span
                    class="required">*</span></label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="email" id="email" name="email" required="required"
                   class="form-control col-md-7 col-xs-12"><span id="emailStatus"></span>
        </div>
    </div>

    <!--Phone number-->
    <div class="item form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="number">Phone Number<span
                    class="required">*</span>
        </label>
        <div class="col-md-10 col-sm-10 col-xs-12">
            <input type="text" id="phone" name="phone" required="required" class="form-control col-md-7 col-xs-12">
        </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-3">
            <input type="submit" id="send" class="btn btn-success" name="addNewUser" value="Submit"/>
            <input type="reset" class="btn btn-primary" value="Cancel"/>
            <input type="hidden" name="member_id" value="<?php echo $_SESSION['member_id']; ?>"/>
        </div>
    </div>
</form>

<script>
    $("#userlevel").change(function () {
        var userlevel = $(this).children("option:selected").val();
        if (userlevel != 'All') {
            $('#loader').show();
            $.get("includes/wpnames.php?q="+userlevel, function(data, status){
                $('#loader').hide();
                $('#show').html(data);
            });
            
        }else{
            $('#loader').hide();
            $('#show').html('');
        }
    });
</script>