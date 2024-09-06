<?php
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
} else {
    header("location: error.php");
    exit();
}
?>

<!-- Desgin part of view.php -->
<!DOCTYPE html>
<html>

<head>
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .centered-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .content-box {
            width: 100%;
            max-width: 600px;
            /* Adjust the max width as needed */
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="centered-content">
        <div class="content-box">
            <div class="page-header">
                <h1>View Record</h1>
            </div>
            <div class="form-group">
                <label>Name</label>
                <p class="form-control-static"><?php echo $row["subjectname"]; ?></p>
            </div>
            <div class="form-group">
                <label>Country of Birth</label>
                <p class="form-control-static"><?php echo $row["birthcountry"]; ?></p>
            </div>
            <div class="form-group">
                <label>Contact Number</label>
                <p class="form-control-static"><?php echo $row["contactnumber"]; ?></p>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <p class="form-control-static"><?php echo $row["email"]; ?></p>
            </div>
            <div class="form-group">
                <label>Name of Employee</label>
                <p class="form-control-static"><?php echo $row["employeename"]; ?></p>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <p class="form-control-static"><?php echo $row["gender"]; ?></p>
            </div>
            <div class="form-group">
                <label>Document Type</label>
                <p class="form-control-static"><?php echo $row["iddocument"]; ?></p>
            </div>
            <div class="form-group">
                <label>Document</label>
                <p class="form-control-static"><?php echo $row["iddocumentfile"]; ?></p>
            </div>
            <div class="form-group">
                <label>Nationality</label>
                <p class="form-control-static"><?php echo $row["nationality"]; ?></p>
            </div>
            <div class="form-group">
                <label>Postal Address</label>
                <p class="form-control-static"><?php echo $row["postaddress"]; ?></p>
            </div>
            <div class="form-group">
                <label>Occupation</label>
                <p class="form-control-static"><?php echo $row["occupation"]; ?></p>
            </div>
            <p><a href="index.php" class="btn btn-primary">Back</a></p>
        </div>
    </div>
</body>

</html>