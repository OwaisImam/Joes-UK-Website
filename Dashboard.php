<?php include("Common.php"); ?>
<?php include("CheckAdminLogin.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<!-- bootstrap 3.0.2 -->
<!-- jQuery 2.0.2 -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/ui.datepicker.js" type="text/javascript"></script>
<script language="javascript" src="js/local_clock.js" type="text/javascript"></script>
<script src="js/Chart.js"></script>
<script language="javascript" src="js/functions.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<script language="javascript" src="scripts/innovaeditor.js"></script>
<link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="css/morris/chart.css" rel="stylesheet" type="text/css" />
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart --> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- jvectormap -->
<link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
<!-- fullCalendar -->
<link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<style>
#labelimp {
	background-color: rgba(60, 141, 188, 0.19);
	padding: 4px;
	font-size: 20px;
	width: 100%;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	padding-left: 5px;
}
/*--charts--*/
.charts,.row {
    margin: 2em 0 0;
}
.charts-grids {
    background-color: #fff;
    padding:1em;
}
.charts-grids canvas#bar {
    width: 100% !important;
}
.charts canvas#line {
    width: 100% !important;
}
h4.title {
    font-size: 1.1em;
    color: #C1C1C1;
    margin: 0.5em 0 1em;
    text-transform: uppercase;
}
/*--//charts--*/
.widget-shadow {
    background-color: #fff;
    box-shadow: 0 -1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
	-webkit-box-shadow: 0 -1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
	-moz-box-shadow: 0 -1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);
}
</style>
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php
	include_once("Header.php");
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
  <!-- Left side column. contains the logo and sidebar -->
  <?php
			include_once("Sidebar.php");
