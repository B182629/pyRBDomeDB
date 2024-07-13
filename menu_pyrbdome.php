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
      font-family: Arial, Helvetica, sans-serif; /* Set font family */
    }

    /* Style for the navigation bar */
    .topnav {
      overflow: hidden; /* Hide overflowing content */
      background-color: #79213c; /* Set background color */
      text-align: center; /* Center align the menu items */
    }

    /* Style for each navigation link */
    .topnav a {
      display: inline-block; /* Change from float to inline-block to create horizontal layout */
      color: #f2f2f2; /* Set text color */
      text-align: center; /* Center align text */
      padding: 20px 40px; /* Adjust padding as needed for spacing */
      text-decoration: none; /* Remove underline */
      font-size: 17px; /* Set font size */
    }

    /* Style for navigation links when hovered */
    .topnav a:hover {
      background-color: #f3d5de; /* Change background color on hover */
      color: black; /* Change text color on hover */
    }

    </style>
</head>

<body>

<!-- Navigation bar container -->
    <div class="topnav">
        <!-- Navigation links; active sets the 'default' page to Home -->
        <a class="active" href="home_pyrbdome.php">Home</a>
        <a href="search_uniprot_pyrbdome.php">Search UniProt ID</a>
        <a href="filter_pyrbdome.php"> Filter Results</a>
        <a href="jsmol_pyrbdome.php"> JSmol </a>
        <a href="sequence_pyrbdome.php"> Sequence </a>
        <a href="statistics_pyrbdome.php"> XgBoost Statistics </a>
    </div>

</body>
</html>