<?php

// This php script is the homepage of the website and is the destination after login on complib.php. It contains information about the database as well as brief tool introduction.

// Start session management.
session_start();
include 'menu_pyrbdome.php'; // Include menu script to show menu bar.
?>

<!-- Specify doctype as HTML and set language to English. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Sets character encoding to UTF-8 for proper rendering of text content, and set viewport properties to device width -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Include Bootstrap CSS for pre designed components for responsive websites to enhance website aesthetic -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home</title>

    <style>
        /* Define CSS rules to style links to set initial link color to black and remove underline */
        .black-link {
            color: black;
            text-decoration: none;
        }

        /* Define CSS rules to change link color to blue and add underline on cursor hover */
        .black-link:hover {
            color: blue; /* Change link color to blue on hover */
            text-decoration: underline; /* Add underline on hover */
        }
    </style>
</head>

<body>
    <!-- build layout of website using bootstrap CSS -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Card for CompoundFinder -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h3>CompoundFinder: Search and Filter Molecular Compounds</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>
                                    <!-- JavaScript to display greeting based on time of the day -->
                                    <script type="text/javascript">
                                        var dt = new Date();
                                        var thours = dt.getHours();
                                        if (thours < 12) {
                                            document.write("<span>Good Morning, Welcome to CompoundFinder!</span>");
                                        } else if (thours < 18) {
                                            document.write("<span>Good Afternoon, Welcome to CompoundFinder!</span>");
                                        } else {
                                            document.write("<span>Good Evening, Welcome to CompoundFinder!</span>");
                                        }
                                    </script>
                                </h4>
                                <!-- Information about CompoundFinder including manufacturers links -->
                                <p>This database compiles information about properties of molecular compounds supplied from <a href="https://www.asinex.com/">Asinex</a>, <a href="https://www.keyorganics.net/">KeyOrganics</a>, <a href="https://www.thermofisher.com/uk/en/home/chemicals/maybridge.html">MayBridge</a>, <a href="https://www.nanosyn.com/">Nanosyn</a> and Oai40000. The database contains compound properties for each compound, including atomic composition, such as number of hydrogen and carbons atoms, structural properties, such as number of rotatble bonds, and other relevant chemical properties, such as the LogP estimate.</p>
                                <p>The collection of molecules in this database is derived from <a href="http://eduliss.bch.ed.ac.uk/">EDULISS</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card for Tool Usage and Help -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Tool Usage and Help</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Links to tools where hyperlink is hidden until cursor moves over it for better clarity -->
                                <h5><a href="https://bioinfmsc8.bio.ed.ac.uk/~s2012003/supp2.php" class="black-link">Filter Compounds</a></h5>
                                <p>This tool allows you to filter compounds by manufacturer, atomic composition and other chemical properties.</p>
                                <h5><a href= "https://bioinfmsc8.bio.ed.ac.uk/~s2012003/new_search.php" class="black-link">Search Compounds</a></h5>
                                <p>This tool allows you to search for specific compounds using their full or partial catalogue name, and provides additional compound information.</p>
                                <h5><a href="https://bioinfmsc8.bio.ed.ac.uk/~s2012003/new_smiles.php" class="black-link">SMILES Search</a></h5>
                                <p>This tool allows you to search for compounds using a full or partial SMILES string.</p>
                                <h5><a href="https://bioinfmsc8.bio.ed.ac.uk/~s2012003/db_stats.php" class="black-link">Statistics</a></h5>
                                <p>This page shows basic database statistics regarding the compound properties, including average, standard deviation, minimum and maximum values for selected manufacturers. Data distribution can also be visualized.</p>
                                <h5><a href="https://bioinfmsc8.bio.ed.ac.uk/~s2012003/correlations.php" class="black-link">Correlations</a></h5>
                                <p>This page allows you to select two compound properties to view their correlation. It is important to first select preferred manufacturers on the Statistics page before using this tool.</p>
                                <p style="color: gray;"><i>Click on a tool name to find out more.</i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>