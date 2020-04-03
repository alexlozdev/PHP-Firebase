<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('../DataManager.php');

if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	$dataManager = new DataManager();
?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>Admin Dashboard</title>

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Dashboard</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="row">
									<div class="col-md-2">
											<a href="setting.php">
												<div class="panel panel-default">
													<div class="panel-body bk-info text-light">
														<div class="stat-panel text-center">
															<?php
															$sql = "SELECT * from admin";
															$query = $dbh->prepare($sql);
															$query->execute();
															$result = $query->fetch(PDO::FETCH_OBJ);
															$cnt = $result->max_cnt;
															?>
															<div class="stat-panel-number h1 "><?php echo htmlentities($cnt); ?></div>
															<div class="stat-panel-title text-uppercase">Message Length Limit</div>
														</div>
													</div>
													<div class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></div>
												</div>
											</a>
										</div>

										<div class="col-md-2">
											<a href="userlist.php">
												<div class="panel panel-default">
													<div class="panel-body bk-primary text-light">
														<div class="stat-panel text-center">
															<?php
															$sql = "SELECT id from users";
															$query = $dbh->prepare($sql);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_OBJ);
															$bg = $query->rowCount();
															?>
															<div class="stat-panel-number h1 "><?php echo htmlentities($bg); ?></div>
															<div class="stat-panel-title text-uppercase">Total Users</div>
														</div>
													</div>
													<div class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></div>
												</div>
											</a>
										</div>									

										<div class="col-md-2">
											<a href="grouplist.php">
												<div class="panel panel-default">
													<div class="panel-body bk-warning text-light">
														<div class="stat-panel text-center">
															<?php
															$groups = $dataManager->get_groups();
															$bg = count($groups);
															?>
															<div class="stat-panel-number h1 "><?php echo htmlentities($bg); ?></div>
															<div class="stat-panel-title text-uppercase">Total Groups</div>
														</div>
													</div>
													<div class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></div>
												</div>
											</a>
										</div>									

										<div class="col-md-2">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">

														<?php
														$reciver = 'Admin';
														$sql1 = "SELECT * from messages";
														$query1 = $dbh->prepare($sql1);;
														//$query1->bindParam(':reciver', $reciver, PDO::PARAM_STR);
														$query1->execute();
														$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
														$regbd = $query1->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($regbd); ?></div>
														<div class="stat-panel-title text-uppercase">Messages History</div>
													</div>
												</div>
												<a href="#" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>

									</div>

								</div>
							</div>
						</div>

						<!-- Loading Scripts -->
						<script src="js/jquery.min.js"></script>
						<script src="js/bootstrap-select.min.js"></script>
						<script src="js/bootstrap.min.js"></script>
						<script src="js/jquery.dataTables.min.js"></script>
						<script src="js/dataTables.bootstrap.min.js"></script>
						<script src="js/Chart.min.js"></script>
						<script src="js/fileinput.js"></script>
						<script src="js/chartData.js"></script>
						<script src="js/main.js"></script>

						<script>
							window.onload = function() {

								// Line chart from swirlData for dashReport
								var ctx = document.getElementById("dashReport").getContext("2d");
								window.myLine = new Chart(ctx).Line(swirlData, {
									responsive: true,
									scaleShowVerticalLines: false,
									scaleBeginAtZero: true,
									multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
								});

								// Pie Chart from doughutData
								var doctx = document.getElementById("chart-area3").getContext("2d");
								window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
									responsive: true
								});

								// Dougnut Chart from doughnutData
								var doctx = document.getElementById("chart-area4").getContext("2d");
								window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
									responsive: true
								});

							}
						</script>
	</body>

	</html>
<?php } ?>