?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Dashboard <small></small> </h1>
      <ol class="breadcrumb">
        <li><a href="Dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo total_products(); ?>
                                    </h3>
                                    <p>
                                        Products 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pricetags"></i>
                                </div>
                                <a href="Products.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo total_orders(); ?>
                                    </h3>
                                    <p>
                                        Orders
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="Orders.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                         <?php echo total_categories(); ?>
                                    </h3>
                                    <p>
                                        Categories
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="Categories.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                         
                        
                        
                    </div><!-- /.row -->
                      <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo total_shirts(); ?>
                                    </h3>
                                    <p>
                                        Total Men Shirts
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pricetags"></i>
                                </div>
                                <a href="Products.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo total_pants(); ?>
                                    </h3>
                                    <p>
                                       Total Mens Jeans/Pants
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="Orders.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                         <?php echo total_t_shirts(); ?>
                                    </h3>
                                    <p>
                                        Total Tee Shirts
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="Categories.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    
                    </div><!-- /.row -->
                       <div class="row">
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       <?php echo total_kids_jeans(); ?>
                                    </h3>
                                    <p>
                                        Total Kids Jeans/Trousers
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pricetags"></i>
                                </div>
                                <a href="Products.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                    <?php echo total_mens_shoes(); ?>
                                    </h3>
                                    <p>
                                    
                                       Total Mens Shoes
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="Orders.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo total_kids_shoes(); ?>
                                    </h3>
                                    <p>
                                        Total Kids Shoes
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="Categories.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                         
                        
                        
                    </div><!-- /.row -->
            

				
				<div class="charts">
					<div class="col-md-6 chrt-page-grids">
						<h4 class="title">Line Chart</h4>
						<canvas id="line" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
					</div>
					<div class="col-md-6 chrt-page-grids chrt-right">
						<h4 class="title">Doughnut Chart</h4>
						<div class="doughnut-grid">
							<canvas id="doughnut" style="width:416px; height: 306px;"></canvas>
						</div>
					</div>
					<div class="col-md-6 charts chrt-page-grids">
						<h4 class="title">Radar Chart</h4>
						<div class="radar-grid">
							<canvas id="radar" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
						</div>
					</div>
					<div class="col-md-6 charts chrt-page-grids chrt-right">
						<h4 class="title">polar Area Chart</h4>
						<div class="polar-area">
							<canvas id="polarArea" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
						</div>
					</div>
					<div class="col-md-6 charts chrt-page-grids">
						<h4 class="title">Bar Chart</h4>
						<canvas id="bar" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
					</div>
					<div class="col-md-6 charts chrt-page-grids chrt-right">
						<h4 class="title">Pie Chart</h4>
						<div class="pie-grid">
							<canvas id="pie" height="300" width="400" style="width: 400px; height: 300px;"></canvas>
						</div>
					</div>
					<div class="clearfix"> </div>
						<script>
						var doughnutData = [
								{
									value: 30,
									color:"#4F52BA"
								},
								{
									value : 50,
									color : "#F2B33F"
								},
								{
									value : 100,
									color : "#585858"
								},
								{
									value : 40,
									color : "#e94e02"
								},
								{
									value : 120,
									color : "#9358ac"
								}
							
							];
						var lineChartData = {
							labels : ["Sun","Mon","Tue","Wed","Thr","Fri","Sat"],
							datasets : [
								{
									fillColor : "rgba(51, 51, 51, 0)",
									strokeColor : "#4F52BA",
									pointColor : "#4F52BA",
									pointStrokeColor : "#fff",
									data : [50,65,68,71,67,70,65]
								},
								{
									fillColor : "rgba(51, 51, 51, 0)",
									strokeColor : "#F2B33F",
									pointColor : "#F2B33F",
									pointStrokeColor : "#fff",
									data : [55,60,54,58,62,55,58]
								},
								{
									fillColor : "rgba(51, 51, 51, 0)",
									strokeColor : "#e94e02",
									pointColor : "#e94e02",
									pointStrokeColor : "#fff",
									data : [50,55,52,45,46,49,52]
								}
							]
							
						};
						var pieData = [
								{
									value: 30,
									color:"#4F52BA"
								},
								{
									value : 50,
									color : "#585858"
								},
								{
									value : 100,
									color : "#e94e02"
								}
							
							];
						var barChartData = {
							labels : ["January","February","March","April","May","June","July"],
							datasets : [
								{
									fillColor : "rgba(233, 78, 2, 0.83)",
									strokeColor : "#ef553a",
									highlightFill: "#ef553a",
									data : [65,59,90,81,56,55,40]
								},
								{
									fillColor : "rgba(79, 82, 186, 0.83)",
									strokeColor : "#4F52BA",
									highlightFill: "#4F52BA",
									data : [50,65,60,50,70,70,80]
								},
								{
									fillColor : "rgba(88, 88, 88, 0.83)",
									strokeColor : "#585858",
									highlightFill: "#585858",
									data : [28,48,40,19,96,27,100]
								}
							]
							
						};
					var chartData = [
							{
								value : Math.random(),
								color: "rgba(239, 85, 58, 0.87)"
							},
							{
								value : Math.random(),
								color: "rgba(242, 179, 63, 0.87)"
							},
							{
								value : Math.random(),
								color: "rgba(88, 88, 88, 0.87)"
							},
							{
								value : Math.random(),
								color: "rgba(147, 88, 172, 0.87)"
							},
							{
								value : Math.random(),
								color: "rgba(79, 82, 186, 0.87)"
							},
						];
						var radarChartData = {
							labels : ["Sun","Mon","Tue","Wed","Thr","Fri","Sat"],
							datasets : [
								{
									fillColor : "rgba(239, 85, 58, 0.87)",
									strokeColor : "#e94e02",
									pointColor : "#e94e02",
									pointStrokeColor : "#fff",
									data : [65,59,90,81,56,55,40]
								},
								{
									fillColor : "rgba(79, 82, 186, 0.87)",
									strokeColor : "#4F52BA",
									pointColor : "#4F52BA",
									pointStrokeColor : "#fff",
									data : [28,48,40,19,96,27,100]
								}
							]
							
						};
						new Chart(document.getElementById("doughnut").getContext("2d")).Doughnut(doughnutData);
						new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
						new Chart(document.getElementById("radar").getContext("2d")).Radar(radarChartData);
						new Chart(document.getElementById("polarArea").getContext("2d")).PolarArea(chartData);
						new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
						new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
					</script>	
				
        
	     <!--  
                   <div class="row">
               
                        <section class="col-lg-12 connectedSortable">                            
                            
							
                            <div class="nav-tabs-custom">

                                <ul class="nav nav-tabs pull-right">
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                                </div>
                            </div>
							
							
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-envelope"></i>
                                    <h3 class="box-title">Quick Email</h3>

                                    <div class="pull-right box-tools">
										<button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                                    </div>
                                </div>
                                <div class="box-body">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emailto" placeholder="Email to:"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"/>
                                        </div>
                                        <div>
                                            <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>
							
							
                       
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">To Do List</h3>
                                </div>
                                <div class="box-body">
                                    <ul class="todo-list">
                                        <li>
                                       
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            
                                            <input type="checkbox" value="" name=""/>

                                            <span class="text">Design a nice theme</span>
                                           
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>

                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Make the theme responsive</span>
                                            <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Check your messages and notifications</span>
                                            <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <input type="checkbox" value="" name=""/>
                                            <span class="text">Let theme shine like a star</span>
                                            <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                            <div class="tools">
                                                <i class="fa fa-edit"></i>
                                                <i class="fa fa-trash-o"></i>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="box-footer clearfix no-border">
                                    <button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                                </div>
                            </div>

                           
							
							                          

                        </section>
                    </div>-->
    </section>
    <!-- /.content -->
  </aside>
  <!-- /.right-side -->
</div>
<?php include_once("Footer.php"); ?>
        <!-- jQuery 2.0.2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app2.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>        

    </body>
</html>