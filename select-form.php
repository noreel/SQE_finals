<?php
  session_start();

  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
      // Redirect to login page if not logged in
      header("Location: login.php");
      exit();
  }

  // Get user attributes from session
  $user_type = $_SESSION['user_type'];
  $first_name = $_SESSION['first_name'];
  $email = $_SESSION['email'];
  $user_id = $_SESSION['user_id'];

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "ims_db";

  // Create connection
  $connection = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GRP3. - Incident Management Systems</title>

    <!-- External CSS Links -->
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="src/css/forms/select-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="logo">Help Center</div>
    
    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">
    
    <div class="form-container">
        <div class="header"> Customer Service </div>
        <div class="description">
            Welcome! You can ask questions or raise concern by choosing the options provided.
        </div>
        <div class="additional-info">
            <i class="fa-solid fa-message"></i> Feel free to reach out for any assistance!
        </div>

        <!-- Categories -->
        <div class="category-card" onclick="location.href='select-issue.php'">
            <div>
                <h2>Common Requests</h2>
                <p>Get IT help, Request a new account, Report a system problem, Report broken hardware</p>
            </div>
            <div class="arrow">&#x25B6;</div>
        </div>

        <div class="category-card">
            <div>
                <h2>Computers</h2>
                <p>Get IT help, Request new software, Report broken hardware, Request new hardware</p>
            </div>
            <div class="arrow">&#x25B6;</div>
        </div>

        <div class="category-card">
            <div>
                <h2>Logins and Accounts</h2>
                <p>Request admin access, Request a new account, Onboard new employees</p>
            </div>
            <div class="arrow">&#x25B6;</div>
        </div>

        <div class="category-card">
            <div>
                <h2>Applications</h2>
                <p>Request new software, Report a system problem</p>
            </div>
            <div class="arrow">&#x25B6;</div>
        </div>

        <div class="category-card">
            <div>
                <h2>Servers and Infrastructure</h2>
                <p>Report a system problem, Report broken hardware</p>
            </div>
            <div class="arrow">&#x25B6;</div>
        </div>
    </div>
</body>
</html>