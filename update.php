<?php
	require_once "config.php";

	if(isset($_POST["id"]) && !empty($_POST["id"]))
	{
		$id = $_POST["id"];
		$name = $_POST["name"];
		$category = $_POST["category"];
		$size = $_POST["size"];
		$qty = $_POST["qty"];
		$price = $_POST["price"];
		$image = $_POST["image"];
		
		$sql = "UPDATE products SET name=?, category=?, quantity=?, size=?, price=?, image=? WHERE id=?";

		if($stmt = mysqli_prepare($link, $sql))
		{
			// Bind variables
			mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_category, $param_quantity, $param_size, $param_price, $param_image, $param_id);

			// set parameters
			$param_name = $name;
			$param_category = $category;
			$param_size = $size;
			$param_quantity = $qty;
			$param_price = $price;
			$param_image = $image;
			$param_id = $id;

			// execute the prepared statement
			if(mysqli_stmt_execute($stmt))
			{
				header("location: index.php");
				exit();
			}
			else
			{
				echo "Something is wrong";
			}
		}
		// close statement
		mysqli_stmt_close($stmt);
		
		mysqli_close($link);

	}
	else
	{
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
	}
?>
<!-- Design code of update Module -->
<!DOCTYPE html>
<html>
<head>
	<title>Update Module</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="page-header">
						<h2>Update Record</h2>
						<form method="POST" action="index.php">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
							</div>
							<div class="form-group">
								<label>Product Category</label>
								<input type="text" name="category" class="form-control" value="<?php echo $category ?>">
							</div>
							<div class="form-group">
								<label>Product Qty.</label>
								<input type="number" name="qty" class="form-control" value="<?php echo $qty ?>">
							</div>
							<div class="form-group">
								<label>Product Size</label>
								<input type="text" name="size" class="form-control" value="<?php echo $size ?>">
							</div>
							<div class="form-group">
								<label>Product Price</label>
								<input type="text" name="price" class="form-control" value="<?php echo $price ?>">
							</div>
							<div class="form-group">
								<label>Product Image</label>
								<input type="file" name="image" value="<?php echo $image ?>">
							</div>
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="submit" class="btn btn-primary" value="Submit">
							<a href="index.php" class="btn btn-default">Cancel</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>