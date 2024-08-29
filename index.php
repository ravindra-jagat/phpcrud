<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->
	
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header clearfix">
						<h2 class="pull-left">Product Details</h2><a href="create.php" class="btn btn-success pull-right">Add Product Info</a>
					</div>
					<?php
						require_once "config.php";

						$sql ="SELECT *FROM products";
						if($result = mysqli_query($link, $sql))
						{
							if(mysqli_num_rows($result) > 0)
							{
								echo "<table class='table table-bordered table-striped'>";
								echo "<thead>";
									echo "<tr>";
										echo "<th>#</th>";
										echo "<th>Product Name</th>";
										echo "<th>Size</th>";
										echo "<th>Price</th>";
										echo "<th>Quantity</th>";
										echo "<th>Category</th>";
										echo "<th>Image</th>";
										echo "<th>Operation</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								while($row = mysqli_fetch_array($result))
								{
									echo "<tr>";
										echo "<td>" . $row['id'] . "</td>";
										echo "<td>" . $row['name'] . "</td>";
										echo "<td>" . $row['size'] . "</td>";
										echo "<td>" . $row['price'] . "</td>";
										echo "<td>" . $row['quantity'] . "</td>";
										echo "<td>" . $row['category'] . "</td>";
										echo "<td>" . $row['image'] . "</td>";
										echo "<td>";
                                            echo "<a href='view.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                       	echo "</td>";
                                       	echo "</tr>";
								}
								echo "</tbody>";
								echo "</table>";
								mysqli_free_result($result);
							}	
							else
							{
								echo "<p class='lead'><em> No record were Found</em></p>";
							}
						}
						else
						{
							echo "Error : Could not execute" . mysqli_error($link);
						}
						// close connection
						mysqli_close($link);
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>