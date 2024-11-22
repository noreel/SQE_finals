<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "testdb";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $incident_id = "";
    $company_id = "";
    $created_by = "";
    $team_id = "";
    $status = ""; 
    $resolved_by = "";
    $description = "";
    $created_at = "";
    $updated_at = "";

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (!isset($_GET["incident_id"])) {
            header("location: /ims-main/queue.php");
            exit;
        }
        $incident_id = $_GET["incident_id"];

        // Read rows from the table
        $sql = "SELECT * FROM incidents WHERE incident_id=$incident_id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: /ims-main/queue.php");
            exit;
        }

        $company_id = $row["company_id"];
        $created_by = $row["created_by"];
        $team_id = $row["team_id"];
        $status = $row["status"];
        $resolved_by = $row["resolved_by"];
        $description = $row["description"];
        $created_at = $row["created_at"];
        $updated_at = $row["updated_at"];
    } else {
        // POST request - Update incident
        $incident_id = $_POST["incident_id"];
        $company_id = $_POST["company_id"];
        $created_by = $_POST["created_by"];
        $team_id = $_POST["team_id"];
        $status = $_POST["status"];
        $resolved_by = $_POST["resolved_by"];
        $description = $_POST["description"];
        $created_at = $_POST["created_at"];
        $updated_at = $_POST["updated_at"];

        do {
            if (empty($company_id) || empty($created_by) || empty($team_id) || empty($status) || 
                empty($resolved_by) || empty($description) || empty($created_at) || empty($updated_at)) {
                $errorMessage = "All fields are required";
                break;
            }
            
            $sql = "UPDATE incidents SET 
                        company_id = '$company_id', 
                        created_by = '$created_by', 
                        team_id = '$team_id', 
                        status = '$status', 
                        resolved_by = '$resolved_by', 
                        description = '$description', 
                        created_at = '$created_at', 
                        updated_at = '$updated_at' 
                    WHERE incident_id = $incident_id";
            
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Incident Updated Successfully";
            header("location: /ims-main/queue.php");
            exit; 
        } while (false);
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard - GRP3.</title>
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  </head>
<body>
    <div class="container my-5">
        <h2>Edit Incident</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
            <input type="hidden" name="incident_id" value="<?php echo $incident_id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Company ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="company_id" value="<?php echo $company_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Created By</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="created_by" value="<?php echo $created_by; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Team ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="team_id" value="<?php echo $team_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Select Status:</label>
                <div class="col-sm-6">
                    <select id="status" name="status" class="form-select">
                        <option value="ongoing" <?php echo $status == 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="closed" <?php echo $status == 'closed' ? 'selected' : ''; ?>>Closed</option>
                        <option value="open" <?php echo $status == 'open' ? 'selected' : ''; ?>>Open</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Resolved By</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="resolved_by" value="<?php echo $resolved_by; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="created_at" class="col-sm-3 col-form-label">Created At:</label>
                <div class="col-sm-6">
                    <input type="date" id="created_at" name="created_at" class="form-control" value="<?php echo $created_at; ?>" required>
                </div>
            </div>  
            <div class="row mb-3">
                <label for="updated_at" class="col-sm-3 col-form-label">Updated At:</label>
                <div class="col-sm-6">
                    <input type="date" id="updated_at" name="updated_at" class="form-control" value="<?php echo $updated_at; ?>" required>
                </div>
            </div>
            <?php
                if (!empty($successMessage)) {
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/ims-main/incident.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</body>
</html>
