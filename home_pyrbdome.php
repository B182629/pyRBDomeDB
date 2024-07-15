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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">

    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">

    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">

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
    <div class='container'>
        <br>
        <h3>pyRBDomeDB: Enhanced RNA-Binding Protein Data</h3>

        <p>pyRBDomeDB is a curated database compiling enhanced RNA-binding protein data generated by the pyRBDome pipeline. The pipeline utilises an XGBoost model, which combines RNA-binding amino acid prediction results from various individual predictor algorithms including <a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4150784/'>aaRNA</a>, <a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4987955/'>BindUP</a>, <a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC2647826/'>FTMap</a>, <a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4028231/'>RNABindRPlus</a>, and <a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4605291/'>DisoRDPbind</a>, to improve protein RNA-binding site predictions.</p>
        <p> More information about <a href='about_pyrbdome.php'> pyRBDome.</a></p>
        <h4>Features:</h4>
        <p><b>Browse pyRBDome Results Data: </b>Browse and filter pyRBDome RNA-binding site prediction data by several criterion, such as UniProt ID and prediction scores calculated by the XGBoost model or individual prediction algorithms.</p>
        <p><b>View Prediction Plots: </b>Retrieve prediction score plots for a UniProt ID of interest. These plots display the RNA-binding probabilities of each amino acid in the protein sequence determined by the XGBoost model.</p>
        <p><b>Jmol Visualisation: </b>Interactively view the protein structure generated based on prediction results. </p>
        <h4>Getting started:</h4>

    </div>

    <?php include 'footer_pyrbdome.php'; ?>
</body>
</html>
