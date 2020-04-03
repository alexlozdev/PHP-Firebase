<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('DataManager.php');

$dataManager = new DataManager();

if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
		$title = $_POST['title'];
		$content = $_POST['description'];
		$user = $_SESSION['user']['id'];
		$group = $_POST['group'];

		//push notification									
		$groups = $dataManager->send_messages($group, $title, $content);
		// mysql
		$sql = "INSERT INTO `messages` (`user_id` ,`group`, `title`, `content`) VALUES ($user ,'$group', '$title', '$content')";
		$results = $conn->query($sql);

		if ($results) {
			$msg = "Message Send";
		} else {
			$error = $group;
		}
	}

	$max_cnt = 200;
	$sql = "SELECT * from admin;";
	$results = $conn->query($sql);
	if ($results->num_rows > 0) {
		$result = $results->fetch_assoc();
		$max_cnt = $result['max_cnt'];
	}

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

		<title>Edit Profile</title>

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

		<script type="text/javascript" src="../vendor/countries.js"></script>
		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #dd3d36;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #5cb85c;
				color: #fff;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>


	</head>

	<body>

		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-12">
									<h2>Send Group Message</h2>
									<div class="panel panel-default">
										<div class="panel-heading">New Message</div>
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">

												<div class="form-group">
													<label class="col-sm-2 control-label">Group<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<!--<input class="form-control" name="group"></input>-->
														<select id="group" name="group" class="form-control">
															<?php
															$groups = $dataManager->get_groups();
															//echo json_encode($groups);
															if (!empty($groups)) {
																foreach ($groups as $group) {
																	$name = $group['name'];
																	$option = '<option class="form-control" value="' . $name . '">' . $name . '</option>';
																	if (isset($_POST['group'])) {
																		if (strcmp($_POST['group'], $name) == 0) {
																			$option = '<option class="form-control" value="' . $name . '" selected>' . $name . '</option>';
																		}
																	}

																	echo $option;
																}
															}
															?>
														</select>
													</div>
												</div>

												<div class="form-group">
													<input type="hidden" name="user" value="<?php echo htmlentities($_SESSION['user']['email']); ?>">
													<label class="col-sm-2 control-label">Title<span style="color:red">*</span></label>
													<div class="col-sm-10">
														<input type="text" name="title" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Content(Max :&nbsp; <?php echo $max_cnt; ?> ) <span style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" rows="5" name="description" maxlength="<?php echo $max_cnt; ?>"></textarea>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<button class="btn btn-primary" name="submit" type="submit">Send</button>
													</div>
												</div>

											</form>
										</div>
									</div>
								</div>
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
		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() {
					$('.succWrap').slideUp("slow");
				}, 3000);
			});
		</script>
	</body>

	</html>
<?php } ?>