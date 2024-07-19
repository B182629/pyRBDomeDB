<?php

session_start(); // start session management
require_once 'login_pyrbdome.php'; // retrieves credentials for mysql database connection
include 'menu_pyrbdome.php'; // inlcudes menu bar on top of the page.
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

    <title>Prediction Score Plots</title>

    <style>
        .column-67 embed {
            width: 100%;
            height: 1060px;
        }
    
    </style>

</head>
<body>

        <div class='container'>
            <br>
            <div class="row">
                <h3>RNA-binding Amino Acid Prediction Plots</h3>
            </div>
            <div class="row">
                <p>The PyRBDome pipeline generates PDF files illustrating RNA-binding amino acid prediction scores for the respective UniProt ID. This tool allows you to search for a UniProt ID of interest to retrieve the RNA-binding amino acid prediction probabilities, alongside the identified cross-linked amino acids and protein domains. Prediction plot PDF documents can be downloaded.</p>
                <br>
            </div>  
        </div>
        <div class="container"> 
            <div class='row'>
                <div class='column column-33'>
                    <form action="sequence_pyrbdome.php" method="GET">
                        <label for="uniprot_id">UniProt ID</label>
                        <input type="text" id="uniprot_id" name="uniprot_id" value="<?php echo htmlspecialchars($_GET['uniprot_id'] ?? ''); ?>">
                        <button type="submit">Search</button>
                    </form> 
                    <?php
                    if (isset($_GET["uniprot_id"])) {
                        $uniprot_id = $_GET['uniprot_id'];
                        echo "<h4>Prediction Plot Guide:</h4>";
                        echo "<p>The score bar shows the RNA-binding probability for each amino acid residue. These prediction scores are generated from the XGBoost model using all the prediction results from individual predictor algorithms.</p>";
                        echo "<p>The successive rows may display the probabilities retrieved from individual predictors including aaRNA, PST PRNA, BindUP, FTMap, RNABindRPlus, DisoRDPbind and HydRa. </p>";
                        echo "<p>Cross-linked amino acids may be displayed beneath the individual predictors, and domains identified in the sequence are outlined in ovals.</p>";
                        echo "<p><i>Note that prediction plots for some proteins may not include all individual predictor scores or display the cross-linked amino acids.</i></p>";
                        echo "<p><a href=\"https://www.uniprot.org/uniprotkb/{$uniprot_id}/entry\">More information about {$uniprot_id}</a></p>";
                    }
                    ?>
                </div>

                <div class='column column-67'>
                    <?php
                    if (isset($_GET["uniprot_id"])) {
                        $uniprot_id = $_GET['uniprot_id'];
        
                        try {
                            // Connect to MySQL database
                            $pdo = new PDO("mysql:host={$hostname};dbname={$database}", $username, $password);
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
                            // Prepare and execute the SQL query
                            $stmt = $pdo->prepare("SELECT ID, pdb_id, chains FROM processed_files_log WHERE ID = :uniprot_id");
                            $stmt->execute(['uniprot_id' => $uniprot_id]);
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
                            if ($result) {
                                $pdb_id = $result['pdb_id'];
                                $chains = $result['chains'];
                                $uniprot_id = $result['ID'];
                                $pdf_path = "./pyRBDome_Notebooks/analysed_pdbs/{$uniprot_id}/prediction_results/{$pdb_id}_{$chains}_analysis_results.pdf" ;
                                
                                if (file_exists($pdf_path)) {
                                    echo "<embed src='$pdf_path' type='application/pdf'>";
                                } else {
                                    echo "<p>PDF file not found.</p>";
                                }
                            } else {
                                echo "<p>No prediction plot found for UniProt ID: " . htmlspecialchars($uniprot_id) . "</p>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer_pyrbdome.php'; ?>
</body>

</html>
