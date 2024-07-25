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
            <br>
            <div class='row'>
                <div class='column column-50'>
                    <h4>How it Works:</h4>
                    <p>A list of UniProt IDs of interest is used as input. The PDB files associated with each UniProt ID are retrieved from the Protein Data Bank (rcbs.org). Information about the protein domains found in the relevant proteins is then retrieved using InterProScan. The protein sequences derived from the PDB files are digested in silico with Lys-C and Trypsin to create a collection of peptides for the proteins of interest that can be theoretically deceted using mass spectrometry. The PDB files for each protein are processed by individual predictor algorithms, and the RNA-binding prediction results are downloaded and stored in a database table. The results are also displayed in the b-factor column of the PDB files to allow protein structure visualisation using pyMOL or Jmol. </p>
                    <p>RNA-binding amino acid prediction results from individual predictor algorithms are then fed into the XGBoost model, which determines the RNA-binding probability for each amino acid in each protein of interest. 
                </div>
                <!-- Explaining how pipeline works -->
                <div class='column column-50'>
                    <img src="Images/flowchart.png" alt="flowchart" width="600px" height="400px">
                </div>
            </div>
    </div>
    <div class='container'>
        <br>
        <h4>Predictor Algorithms:</h4>
        <p><b>aaRNA:</b> The aaRNA algorithm identifies RNA-binding residues by incorporating features including hidden Markov model-based evolutionary conservation, surface deformations based on the Laplacian norm formalism, and relative solvent accessibility partitioned into backbone and side chain contributions (<a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4150784/'>Li <i>et al</i>, 2014</a>).</p>
        <p><b>PST-PRNA:</b> The PST-PRNA algorithm combines topographic representation of the protein surface and deep learning approaches. Topographic representation of the protein surface may reveal distinct protein properties, such as hydrophobicity or electrostatic potential, facilitating insight into protein structure and function. Deep learning methods are used to identify patterns in protein surface topographic images to unveil protein RNA-binding propensity on the residue level (<a href='https://pubmed.ncbi.nlm.nih.gov/35150250/'>Li <i>et al</i>, 2022</a>). </p>
        <p><b>BindUP:</b> Utilises the NAbind algorithm to detect nucleic acid-binding proteins based on electrostatic patches on the protein surface. It has demonstrated efficiency in identifying novel nucleic acid-binding residues of non-canonical RNA-binding proteins (<a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4987955/'>Paz<i> et al</i>, 2016</a>). </p>
        <p><b>RNABindRPlus:</b> Combines RNA-binding predictions from two distinct methods using logistics regression to predict RNA-binding residues. It combines predictions from  a support vector machine classifier trained on protein sequence information and predictions from another predictor algorithm, HomPRIP. This algorithm employs a sequence homology-based approach to predict RNA-binding residues (<a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4028231/'>Walia <i>et al</i>, 2014</a>).</p>
        <p><b>FTMap:</b> Detects ligand-binding regions in proteins by globally docking small organic probes onto the protein structure. As small molecule-binding regions sometimes overlap with RNA-binding sites, FTMap may also be used to detect RNA-binding protein (<a href='https://pubmed.ncbi.nlm.nih.gov/19176554/'>Brenke <i>et al</i>, 2009</a>). </p>
        <p><b>DisoRDPbind:</b> Detects nucleic acid and protein-binding residues in intrinsically disordered regions within protein sequences. It detects binding regions based on protein sequence complexity, amino acid physiochemical properties, putative secondary structure and disorder and sequence alignment (<a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC4605291/'>Peng <i>et al</i>, 2015</a>). </p>
        <p><b>HydRa:</b> Identifies protein RNA-binding residues based on intermolecular protein interactions and protein sequence patterns, alongside several deep learning methods. These methods include support vector machine, convolutional neural networks and transformer-based protein language models (<a href='https://www.ncbi.nlm.nih.gov/pmc/articles/PMC11098078/'>Jin<i> et al</i>, 2023</a>). </p>
    </div>
    <div class='container'>
        <h5>References:</h5>
        <p style="font-size: 13px; color: #878787;">Chu, L., Christopoulou, N., McCaughan, H., Winterbourne, S., Cazzola, D., Wang, S., Litvin, U.,  Brunon, S., Harker, P. J., McNae, I., Granneman, S. (2023). pyRBDome: A comprehensive computational platform for enhancing and interpreting RNA-binding proteome data, bioRxiv 2023.12.08.570608; doi: https://doi.org/10.1101/2023.12.08.570608</p>
        <p style="font-size: 13px; color: #878787;">Jin, W., Brannan, K. W., Kapeli, K., Park, S. S., Tan, H. Q., Gosztyla, M. L., Mujumdar, M., Ahdout, J., Henroid, B., Rothamel, K., Xiang, J. S., Wong, L., & Yeo, G. W. (2023). HydRA: Deep-learning models for predicting RNA-binding capacity from protein interaction association context and protein sequence. Molecular cell, 83(14), 2595–2611.e11. https://doi.org/10.1016/j.molcel.2023.06.019</p>
        <p style="font-size: 13px; color: #878787;">Walia, R. R., Xue, L. C., Wilkins, K., El-Manzalawy, Y., Dobbs, D., & Honavar, V. (2014). RNABindRPlus: a predictor that combines machine learning and sequence homology-based methods to improve the reliability of predicted RNA-binding residues in proteins. PloS one, 9(5), e97725. https://doi.org/10.1371/journal.pone.0097725</p>
        <p style="font-size: 13px; color: #878787;">Brenke, R., Kozakov, D., Chuang, G. Y., Beglov, D., Hall, D., Landon, M. R., Mattos, C., & Vajda, S. (2009). Fragment-based identification of druggable 'hot spots' of proteins using Fourier domain correlation techniques. Bioinformatics (Oxford, England), 25(5), 621–627. https://doi.org/10.1093/bioinformatics/btp036</p>
        <p style="font-size: 13px; color: #878787;">Paz, I., Kligun, E., Bengad, B., & Mandel-Gutfreund, Y. (2016). BindUP: a web server for non-homology-based prediction of DNA and RNA binding proteins. Nucleic acids research, 44(W1), W568–W574. https://doi.org/10.1093/nar/gkw454</p>
        <p style="font-size: 13px; color: #878787;">Li, S., Yamashita, K., Amada, K. M., & Standley, D. M. (2014). Quantifying sequence and structural features of protein-RNA interactions. Nucleic acids research, 42(15), 10086–10098. https://doi.org/10.1093/nar/gku681</p>
        <p style="font-size: 13px; color: #878787;">Li, P., & Liu, Z. P. (2022). PST-PRNA: prediction of RNA-binding sites using protein surface topography and deep learning. Bioinformatics (Oxford, England), 38(8), 2162–2168. https://doi.org/10.1093/bioinformatics/btac078</p>
        <p style="font-size: 13px; color: #878787;">Peng, Z., & Kurgan, L. (2015). High-throughput prediction of RNA, DNA and protein binding regions mediated by intrinsic disorder. Nucleic acids research, 43(18), e121. https://doi.org/10.1093/nar/gkv585</p>
    </div>

    <!-- include footer bar at bottom of the page -->
    <?php include 'footer_pyrbdome.php';?>
    
</body>
</html>