<!DOCTYPE html>
<html>
<head>
	<title>INSERT RECORD</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/style.css">
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<form method="POST" action="create.php" class="form form-margin">
					<div class="form-group">
						<input type="text" name="name" placeholder="Product Name" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="text" name="category" placeholder="Category" required="" class="form-control">
					</div>
					
					<div class="form-group">
						<input type="text" name="size" placeholder="Product Size" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="number" name="qty" placeholder="Quantity" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="number" step="0.01" name="price" placeholder="Product Price" required="" class="form-control">
					</div>
					<div class="form-group">
						<input type="file" name="image" accept=".png, .jpg, .jpeg" class="pull-right">
					</div>
					<div class="form-group">
						<input type="submit" name="save" value="Submit" class="btn btn-success">
						<input type="submit" name="cancel" value="Cancel" class="btn btn-danger">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	require_once "config.php";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$name = $_POST["name"];
		$category = $_POST["category"];
		$size = $_POST["size"];
		$qty = $_POST["qty"];
		$price = $_POST["price"];
		$image = $_POST["image"];
		

		$sql = "INSERT INTO products(name, category, quantity, size, price, image) VALUES(?, ?, ?, ?, ?, ?)";
		if($stmt = mysqli_prepare($link, $sql))
		{
			mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_category, $param_quantity, $param_size, $param_price, $param_image);

			// set parameters
			$param_name = $name;
			$param_category = $category;
			$param_quantity = $qty;
			$param_size = $size;
			$param_price = $price;
			$param_image = $image;

			if(mysqli_stmt_execute($stmt))
			{
				header("location:index.php");
				 exit();
			}
			else
			{
				echo "Error Occured";
			}
			mysqli_stmt_close($stmt);
		}
		mysqli_close($link);
	}
?>