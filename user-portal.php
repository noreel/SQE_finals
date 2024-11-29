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

    <!-- File Links -->
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700|Fira+Sans:600" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cb15e73258.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/css/Help Center/landing.css">

</head>
<body>
    <div class="header">
        <div class="logo">Help Center</div>
        
        <!-- Profile Icon with Dropdown -->
        <div class="profile-icon" onclick="toggleDropdown(event)">
            <i class="fa-solid fa-user"></i>
            <div class="dropdown-content" id="profileDropdown">
                <!-- Name and Email should inherit the value from database -->
                <div class="dropdown-item"><a>Joshua Daniel Castillo</a></div>
                <div class="dropdown-item"><a1>Joshua.castillo@ciit.edu.ph</a1></div>
                <hr>
                <!-- Logout System (Session) -->
                <div class="dropdown-item"><b1>Profile</b1></div>
                <div class="dropdown-item"><b2>Logout</b2></div>
            </div>
        </div>
    </div>

    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">
    
    <div class="search-container">
        <div class="searchText">Welcome to the Help Center</div>
        
        <div class="search">
            <div class="fa fa-search"></div>
            <input type="text" placeholder="Search"/>
            <div class="fa fa-times"></div>
        </div>
    </div>

    <div class="portalText">Portals</div>
    
    <div class="portal-container"> 
        <div class="portals">
            <div class="portal-button" onclick="location.href='select-form.php'">
                <div class="portal-links">
                    <a>Customer Service</a> 
                    <a1>Welcome! You can ask questions or raise concern by choosing options provided.</a1> 
                </div>
            </div>

            <div class="portal-button" onclick="location.href='select-form.php'"> 
                <div class="portal-links">
                    <a>Technical Support</a> 
                    <a1>Welcome! You can raise a request for technical assistance using the options provided.</a1>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Dropdown Functionality -->
    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            document.getElementById("profileDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.profile-icon') && !event.target.matches('.dropdown-item')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>

</body>
</html>