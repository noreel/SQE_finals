<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ragnarok Project - Help Center</title>

    <!-- File Links -->
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,500,700|Fira+Sans:600|Poppins:400,600,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="src/css/forms/select-issue.css"> <!-- Link to external CSS -->
    
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
</head>
<body>
    <div class="logo">Help Center</div>
    
    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">
    
    <div class="form-container">
        <form>
            <h1>Customer Service</h1>
            <p>Welcome! You can raise a request for Ragnarok Project using the options provided.</p>
            
            <div class="dropdown">
                <label for="request-type">Contact us about</label>
                <select id="request-type" onchange="redirectToPage()">
                    <option value="common-requests">Common Requests</option>
                    <option value="computers">Computers</option>
                    <option value="logins-accounts">Logins and Accounts</option>
                    <option value="applications">Applications</option>
                    <option value="servers-infrastructure">Servers and Infrastructure</option>
                </select>
            </div>
            
            <p> What can we help you with? </p>
            
            <div class="options">
                <div class="option">
                    <i class="fa-solid fa-headset"></i>
                    <div class="text-container">
                        <h3>Get IT help</h3>
                        <p>Get assistance for general IT problems and questions.</p>
                    </div>
                </div>
                <div class="option">
                    <i class="fa-solid fa-user-plus"></i>
                    <div class="text-container">
                        <h3>Request a new account</h3>
                        <p>Request a new account for a system.</p>
                    </div>
                </div>
                <div class="option">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div class="text-container">
                        <h3>Report a system problem</h3>
                        <p>Let us know if something isn't working properly and we'll aim to get it back up and running quickly.</p>
                    </div>
                </div>
                <div class="option">
                    <i class="fa-solid fa-rectangle-xmark"></i>
                    <div class="text-container">
                        <h3>Report broken hardware</h3>
                        <p>Report hardware that might be faulty or broken e.g. a broken computer screen or a damaged server.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function redirectToPage() {
            const dropdown = document.getElementById("request-type");
            const selectedValue = dropdown.value;

            // Functionality for the redirects (Just for user experience)
            // Modify to your own discretion
            const urls = {
                "common-requests": "",
                "computers": "",
                "logins-accounts": "",
                "applications": "",
                "servers-infrastructure": "",
            };

            if (urls[selectedValue]) {
                window.location.href = urls[selectedValue];
            }
        }
    </script>
</body>
</html>