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
    <link rel="stylesheet" href="src/css/login/login.css">
</head>
<body>
    <div class="logo">Help Center</div>
    
    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">
    
    <div class="form-container">
        <form action="" method="post">
            <h3> Help Center </h3>
            <h2> Login to continue </h2>
            <input type="email" name="email" required placeholder="Email Address">
            <input type="password" name="password" required placeholder="Password">
            <input type="submit" name="submit" value="Login" class="form-btn">
            <p> Don't have an account? <a href="register.php"> Register now </a></p>

            <?php
            session_start();

            if (isset($_POST['submit'])) {
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ims_db";

                // connect db
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Collect form data
                $email = $conn->real_escape_string($_POST['email']);
                $password = $_POST['password'];

                // Check if user exists
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();

                    // Verify password
                    if (password_verify($password, $user['password'])) {
                        // Store user info in the session
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_type'] = $user['user_type'];
                        $_SESSION['first_name'] = $user['first_name'];

                        // Redirect based on user type
                        if ($user['user_type'] == 'admin') {
                            header("Location: admin.php");
                            exit();
                        } else {
                            header("Location: user.php");
                            exit();
                        }
                    } else {
                        echo "<p style='color:red; margin-top:10px;'>Incorrect password. Please try again.</p>";
                    }
                } else {
                    echo "<p style='color:red; margin-top:10px;'>No account found with that email. Please register.</p>";
                }

                // Close the database connection
                $conn->close();
            }
        ?>
        </form>

    </div>
</body>
</html>
