<!DOCTYPE html>
<html>

<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"> -->

</head>

<body>
	<div class="wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header clearfix">
						<h2 class="pull-left">KYC Information</h2><a href="create.php"
							class="btn btn-success pull-right">Add KYC Info</a>
					</div>
					<?php
					require_once "config.php";

					$sql = "SELECT *FROM kyc_confirmation";
					if ($result = mysqli_query($link, $sql)) {
						if (mysqli_num_rows($result) > 0) {
							echo "<table class='table table-bordered table-striped'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th>#</th>";
							echo "<th>Name</th>";
							echo "<th>Birth Country</th>";
							echo "<th>Date of Birth</th>";
							echo "<th>Contact Number</th>";
							echo "<th>Email</th>";
							echo "<th>Employee Name</th>";
							echo "<th>ID Document</th>";
							echo "<th>ID Document File</th>";
							echo "<th>Nationality</th>";
							echo "<th>Post Address</th>";
							echo "<th>Occupation</th>";

							echo "</tr>";
							echo "</thead>";
							echo "<tbody>";
							while ($row = mysqli_fetch_array($result)) {
								echo "<tr>";
								echo "<td>" . $row['Employeeid'] . "</td>";
								echo "<td>" . $row['subjectname'] . "</td>";
								echo "<td>" . $row['birthcountry'] . "</td>";
								echo "<td>" . $row['dateofbirth'] . "</td>";
								echo "<td>" . $row['contactnumber'] . "</td>";
								echo "<td>" . $row['email'] . "</td>";
								echo "<td>" . $row['employeename'] . "</td>";
								echo "<td>" . $row['gender'] . "</td>";
								echo "<td>" . $row['iddocument'] . "</td>";
								echo "<td>" . $row['iddocumentfile'] . "</td>";
								echo "<td>" . $row['nationality'] . "</td>";
								echo "<td>" . $row['postaddress'] . "</td>";
								echo "<td>" . $row['occupation'] . "</td>";

								echo "<td>";
								echo "<a href='view.php?id=" . $row['Employeeid'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
								echo "<a href='update.php?id=" . $row['Employeeid'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
								echo "<a href='delete.php?id=" . $row['Employeeid'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
								echo "</td>";
								echo "</tr>";
							}
							echo "</tbody>";
							echo "</table>";
							mysqli_free_result($result);
						} else {
							echo "<p class='lead'><em> No record were Found</em></p>";
						}
					} else {
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