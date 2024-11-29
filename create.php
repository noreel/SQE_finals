<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ims_db";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $logged_in_firstname = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';

    $user_options = '';
    $sql = "SELECT user_id, first_name FROM users WHERE user_type = 'user'";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selected = ($row['first_name'] == $logged_in_firstname) ? 'selected' : '';
            $user_options .= "<option value='{$row['user_id']}' $selected>{$row['first_name']}</option>";
        }
    }

    //$company_id = "";
    $created_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    //$team_id = "";
    $priority_level = "low";
    $status = "pending"; // Default status
    //$resolved_by = "";
    $summary = "";
    $description = "";
    $affected_organization = "";
    $created_at = date("Y-m-d H:i:s");
    //$updated_at = "";

    $errorMessage = "";
    $successMessage = "";

    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $created_by = trim($_POST["created_by"]);
        $summary = trim($_POST["summary"]);
        $description = trim($_POST["description"]);
        $affected_organization = trim($_POST["affected_organization"]);
    
        do {
            if (empty(trim($created_by)) || empty(trim($priority_level)) || empty(trim($summary)) || empty(trim($description)) || empty(trim($affected_organization))) {
                $errorMessage = "All fields are required.";
                break;
            }
    
            $stmt = $connection->prepare("INSERT INTO incidents (created_by, priority_level, status, summary, description, affected_organization) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $created_by, $priority_level, $status, $summary, $description, $affected_organization);
    
            if (!$stmt->execute()) {
                $errorMessage = "Database error: " . $stmt->error;
                break;
            }
    
            $stmt->close();
            $_SESSION['successMessage'] = "Client added successfully";
            header("location: user.php");
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
    <div class="container my-5 ">
        <h2>New Issue</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='CLOSE'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
            <!-- <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Company ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="company_id" value="<?php echo $company_id; ?>">
                </div>
            </div> -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Created By</label>
                <div class="col-sm-6">
                    <select id="created_by" name="created_by" class="form-select">
                        <?php echo $user_options; ?>
                    </select>
                </div>
            </div>

            <!-- <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Team ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="team_id" value="<?php echo $team_id; ?>">
                </div>
            </div> -->

            <!-- <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Select Status:</label>
                <div class="col-sm-6">
                    <select id="status" name="status" class="form-select">
                        <option value="ongoing" <?php echo $status == 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="closed" <?php echo $status == 'closed' ? 'selected' : ''; ?>>Closed</option>
                        <option value="open" <?php echo $status == 'open' ? 'selected' : ''; ?>>Open</option>
                    </select>
                </div>
            </div> -->

            <!-- <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Resolved By</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="resolved_by" value="<?php echo $resolved_by; ?>">
                </div>
            </div> -->

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Summary</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="summary" value="<?php echo $summary; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Affected Organization</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="affected_organization" value="<?php echo $affected_organization; ?>">
                </div>
            </div>

            <!-- <div class="row mb-3">
                <label for="created_at" class="col-sm-3 col-form-label">Created At:</label>
                <div class="col-sm-6">
                    <input type="date" id="created_at" name="created_at" class="form-control" value="<?php echo $created_at; ?>" required>
                </div>
            </div>   -->
            
            <!-- <div class="row mb-3">
                <label for="updated_at" class="col-sm-3 col-form-label">Updated At:</label>
                <div class="col-sm-6">
                    <input type="date" id="updated_at" name="updated_at" class="form-control" value="<?php echo $updated_at; ?>" required>
                </div>
            </div>  -->

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
                    <a class="btn btn-outline-primary" href="user.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</body>
</html>
