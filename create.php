<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "testdb";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $company_id = "";
    $created_by = "";
    $team_id = "";
    $status = "ongoing"; // Default status
    $resolved_by = "";
    $description = "";
    $created_at = "";
    $updated_at = "";

    $errorMessage = "";
    $successMessage = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $company_id = htmlspecialchars($_POST["company_id"]);
        $created_by = htmlspecialchars($_POST["created_by"]);
        $team_id = htmlspecialchars($_POST["team_id"]);
        $status = htmlspecialchars($_POST["status"]);
        $resolved_by = htmlspecialchars($_POST["resolved_by"]);
        $description = htmlspecialchars($_POST["description"]);
        $created_at = htmlspecialchars($_POST["created_at"]);
        $updated_at = htmlspecialchars($_POST["updated_at"]);

        do {
            if ( empty($company_id) || empty($created_by) || empty($team_id) || empty($status) || empty($resolved_by) || empty($description) || empty($created_at) || empty($updated_at))
            {
                $errorMessage = "All fields are requried";
                break;
            }

            //Add client fields

            $sql = "INSERT INTO incidents (company_id, created_by, team_id, status, resolved_by, description, created_at, updated_at)" .
                    "VALUES ('$company_id', '$created_by', '$team_id', '$status', '$resolved_by', '$description', '$created_at', '$updated_at')";
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query:" . $connection->error;
                break;
            }

            $company_id = "";
            $created_by = "";
            $team_id = "";
            $status = ""; 
            $resolved_by = "";
            $description = "";
            $created_at = "";
            $updated_at = "";

            $successMessage = "Client Added Successfully";

            header("location:/ims-main/queue.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <!-- Other required links and scripts here -->
  </head>
<body>
      <div class="container my-5">
        <h2>New Client</h2>
        <?php
            if ( !empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='CLOSE'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
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
                if ( !empty($successMessage)) {
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='CLOSE'></button>
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
