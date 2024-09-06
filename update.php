<?php
require_once "config.php";

if (isset($_POST["Employeeid"]) && !empty($_POST["Employeeid"])) {
	$id = $_POST["Employeeid"];
	$name = $_POST["subjectname"];
	$birthcountry = $_POST["birthcountry"];
	$dateofbirth = $_POST["dateofbirth"];
	$contactnumber = $_POST["contactnumber"];
	$email = $_POST["email"];
	$employeename = $_POST["employeename"];
	$gender = $_POST["gender"];
	$iddocument = $_POST["iddocument"];
	$iddocumentfile = $_POST["iddocumentfile"];
	$nationality = $_POST["nationality"];
	$postaddress = $_POST["postaddress"];
	$occupation = $_POST["occupation"];

	$sql = "UPDATE products SET subjectname=?, birthcountry=?, contactnumber=?, email=?, employeename=?, gender=?, iddocument=?, iddocumentfile=?, nationality=?, occupation=? WHERE Employeeid=?";

	if ($stmt = mysqli_prepare($link, $sql)) {
		// Bind variables
		mysqli_stmt_bind_param($stmt, "ssssssi", $name, $birthcountry, $contactnumber, $email, $employeename, $gender, $iddocument, $nationality, $postaddress, $occupation, $dateofbirth, $iddocumentfile, $id);

		// // set parameters
		// $param_name = $name;
		// $param_category = $category;
		// $param_size = $size;
		// $param_quantity = $qty;
		// $param_price = $price;
		// $param_image = $image;
		// $param_id = $id;

		// execute the prepared statement
		if (mysqli_stmt_execute($stmt)) {
			header("location: index.php");
			exit();
		} else {
			echo "Something is wrong";
		}
	}
	// close statement
	mysqli_stmt_close($stmt);

	mysqli_close($link);

} else {
	// check existance of id parameter
	if (isset($_GET["Employeeid"]) && !empty(trim($_GET["Employeeid"]))) {
		require_once "config.php";

		$sql = "SELECT *FROM kyc_confirmation WHERE Employeeid = ?";

		if ($stmt = mysqli_prepare($link, $sql)) {
			mysqli_stmt_bind_param($stmt, "i", $param_id);

			$param_id = trim($_GET["Employeeid"]);

			if (mysqli_stmt_execute($stmt)) {
				$result = mysqli_stmt_get_result($stmt);

				// fetch result row as an associative array
				if (mysqli_num_rows($result) == 1) {
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					// retrive individual field value
					$name = $row["subjectname"];
					$birthcountry = $row["birthcountry"];
					$dateofbirth = $row["dateofbirth"];
					$contactnumber = $row["contactnumber"];
					$email = $row["email"];
					$employeename = $row["employeename"];
					$gender = $row["gender"];
					$iddocument = $row["iddocument"];
					$iddocumentfile = $row["iddocumentfile"];
					$nationality = $row["nationality"];
					$postaddress = $row["postaddress"];
					$occupation = $row["occupation"];

				} else {
					// redirect to error page
					header("location: error.php");
					exit();
				}
			} else {
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
								<label>Name</label>
								<input type="text" name="subjectname" class="form-control" value="<?php echo $name; ?>">
							</div>
							<div class="form-group">
								<label>Country of birth</label>
								<input type="text" name="birthcountry" class="form-control"
									value="<?php echo $birthcountry ?>">
							</div>
							<div class="form-group">
								<label>date of birth</label>
								<input type="text" name="dateofbirth" class="form-control"
									value="<?php echo $dateofbirth ?>">
							</div>
							<div class="form-group">
								<label>Contact Number</label>
								<input type="text" name="contactnumber" class="form-control"
									value="<?php echo $contactnumber ?>">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control" value="<?php echo $email ?>">
							</div>
							<div class="form-group">
								<label>Employee Name</label>
								<input type="text" name="employeename" value="<?php echo $employeename ?>">
							</div>
							<div class="form-group">
								<label> Gender</label>
								<input type="text" name="gender" value="<?php echo $gender ?>">
							</div>
							<div class="form-group">
								<label>id document</label>
								<input type="text" name="iddocument" value="<?php echo $iddocument ?>">
							</div>
							<div class="form-group">
								<label> id document file</label>
								<input type="file" name="iddocumentfile" value="<?php echo $iddocumentfile ?>">
							</div>
							<div class="form-group">
								<label> nationality</label>
								<input type="text" name="nationality" value="<?php echo $nationality ?>">
							</div>
							<div class="form-group">
								<label>postal address </label>
								<input type="text" name="postaddress" value="<?php echo $postaddress ?>">
							</div>
							<div class="form-group">
								<label>Occupation </label>
								<input type="text" name="occupation" value="<?php echo $occupation ?>">
							</div>
							<input type="hidden" name="Employeeid" value="<?php echo $id ?>">
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