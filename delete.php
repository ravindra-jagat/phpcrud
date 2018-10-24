<?php
	if(isset($_POST["id"]) && !empty($_POST["id"]))
	{
		require_once "config.php";

		$sql = "DELETE FROM products WHERE id = ?";

		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "i", $param_id);

			$param_id = $_POST["id"];

			if(mysqli_stmt_execute($stmt))
			{
				// header("location: index.php");
				// exit();
			}
			else
			{
				echo "Error Occured !";
			}
		}
		mysqli_stmt_close($stmt);

		mysqli_close($link);
	}
	else
	{
		if(empty(trim($_GET["id"])))
		{
			// header("location:error.php");
			// exit();
		}
	}
?>
<!-- Design part of delete -->
<!DOCTYPE html>
<html>
<head>
	<title>Delete Page</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>Delete Record</h1>
					</div>
					<form method="POST" action="index.php">
						<div class="alert alert-danger fade in">
							<input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>">
							<p>Do you really want to delete ?</p>
							<br>
							<p>
								<input type="submit" name="" value="Yes" class="btn btn-danger">
								<a href="index.php" class="btn btn-default">NO</a>
							</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>