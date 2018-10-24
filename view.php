<?php
	// check existance of id parameter
	if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
	{
		require_once "config.php";

		$sql = "SELECT *FROM products WHERE id = ?";

		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "i", $param_id);
			
			$param_id = trim($_GET["id"]);

			if(mysqli_stmt_execute($stmt))
			{
				$result = mysqli_stmt_get_result($stmt);

				// fetch result row as an associative array
				if(mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

						// retrive individual field value
						$name = $row["name"];
						$category = $row["category"];
						$qty = $row["quantity"];
						$size = $row["size"];
						$price = $row["price"];
						$image = $row["image"];

				}
				else
				{
					// redirect to error page
					header("location: error.php");
					exit();
				}
			}	
			else
			{
				echo "Error Occured";
			}
		}
		// close statement
		mysqli_stmt_close($stmt);

		// close connection
		mysqli_close($link);
	}
	else
	{
		header("location: error.php");
		exit();
	}
?>

<!-- Desgin part of view.php -->
<!DOCTYPE html>
<html>
<head>
	<title>View Record</title>
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
</head>
<body>
	<div class="wrapper">
		<div class="containter-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1>View Record</h1>
					</div>
					<div class="form-group">
						<label   >Product Name</label>
						<p class="form-control-static"><?php echo $row["name"]; ?></p>
					</div>
					<div class="form-group">
						<label>Product Size</label>
						<p class="form-control-static"><?php echo $row["size"]; ?></p>
					</div>
					<div class="form-group">
						<label>Product Category</label>
						<p class="form-control-static"><?php echo $row["category"]; ?></p>
					</div>
					<div class="form-group">
						<label>Product Quantity</label>
						<p class="form-control-static"><?php echo $row["quantity"]; ?></p>
					</div>
					<div class="form-group">
						<label>Product price</label>
						<p class="form-control-static"><?php echo $row["price"]; ?></p>
					</div>
					<p><a href="index.php" class="btn btn-primary">Back</a></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
