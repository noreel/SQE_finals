<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GRP3. - Incident Management Systems</title>
    
    <!-- Link to External CSS -->
    <link rel="icon" href="src/img/favicon/favicon-32x32.png" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="src/css/forms/form.css"> <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="logo">Help Center</div>
        
    <img src="src/img/login-background-image.jpg" alt="Background Image" class="background-image">

    <div class="form-container">
            <form onsubmit="return validateForm()">
                <h1>Customer Service</h1>
                <p>Welcome! You can raise a request for Ragnarok Project using the options provided.</p>
                
                <!-- Dropdown Section -->
                <label for="request-type">Contact us about</label>
                <select id="request-type" onchange="redirectToPage()">
                    <option value="common-requests">Common Requests</option>
                    <option value="computers">Computers</option>
                    <option value="logins-accounts">Logins and Accounts</option>
                    <option value="applications">Applications</option>
                    <option value="servers-infrastructure">Servers and Infrastructure</option>
                </select>
                
                <!-- Request Type Options -->
                <label>What can we help you with?</label>
                <div class="option">
                    <i class="fa-solid fa-headset"></i>
                    <div>
                        <h3>Get IT help</h3>
                        <p>Get assistance for general IT problems and questions.</p>
                    </div>
                </div>
                
                <!-- Static Field for Name -->
                <label>Raise this request on behalf of</label>
                <div class="static-field">Joshua Daniel Bonito Castillo (joshua.castillo@ciit.edu.ph)</div>

                <!-- Summary Input -->
                <label for="summary">Summary</label>
                <input type="text" id="summary" placeholder="Briefly describe your issue" required>
                
                <!-- Description Text Area -->
                <label for="description">Description</label>
                <textarea id="description" rows="4" placeholder="Provide more details about your request"  style="resize: none;"></textarea>
            
                <!-- Attachment Input -->
                <label>Attachment</label>
                <input type="file" id="attachment">
                
                <!-- Submit Button -->
                <button type="submit" class="submit-btn">Send</button>
            </form>
        </div>

    <script>
        function validateForm() {
            const summary = document.getElementById('summary').value;
            const description = document.getElementById('description').value;
            if (!summary || !description) {
                alert("Please fill in all required fields.");
                return false;
            }
            return true;
        }

        function redirectToPage() {
            const dropdown = document.getElementById("request-type");
            const selectedValue = dropdown.value;

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