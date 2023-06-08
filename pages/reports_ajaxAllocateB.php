<?php
//include("lib/dbconnect.php");
//$db = new dbClass();
//$db->connect();

$year = $_SESSION['yearB'];
$category = $_SESSION['categoryB'];
$fac_type = $_SESSION['facility_typeB'];

$sel = $db->getReportsAllocateB($year, $category, $fac_type);

//budoya
$status = "Shortlisted";
$pmYear = $year;
//$url_post = http_build_query(array('post' => $_POST));

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Allocation</h1>
    </div>
</div>
<div class="col-md-10 text-center">
    
    <h4 class="text-danger">Total: <b> <?= $sel->rowCount(); ?> </b> </h4>
</div>

<table class="table table-striped table-bordered table-hover" id="">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            
            <th>DOB</th>
            
            <th>Phone</th>
            <th>Council Reg. NO.</th>
            <th>Facility</th>
            <th>View</th>
			<th>Allocate</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

        while ($row = $sel->fetch()) {
            
                $applicant_id = $row['applicant_id'];
            
        ?>
            <tr class="odd gradeX">
                <td><?php echo $i; ?></td>
                <td><?php echo $row['firstname'] . " " . $row['lastname']; ?></td>
                
                <td><?php echo $row['dob']; ?></td>
                
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['councilRegistrationID']; ?></td>
                <td align="left">
                    <?php
                  
                        //Get Application Details
                        $getWP = $db->getApplicantAplication($applicant_id, $pmYear, $status);
                        
                            while ($rw1 = $getWP->fetch()) {
                                $app_id = $rw1['app_id'];
                                $category = $rw1['category'];
                                $wp_id = $rw1['fac_id'];
                                $cadreid = $rw1['cadre_id'];
                                $choiceNo = $rw1['choiceNo'];
                                $score = $rw1['credit'];

                                $wpname = '';
                                include("lib/criteria_setting.php");

                                //Get Cadre name
                                $getCa = $db->getHealthCadresById($cadreid);
                                $rwC = $getCa->fetch();
                                $cadName = $rwC['cadreName'];
                                
                                    echo $choiceNo . "." . strtoupper($wpname) . "-" . $cadName . "(" . $score . ")" . "<br/>";
                            }
                        
                    
                    ?>
                </td>
                <td align="left">
                    <a href="?pg=mngAppDetails&id=<?php echo $applicant_id; ?>" class="btn btn-info btn-xs" target=_blank><i class="fa fa-folder"></i> More
                        Details</a>
                </td>
				<td align="left">
										<?php if($_SESSION['permissions']['can_allocate']=='YES') 
												echo '
		                                         <a href="#approveAllocateApp" class="btn btn-primary btn-xs" data-toggle="modal" data-id="'.$applicant_id.'" id="getApproveAllocateApp"><i class="fa fa-edit"></i>Allocate</a>


												';  ?>
            </tr>
        <?php $i++;
        } ?>
    </tbody>
</table>
<!--DEFINING MODALS--->
<!--Module to Allocate-->
<div id="shortlist" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Shortlist Applicants</h4>
            </div>
            <div class="modal-body">
                <!--<div id="addUser-content"></div>-->

                <form action="includes/process.php" method="post" class="form-horizontal form-label-left">

                    <!--Year-->
                    <div class="item form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Year<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select id="year" class="form-control col-md-7 col-xs-12" name="year" required="required">
                                <option value="">--Select--</option>
                                <?php
                                $cYear = date('Y');
                                for ($i = $cYear; $i >= 2018; $i--) {
                                ?>
                                    <option><?php echo $i; ?></option>
                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button id="send" type="submit" name="shortlistTool" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to View Choices-->
<div id="viewChoices" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Choices</h4>
            </div>
            <div class="modal-body">

                <div id="viewChoices-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!--Module to Change Facility -->
<div id="changeFacility" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bounceInRight">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Facility</h4>
            </div>
            <div class="modal-body">

                <div id="changeFacility-content"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Module to Approve Allocation -->
     <div id="approveAllocateApp" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
     <div class="modal-content bounceInRight">
     <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Approve Allocation:</h4>
     </div>
      <div class="modal-body">
     
	  <div id="approveAllocateApplication-content"></div>
	 
      </div>
	  
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
     </div> 
     </div>