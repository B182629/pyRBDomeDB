<!-- This script generates visually appealing menu bar at the top of the webpage -->

<!-- Specify doctype as HTML and set language to English. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Sets character encoding to UTF-8 for proper rendering of text content, and set viewport properties to device width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* Apply styles to the entire body */
    body {
      margin: 0; /* Remove default margin */
    }

    /* Style for the navigation bar */
    .topnav {
      overflow: hidden; /* Hide overflowing content */
      background-color: #f4f4f4; /* Set background color */
      text-align: center; /* Center align the menu items */
      border-bottom: 1px solid #d4d4d4; /* Add bottom border */
    }

    /* Style for each navigation link */
    .topnav a {
      display: inline-block; /* Change from float to inline-block to create horizontal layout */
      color: #79213c; /* Set text color */
      text-align: center; /* Center align text */
      padding: 15px 40px; /* Adjust padding as needed for spacing */
      text-decoration: none; /* Remove underline */
      font-size: 17px; /* Set font size */
    }

    /* Style for navigation links when hovered */
    .topnav a:hover {
      background-color: #ececec; /* Change background color on hover */
      color: #3d061e; /* Change text color on hover */
    }

    </style>
</head>

<body>

<!-- Navigation bar container -->
    <div class="topnav">
        <!-- Navigation links; active sets the 'default' page to Home -->
        <a class="active" href="home_pyrbdome.php">Home</a>
        <a href="filter_pyrbdome.php"> Browse Results </a>
        <a href="sequence_pyrbdome.php"> Prediction Plots </a>
        <a href="jsmol_pyrbdome.php">3D Prediction Structures </a>
        <a href="about_pyrbdome.php"> About pyRBDome </a>
    </div>

</body>
</html>