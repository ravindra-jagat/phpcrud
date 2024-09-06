<?php

if (isset($_POST["Employeeid"]) && !empty($_POST["Employeeid"])) {
	echo "Hello";

	require_once "config.php";

	$sql = "DELETE FROM kyc_confirmation WHERE Employeeid = ?";

	if ($stmt = mysqli_prepare($link, $sql)) {
		mysqli_stmt_bind_param($stmt, "i", $param_id);

		$param_id = $_POST["id"];

		if (mysqli_stmt_execute($stmt)) {
			header("location: index.php");
			exit();
		} else {
			echo "Error Occurred: " . mysqli_error($link);
		}
	} else {
		echo "Prepare failed: " . mysqli_error($link);
	}
	mysqli_stmt_close($stmt);
	mysqli_close($link);
} else {
	if (empty(trim($_GET["Employeeid"]))) {
		header("location: error.php");
		exit();
	}
}
?>
<!-- Design part of delete -->
<!DOCTYPE html>
<html>

<head>
	<title>Delete Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style>
		.modal-content {
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
			background-color: rgba(255, 255, 255, 0.9);
		}

		.modal-header {
			background-color: rgba(220, 53, 69, 0.9);
			color: #fff;
		}

		.modal-title {
			font-size: 18px;
		}

		.modal-body {
			font-size: 16px;
		}
	</style>
</head>

<body>
	<div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Record</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="#">
						<input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['Employeeid']); ?>">
						<p>Do you really want to delete?</p>
						<br>
						<div class="text-center">
							<input type="submit" value="Yes" class="btn btn-danger">
							<a href="index.php" class="btn btn-default">NO</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#deleteModal').modal('show');
		});
	</script>
</body>

</html>