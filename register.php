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
    <link rel="stylesheet" href="src/css/Login/login.css">
</head>
<body>
    <div class="logo">Help Center</div>
    
    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">

    <div class="form-container">
        <form action="" method="post">
            <h3> Help Center </h3>
            <h2> Enter your Information to register </h2>
            <input type="text" name="first_name" required placeholder="First Name">
            <input type="text" name="last_name" required placeholder="Last Name">
            <input type="email" name="email" required placeholder="Email Address">
            <input type="password" name="password" required placeholder="Password">
            <select name="user_type">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="form-btn">
            <p> Already have an account? <a href="login.php"> Login now </a></p>
            <?php
                // Register system logic
                if (isset($_POST['submit'])) {
                    // Database credentials
                    $servername = "localhost"; // Change if using a different host
                    $username = "root"; // Database username
                    $password = ""; // Database password
                    $dbname = "ims_db"; // Database name

                    // Establish database connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Collect form data
                    $first_name = $conn->real_escape_string($_POST['first_name']);
                    $last_name = $conn->real_escape_string($_POST['last_name']);
                    $email = $conn->real_escape_string($_POST['email']);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
                    $user_type = $conn->real_escape_string($_POST['user_type']);

                    // Check if email already exists
                    $email_check = "SELECT * FROM users WHERE email = '$email'";
                    $result = $conn->query($email_check);

                    if ($result->num_rows > 0) {
                        echo "<p style='color:red;'>Email already registered. Please use a different email or log in.</p>";
                    } else {
                        // Insert user data into the database
                        $sql = "INSERT INTO users (first_name, last_name, email, password, user_type) VALUES ('$first_name', '$last_name', '$email', '$password', '$user_type')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color:green;'>Registration successful. You can <a href='login.php'>log in now</a>.</p>";
                        } else {
                            echo "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
                        }
                    }

                    // Close the database connection
                    $conn->close();
                }
            ?>
        </form>
        
        
    </div>
</body>
</html>
