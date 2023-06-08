<?php
$sel = $db->singleUbungeAll();
$numUb = $sel->rowCount();
$sell = $db->singleUdiwaniAll();
$numUd = $sell->rowCount();
$se = $db->singleUteuziiOnly();
$num = $se->rowCount();
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
<!-- /.row -->
<div class="row">

    <!--#PENDING APPLICANTS-->
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numUb; ?></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Walojaza Fomu Ubunge</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!--#SHORTLISTED APPLICANTS-->
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $numUd; ?></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Waliojaza Fomu Udiwani</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <!--#ALLOCATED APPLICANTS-->
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-wheelchair fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $num; ?></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">Walioteuliwa Ubunge</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Summary Description Panel
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="col-md-6">
                    <div id='graph'></div>
		<script type="text/javascript">
		
			// Use Morris.Bar
			Morris.Bar({
			  element: 'graph',
			  data: [
				{x: '2011 Q1', y: 3, z: 2, a: 3},
				{x: '2011 Q2', y: 2, z: null, a: 1},
				{x: '2011 Q3', y: 0, z: 2, a: 4},
				{x: '2011 Q4', y: 2, z: 4, a: 3}
			  ],
			  xkey: 'x',
			  ykeys: ['y', 'z', 'a'],
			  labels: ['Y', 'Z', 'A']
			}).on('click', function(i, row){
			  console.log(i, row);
			});

		</script>
 <!-- Morris Charts JavaScript -->
        <script src="../js/raphael.min.js"></script>
        <script src="../js/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>

                </div>
            </div>
            <!-- /.panel-body -->
        </div>
    </div>

</div>