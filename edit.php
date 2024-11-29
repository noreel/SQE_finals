<?php
    session_start();

    $current_user_id = $_SESSION['user_id']; //logged-in user's ID is stored in the session
    $current_user_type = $_SESSION['user_type']; //ogged-in user's user_type
    $current_user_name = $_SESSION['first_name']; //logged-in user's first name

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ims_db";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $logged_in_firstname = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : '';



    $incident_id = "";
    $created_by = "";
    $status = ""; 
    $resolved_by = "";
    $description = "";
    $created_at = "";
    $updated_at = "";

    $user_options = '';
    $sql = "SELECT user_id, first_name FROM users WHERE user_type = 'admin' AND user_id != $current_user_id";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $selected = ($row['user_id'] == $resolved_by) ? 'selected' : '';
            $user_options .= "<option value='{$row['user_id']}' $selected>{$row['first_name']}</option>";
        }
    }

    $errorMessage = "";
    $successMessage = "";

    if ($_SERVER['REQUEST_METHOD'] == "GET") {
        if (!isset($_GET["incident_id"])) {
            header("location: user.php");
            exit;
        }
        $incident_id = $_GET["incident_id"];

        // Read rows from the table
        $sql = "SELECT incidents.*, users.first_name AS creator_name 
                FROM incidents 
                LEFT JOIN users ON incidents.created_by = users.user_id 
                WHERE incidents.incident_id = $incident_id";

        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header("location: user.php");
            exit;
        }


        $created_by = $row["creator_name"];
        $resolved_by = $row["resolved_by"];
        $priority_level = $row["priority_level"];
        $status = $row["status"];
        $description = $row["description"];
        $created_at = $row["created_at"];
        $updated_at = $row["updated_at"];
    } else {
        // POST request - Update incident
        $incident_id = $_POST["incident_id"];
        $created_by = $_POST["created_by"];
        $priority_level = $_POST["priority_level"];
        $status = $_POST["status"];
        $resolved_by = $_POST["resolved_by"];
        $description = $_POST["description"];
        $updated_at = $_POST["updated_at"];

        do {
            if (empty($created_by) || empty($status) || 
                empty($resolved_by) || empty($description)) {
                $errorMessage = "All fields are required";
                break;
            }
            
            $sql = "UPDATE incidents SET 
            priority_level = '$priority_level',
            status = '$status', 
            resolved_by = '$resolved_by', 
            updated_at = NOW() 
            WHERE incident_id = $incident_id";
            
            $result = $connection->query($sql);

            if (!$result) {
                $errorMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Incident Updated Successfully";
            header("location: admin.php");
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
                <label class="col-sm-3 col-form-label">Created By</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="created_by" value="<?php echo $created_by; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="priority_level" class="col-sm-3 col-form-label">Select Priority</label>
                <div class="col-sm-6">
                    <select id="priority_level" name="priority_level" class="form-select">
                        <option value="low" <?php echo $priority_level == 'low' ? 'selected' : ''; ?>>Low</option>
                        <option value="medium" <?php echo $priority_level == 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="high" <?php echo $priority_level == 'high' ? 'selected' : ''; ?>>High</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="status" class="col-sm-3 col-form-label">Select Status:</label>
                <div class="col-sm-6">
                    <select id="status" name="status" class="form-select">
                        <option value="Pending" <?php echo $status == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="Ongoing" <?php echo $status == 'Ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="Resolved" <?php echo $status == 'Resolved' ? 'selected' : ''; ?>>Resolved</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Resolved By</label>
                <div class="col-sm-6">
                <select id="resolved_by" name="resolved_by" class="form-select">
                    <!-- Add the current logged-in admin -->
                    <option value="<?php echo $current_user_id; ?>" selected><?php echo $current_user_name; ?></option>
                    <!-- other admin users -->
                    <?php echo $user_options; ?>
                </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Description</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="description" value="<?php echo $description; ?>" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <label for="created_at" class="col-sm-3 col-form-label">Created At:</label>
                <div class="col-sm-6">
                    <input type="text" id="created_at" name="created_at" class="form-control" value="<?php echo $created_at; ?>" readonly>
                </div>
            </div>  
            <div class="row mb-3">
                <label for="updated_at" class="col-sm-3 col-form-label">Updated At:</label>
                <div class="col-sm-6">
                    <input type="datetime-local" id="updated_at" name="updated_at" class="form-control" 
                    value="<?php echo date('Y-m-d\TH:i', strtotime($updated_at)); ?>" required>
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
                    <a class="btn btn-outline-primary" href="admin.php" role="button">Cancel</a>
                </div>
            </div>  
        </form>
    </div>
</body>
</html>
