<?php 
if (!isset($_GET['pg'])) {
    $pg = 'dash';
}else{
    $pg = $_GET['pg'];
}
?>
<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search">NAVIGATION</li>
        <?php if ($_SESSION['level'] == "All") { ?>

            <li><a href="?pg=dash" <?= $pg == 'dash' ? 'class="active"' : ''; ?>><i class="fa fa-home fa-fw"></i>Home</a></li>

            <?php
            $array1 = array(
                $_SESSION['permissions']['can_manage_system_user'],
                $_SESSION['permissions']['can_manage_region'],
                $_SESSION['permissions']['can_manage_council'],
                $_SESSION['permissions']['can_manage_ras'],
                $_SESSION['permissions']['can_manage_rrh'],
                $_SESSION['permissions']['can_manage_ministry'],
                $_SESSION['permissions']['can_manage_agencies'],
                $_SESSION['permissions']['can_manage_mabaraza'],
                $_SESSION['permissions']['can_manage_disiability'],
                $_SESSION['permissions']['can_manage_training_type'],
                $_SESSION['permissions']['can_manage_institutions'],
                $_SESSION['permissions']['can_manage_programs'],
                $_SESSION['permissions']['can_manage_cadre'],
                $_SESSION['permissions']['can_manage_documents'],
                $_SESSION['permissions']['can_manage_criteria_setting'],
                $_SESSION['permissions']['can_manage_cadre_criteria'],
                $_SESSION['permissions']['can_manage_employment_permit_category'],
                $_SESSION['permissions']['can_manage_manage_employment_permit']
            );
            if (in_array('YES', $array1)){ echo ' 
            <li><a href="#"><i class="fa fa-gear fa-fw"></i>Administration<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">';?>
                <?= $_SESSION['permissions']['can_manage_system_user'] == 'YES' ? '<li><a href="?pg=mngUser">Watumiaji</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_region'] == 'YES' ? '<li><a href="?pg=mngReg">Mkoa</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_council'] == 'YES' ? '<li><a href="?pg=mngDis">Wilaya</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_ras'] == 'YES' ? '<li><a href="?pg=mngJimbo">Jimbo</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_ras'] == 'YES' ? '<li><a href="?pg=mngTarafa">Tarafa</a></li>' : ''; ?>
				<?= $_SESSION['permissions']['can_manage_rrh'] == 'YES' ? '<li><a href="?pg=mngKata">Kata</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_ministry'] == 'YES' ? '<li><a href="?pg=mngMtaa">Mtaa/Kijiji</a></li>' : ''; ?>
                
                <?= $_SESSION['permissions']['can_manage_cadre'] == 'YES' ? '<li><a href="?pg=mngTawi">Tawi</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_documents'] == 'YES' ? '<li><a href="?pg=mngDocuments">Manage Documents</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_criteria_setting'] == 'YES' ? '<li><a href="?pg=mngCrS">Criteria Setting</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_cadre_criteria'] == 'YES' ? '<li><a href="?pg=mngCr">Cadre Criteria</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_employment_permit_category'] == 'YES' ? '<li><a href="?pg=mngWPC">Employment Permit Category</a></li>' : ''; ?>
                <?= $_SESSION['permissions']['can_manage_manage_employment_permit'] == 'YES' ? '<li><a href="?pg=mngWk">Manage Employment Permit</a></li>' : ''; ?>
           <?php echo '</ul> </li>';} ?>

            <?= $_SESSION['permissions']['can_view_applicants'] == 'YES' || $_SESSION['permissions']['can_view_and_delete_applicants'] == 'YES' ? '<li><a href="?pg=applicant"><i class="fa fa-user fa-fw"></i>Applicants</a></li>' : ''; ?>
            
            <?php
            $array2 = array(
                $_SESSION['permissions']['can_view_pending_applications'],
                $_SESSION['permissions']['can_perform_manual_approve'],
                $_SESSION['permissions']['can_view_shortlisted_applications'],
                $_SESSION['permissions']['can_shortlist'],
                $_SESSION['permissions']['can_view_allocation_applications'],
                $_SESSION['permissions']['can_allocate'],
            );
            if (in_array('YES', $array2)){ echo ' 
            <li><a href="#"><i class="fa fa-edit fa-fw"></i>Application<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">';?>
                    <?= $_SESSION['permissions']['can_view_pending_applications'] == 'YES' || $_SESSION['permissions']['can_perform_manual_approve'] == 'YES' ? '<li><a href="?pg=application">Pending</a></li> ' : ''; ?>
                    <?= $_SESSION['permissions']['can_view_shortlisted_applications'] == 'YES' || $_SESSION['permissions']['can_shortlist'] == 'YES' ? '<li><a href="?pg=shortListed">ShortListed</a></li>' : ''; ?>
                    <?= $_SESSION['permissions']['can_view_allocation_applications'] == 'YES' || $_SESSION['permissions']['can_allocate'] == 'YES' ? '<li><a href="?pg=mngAll">Allocation</a></li>' : ''; ?>
            <?php echo '</ul> </li>';} ?>

            <?php if($_SESSION['permissions']['can_view_reports'] == 'YES'){ ?>
            <!-- <li><a href="#"><i class="fa fa-sitemap fa-fw"></i>Reports<span class="fa arrow"></span></a> 
                <ul class="nav nav-second-level">
                    <li><a href="?pg=shortRe">ShortListed</a></li>
                    <li><a href="?pg=alloRep">Allocation</a></li>
                    <li><a href="?pg=unshortRe">UnshortListed</a></li>
                </ul>
            </li> -->
            
            <li><a href="?pg=reports" <?php echo $pg == 'reports' ? 'class="active"' : ''; ?>><i class="fa fa-sitemap fa-fw"></i>Report</a></li>
            

            <?php } ?>

            <!-- Start Agencies -->
        <?php } elseif ($_SESSION['level'] == "Facility") { ?>
            <li><a href="?pg=dash" class="active"><i class="fa fa-home fa-fw"></i>Home</a></li>
            <?php
            $array2 = array(
                $_SESSION['permissions']['can_view_pending_posted_applicants'],
                $_SESSION['permissions']['can_accept_posted_applicants'],
                $_SESSION['permissions']['can_reject_posted_applicants'],
                $_SESSION['permissions']['can_view_accepted_posted_applicants'],
                $_SESSION['permissions']['can_view_rejected_posted_applicants'],
            );
            if (in_array('YES', $array2)){ echo ' 
            <li><a href="#"><i class="fa fa-edit fa-fw"></i>Posted Applicants<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">';?>
                <?= $_SESSION['permissions']['can_view_pending_posted_applicants'] == 'YES' || $_SESSION['permissions']['can_accept_posted_applicants'] == 'YES' || $_SESSION['permissions']['can_reject_posted_applicants'] == 'YES' ? '<li><a href="?pg=agenciesApp">Pending</a></li>' : ''; ?>
                    <?= $_SESSION['permissions']['can_view_accepted_posted_applicants'] == 'YES' ? '<li><a href="?pg=agenciesAccepted">Accepted</a></li>' : ''; ?>
                    <?= $_SESSION['permissions']['can_view_rejected_posted_applicants'] == 'YES' ? '<li><a href="?pg=agenciesRejected">Rejected</a></li>' : ''; ?>
            <?php echo '</ul> </li>';} ?>

            <?= $_SESSION['permissions']['can_view_reports'] == 'YES' ? '
            <li><a href="#"><i class="fa fa-sitemap fa-fw"></i>Report<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="?pg=shortRe">Selected</a></li>
                    <li><a href="?pg=alloRep">Rejected</a></li>
                    <!--<li><a href="?pg=rejected">Rejected</a></li>-->
                </ul>
            </li>
            ' : ''; ?>

            <!-- end Agencies -->

        <?php } elseif ($_SESSION['level'] == "Applicant") { ?>
            <li><a href="?pg=dash" class="active"><i class="fa fa-home fa-fw"></i>Personal Details</a></li>
            <li><a href="?pg=bEd"><i class="fa fa-book fa-fw"></i>Education Details</a></li>
            <li><a href="?pg=proD"><i class="fa fa-graduation-cap fa-fw"></i>Professional Details</a></li>
            <li><a href="?pg=ExpD"><i class="fa fa-list fa-fw"></i>Experience Details</a></li>
            <li><a href="?pg=DocD"><i class="fa fa-file fa-fw"></i>Document Details</a></li>
            <!-- <li><a href="?pg=grad"><i class="fa fa-graduation-cap fa-fw"></i>Graduates Details</a></li> -->
            <!--<li><a href="?pg=regD"><i class="fa fa-registered fa-fw"></i>Registration Status</a></li>-->
            <li><a href="?pg=mngapp"><i class="fa fa-edit fa-fw"></i>Application</a></li>
        <?php } else {
        }
        ?>
    </ul>
</div>