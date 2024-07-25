<!-- This script generates visually appealing menu bar at the top of the webpage -->

<!-- Specify doctype as HTML and set language to English. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0; /* Remove default margin */
        }

        /* Style for the navigation bar */
        .topnav {
            overflow: hidden; /* Hide overflowing content */
            background-color: #f8f8f8; /* Set background color */
            border-bottom: 1px solid #d4d4d4; /* Add bottom border */
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Center items vertically */
            justify-content: space-between; /* Space between nav links and image */
            padding: 0 15px; /* Add padding for spacing */
        }

        /* Style for the container holding navigation links */
        .nav-links {
            display: flex; /* Use flexbox for layout */
            justify-content: center; /* Center the navigation links */
            flex: 1; /* Allow this flex item to grow */
        }

        /* Style for each navigation link */
        .topnav a {
            display: inline-block; /* Change from float to inline-block to create horizontal layout */
            color: #79213c; /* Set text color */
            text-align: center; /* Center align text */
            padding: 15px 40px; /* Adjust padding as needed for spacing */
            text-decoration: none; /* Remove underline */
            font-size: 18px; /* Set font size */
        }

        /* Style for navigation links when hovered */
        .topnav a:hover {
            background-color: #ececec; /* Change background color on hover */
            color: #3d061e; /* Change text color on hover */
        }

        /* Style for the image container */
        .logo-container {
            display: flex; /* Use flexbox for layout */
            align-items: center; /* Center the image vertically */
        }

        /* Style for the image */
        .topnav img {
            height: 40px; /* Set the height of the image */
        }
    </style>
</head>

<body>

    <!-- Navigation bar container -->
    <div class="topnav">
        <div class="logo-container">
            <img src="Images/logo.png" alt="Logo" style="opacity: 0;">
        </div>
        <div class="nav-links">
            <!-- Navigation links; active sets the 'default' page to Home -->
            <a class="active" href="home_pyrbdome.php">Home</a>
            <a href="filter_pyrbdome.php">Browse Results</a>
            <a href="sequence_pyrbdome.php">Prediction Plots</a>
            <a href="jsmol_pyrbdome.php">3D Prediction Structures</a>
            <a href="about_pyrbdome.php">About pyRBDome</a>
        </div>
        <div class="logo-container">
            <img src="Images/logo.png" alt="Logo">
        </div>
    </div>

</body>
</html>