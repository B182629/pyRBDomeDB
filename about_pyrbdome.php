<?php

// This webpage contains information about the pyRBDome pipeline

session_start(); // Start session management
include 'menu_pyrbdome.php'; // Include menu script to show menu bar
?>

<!-- Specify doctype as HTML and set language to English -->
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
</head>

<body>
    <!-- Info about webpage -->
    <div class='container'>
        <br>
        <h3>pyRBDome: A Pipeline for Enhancing RNA-Binding Protein Data</h3>
        <p>The pyRBDome pipeline employs multiple RNA-binding prediction algorithms and a novel XGBoost model to refine and enhance the identification of RNA-binding amino acids in proteins. RNA-binding amino acid predictions from individual prediction algorithms are fed to the XGBoost model to generate RNA-binding probabilities for each amino acid in the protein sequence.  </p>
        <p>The pyRBDome package is available for download via <a href="https://git.ecdf.ed.ac.uk/sgrannem/pyRBDome_Notebooks">git.ecdf.ed.ac.uk/sgrannem/pyRBDome_Notebooks</a></p>
            <!-- Add image for aesthetics -->
            <div class='row'>
            <div class='column column 50'>
                <img src="Images/flowchart.png" alt="flowchart" width="100%" height="100%">
            </div>
            <!-- Explaining how pipeline works -->
            <div class='column column 50'>
                <h4>How it works:</h4>
                <p>A list of UniProt IDs of interest is used as input. The PDB files associated with each UniProt ID are retrieved from the Protein Data Bank (rcbs.org). Information about the protein domains found in the relevant proteins is then retrieved using InterProScan. The protein sequences derived from the PDB files are digested in silico with Lys-C and Trypsin to create a collection of peptides for the proteins of interest that can be theoretically deceted using mass spectrometry. The PDB files for each protein are processed by individual predictor algorithms, and the RNA-binding prediction results are downloaded and stored in a database table. The results are also displayed in the b-factor column of the PDB files to allow protein structure visualisation using pyMOL or Jmol. </p>
                <p>RNA-binding amino acid prediction results from individual predictor algorithms are then fed into the XGBoost model, which determines the RNA-binding probability for each amino acid in each protein of interest. 
            </div>
        </div>
    </div>
    
    <?php include 'footer_pyrbdome.php'; //Include footer ?>
    
</body>
</html>