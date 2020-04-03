<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('../DataManager.php');

$dataManager = new DataManager();
$groups = $dataManager->get_groups();

if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_GET['del']) && !empty($_GET['del'])) {
		$name = $_GET['del'];

		$result = $dataManager->remove_group($name);
		if ($result) {
			$msg = "Group Deleted successfully";
			
		} else {
			$error = "Group Deleted failed";
		}
		$groups = $dataManager->get_groups(true);
	}

	if (isset($_POST['new_group'])) {
		$name = $_POST['new_group'];
		if (empty($name)) {
			$error = "Can't be empty";
		} else {
			$dataManager->add_group($name);
			$msg = "Adding group succeed";
			$groups = $dataManager->get_groups(true);
		}
	}

	if (isset($_POST['edit_group'])) {
		$edit_group = $_POST['edit_group'];
		$old_group = $_POST['old_group'];

		if (empty($edit_group) || empty($old_group)) {
			$error = "Can't be empty";
		} else {
			$dataManager->edit_group($old_group, $edit_group);
			$msg = "Editing group succeed";
			$groups = $dataManager->get_groups(true);
		}
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

		<title>Manage Groups</title>

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

							<h2 class="page-title">Manage Groups</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">List Groups

								</div>
								<div class="panel-body">
								<?php if ($error) { ?><div class="errorWrap" id="msgshow">
											<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php } ?>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Rename</th>
												<th>Delete</th>
											</tr>
										</thead>

										<tbody>

											<?php
											$cnt = 1;

											foreach ($groups as $group) {	?>
												<tr>
													<td><?php echo htmlentities($cnt); ?></td>
													<td><?php echo htmlentities($group["name"]); ?></td>
													<td>
														<a href="edit-group.php?edit=<?php echo $group["name"]; ?>" onclick="return confirm('Do you want to Edit the Group?');"><i class="fa fa-pencil" style="color:green"></i></a>&nbsp;&nbsp;
													</td>
													<td>
														<a href="grouplist.php?del=<?php echo $group["name"]; ?>" onclick="return confirm('Do you want to Delete?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
													</td>
												</tr>
											<?php $cnt = $cnt + 1;
											}
											?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<form method="post" class="form-horizontal" enctype="form-data">
			<div class="form-group">
				<label class="col-sm-3 control-label">New Group<span style="color:red">*</span></label>
				<div class="col-sm-4">
					<input type="text" name="new_group" class="form-control" value="">
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-3">
					<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
				</div>
			</div>

		</form>

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