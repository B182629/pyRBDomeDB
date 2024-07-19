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

    <title>Search UniProt ID</title>

    <style>

        .search-column {
            flex: 1;
            margin-right: 20px;
        }

        .filters-column {
            flex: 2;
            display: flex;
            flex-direction: column;
        }

        .filter-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .filter-row input {
            flex: 1;
            margin-left: 20px;
        }

        .filter-row label {
            flex: 0.5;
            font-size: 15px;
        }
        .column-stats {
            margin-left: 50px;
            margin-top: 5px;
        }
    </style>


</head>
<body>
    <!-- build layout of website using bootstrap CSS -->

    <div class='container'>
        <br>
        <div class="row">
            <h3>Filter pyRBDome RNA-binding Data</h3>
        </div>
        <div class="row">
            <p>Browse pyRBDome results data by searching for a UniProt ID and/or filtering by specific criteria. The XGBoost probability scores are derived from combining prediction results from various individual predictor algorithms. These algorithms include aaRNA, PST PRNA, BindUP, FTMap, RNABindRPlus, DisoRDPbind and HydRa. This tool can be used in various ways e.g. to retrieve all prediction results for a specific UniProt ID of interest, or to filter amino acids from all available UniProt IDs by specific prediction scores. Filtered results can be downloaded as a TSV file.</p>
        </div>  
    </div>
    <div class="container"> 
        <div class='row'> 
            <div class="column column-33">
                <form action="filter_pyrbdome.php" method="GET">

                    <input type="hidden" id="prediction_min_hidden" name="prediction_min" value="<?php echo htmlspecialchars($_GET['prediction_min'] ?? ''); ?>">
                    <input type="hidden" id="prediction_max_hidden" name="prediction_max" value="<?php echo htmlspecialchars($_GET['prediction_max'] ?? ''); ?>">

                    <input type="hidden" id="aarna_min_hidden" name="aarna_min" value="<?php echo htmlspecialchars($_GET['aarna_min'] ?? ''); ?>">
                    <input type="hidden" id="aarna_max_hidden" name="aarna_max" value="<?php echo htmlspecialchars($_GET['aarna_max'] ?? ''); ?>">

                    <input type="hidden" id="pst_prna_min_hidden" name="pst_prna_min" value="<?php echo htmlspecialchars($_GET['pst_prna_min'] ?? ''); ?>">
                    <input type="hidden" id="pst_prna_max_hidden" name="pst_prna_max" value="<?php echo htmlspecialchars($_GET['pst_prna_max'] ?? ''); ?>">

                    <input type="hidden" id="bindup_min_hidden" name="bindup_min" value="<?php echo htmlspecialchars($_GET['bindup_min'] ?? ''); ?>">
                    <input type="hidden" id="bindup_max_hidden" name="bindup_max" value="<?php echo htmlspecialchars($_GET['bindup_max'] ?? ''); ?>">

                    <input type="hidden" id="ftmap_min_hidden" name="ftmap_min" value="<?php echo htmlspecialchars($_GET['ftmap_min'] ?? ''); ?>">
                    <input type="hidden" id="ftmap_max_hidden" name="ftmap_max" value="<?php echo htmlspecialchars($_GET['ftmap_max'] ?? ''); ?>">

                    <input type="hidden" id="rnabindrplus_min_hidden" name="rnabindrplus_min" value="<?php echo htmlspecialchars($_GET['rnabindrplus_min'] ?? ''); ?>">
                    <input type="hidden" id="rnabindrplus_max_hidden" name="rnabindrplus_max" value="<?php echo htmlspecialchars($_GET['rnabindrplus_max'] ?? ''); ?>">
                    
                    <input type="hidden" id="disordpbind_min_hidden" name="disordpbind_min" value="<?php echo htmlspecialchars($_GET['disordpbind_min'] ?? ''); ?>">
                    <input type="hidden" id="disordpbind_max_hidden" name="disordpbind_max" value="<?php echo htmlspecialchars($_GET['disordpbind_max'] ?? ''); ?>">
                    
                    <input type="hidden" id="hydra_min_hidden" name="hydra_min" value="<?php echo htmlspecialchars($_GET['hydra_min'] ?? ''); ?>">
                    <input type="hidden" id="hydra_max_hidden" name="hydra_max" value="<?php echo htmlspecialchars($_GET['hydra_max'] ?? ''); ?>">
                    
                    <label for="uniprot_search">Search UniProt:</label>
                    <input type="text" id="uniprot_search" name="uniprot_search" placeholder="Enter UniProt ID" value="<?php echo htmlspecialchars($_GET['uniprot_search'] ?? ''); ?>">
                    <button type="submit">Search</button>
                </form>
                <form action="filter_pyrbdome.php" method="GET">
                    <input type="hidden" id="uniprot_search_hidden" name="uniprot_search" value="<?php echo htmlspecialchars($_GET['uniprot_search'] ?? ''); ?>">
                    <div class="filter-row">
                        <label for="prediction_min">XGBoost:<font color='#FFFFFF'>XXXX</font></label>
                        <input type="text" id="prediction_min" name="prediction_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['prediction_min'] ?? ''); ?>">
                        <input type="text" id="prediction_max" name="prediction_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['prediction_max'] ?? ''); ?>">
                    </div>
                    <div class="filter-row">
                        <label for="aarna_min">aaRNA:<font color='#FFFFFF'>XXXXX</font></label>
                        <input type="text" id="aarna_min" name="aarna_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['aarna_min'] ?? ''); ?>">
                        <input type="text" id="aarna_max" name="aarna_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['aarna_max'] ?? ''); ?>">
                    </div>

                    <div class="filter-row">
                        <label for="pst_prna_min">PST<font color='#FFFFFF'>.</font>PRNA:<font color='#FFFFFF'>XX</font></label>
                        <input type="text" id="pst_prna_min" name="pst_prna_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['pst_prna_min'] ?? ''); ?>">
                        <input type="text" id="pst_prna_max" name="pst_prna_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['pst_prna_max'] ?? ''); ?>">
                    </div>

                    <!-- Add more filter rows as needed -->
                    <div class="filter-row">
                        <label for="bindup_min">BindUP:<font color='#FFFFFF'>XXXXX</font></label>
                        <input type="text" id="bindup_min" name="bindup_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['bindup_min'] ?? ''); ?>">
                        <input type="text" id="bindup_max" name="bindup_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['bindup_max'] ?? ''); ?>">
                    </div>

                    <div class="filter-row">
                        <label for="ftmap_min">FTMap:<font color='#FFFFFF'>XXXXX.</font></label>
                        <input type="text" id="ftmap_min" name="ftmap_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['ftmap_min'] ?? ''); ?>">
                        <input type="text" id="ftmap_max" name="ftmap_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['ftmap_max'] ?? ''); ?>">
                    </div>

                    <div class="filter-row">
                        <label for="rnabindrplus_min">RNABindRPlus:</label>
                        <input type="text" id="rnabindrplus_min" name="rnabindrplus_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['rnabindrplus_min'] ?? ''); ?>">
                        <input type="text" id="rnabindrplus_max" name="rnabindrplus_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['rnabindrplus_max'] ?? ''); ?>">
                    </div>

                    <div class="filter-row">
                        <label for="disordpbind_min">DisoRDPbind:<font color='#FFFFFF'>X</font></label>
                        <input type="text" id="disordpbind_min" name="disordpbind_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['disordpbind_min'] ?? ''); ?>">
                        <input type="text" id="disordpbind_max" name="disordpbind_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['disordpbind_max'] ?? ''); ?>">
                    </div>

                    <div class="filter-row">
                        <label for="hydra_min">HydRa:<font color='#FFFFFF'>XXXXX.</font></label>
                        <input type="text" id="hydra_min" name="hydra_min" placeholder="Min" value="<?php echo htmlspecialchars($_GET['hydra_min'] ?? ''); ?>">
                        <input type="text" id="hydra_max" name="hydra_max" placeholder="Max" value="<?php echo htmlspecialchars($_GET['hydra_max'] ?? ''); ?>">
                    </div>

                    <button type="submit">Filter Results</button>
                </form>
            </div>
            <div class='column-stats'>
                <h5><b>Database Statistics</b></h5>
                <?php
                    try {
                        // connect to mysql database using credentials stored in login.php
                        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // construct mysql query based on filter values and prepare query to avoid SQL injection
                        $stmt = $pdo->prepare("SELECT * FROM processed_files_log");
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        $no_uniprot_id = $stmt->rowCount();

                        if ($result) {
                            echo "<p>No. available UniProt IDs: <b>" . $no_uniprot_id . "</b></p>";
                        } else {
                        echo "<p>No UniProt IDs found.</p>";
                        }

                        $stmt2 = $pdo->prepare("SELECT COUNT(DISTINCT ID) AS unique_id_count FROM All_combined_results WHERE predictions >= 0.9");
                        $stmt2->execute();
                        
                        // Fetch the result
                        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                        $no_uniprot_id_0_9 = $result2['unique_id_count'];
                        
                        if ($result2) {
                            echo "<p>No. UniProt IDs with RNA-binding amino acid probabilities > 0.9: <b>" . $no_uniprot_id_0_9 . "</b></p>";
                        } else {
                        echo "<p>No UniProt IDs found with RNA-binding probabilities > 0.9.</p>";
                        }

                        $stmt3 = $pdo->prepare("SELECT COUNT(DISTINCT ID) AS unique_id_count FROM All_combined_results WHERE predictions >= 0.95");
                        $stmt3->execute();
                        
                        // Fetch the result
                        $result3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                        $no_uniprot_id_0_95 = $result3['unique_id_count'];

                        if ($result3) {
                            echo "<p>No. UniProt IDs with RNA-binding amino acid probabilities > 0.95: <b>" . $no_uniprot_id_0_95 . "</b></p>";
                        } else {
                        echo "<p>No UniProt IDs found with RNA-binding probabilities > 0.9.</p>";
                        }

                        $stmt4 = $pdo->prepare("SELECT COUNT(DISTINCT ID) AS unique_id_count FROM All_combined_results WHERE predictions >= 0.98");
                        $stmt4->execute();
                        
                        // Fetch the result
                        $result4 = $stmt4->fetch(PDO::FETCH_ASSOC);
                        $no_uniprot_id_0_98 = $result4['unique_id_count'];

                        if ($result4) {
                            echo "<p>No. UniProt IDs with RNA-binding amino acid probabilities > 0.98:<b> " . $no_uniprot_id_0_98 . "</b></p>";
                        } else {
                        echo "<p>No UniProt IDs found with RNA-binding probabilities > 0.98.</p>";
                        }

                        $stmt5 = $pdo->prepare("SELECT COUNT(DISTINCT ID) AS unique_id_count FROM All_combined_results WHERE predictions >= 0.99");
                        $stmt5->execute();
                        
                        // Fetch the result
                        $result5 = $stmt5->fetch(PDO::FETCH_ASSOC);
                        $no_uniprot_id_0_99 = $result5['unique_id_count'];

                        if ($result5) {
                            echo "<p>No. UniProt IDs with RNA-binding amino acid probabilities > 0.99: <b>" . $no_uniprot_id_0_99 . "</b></p>";
                        } else {
                        echo "<p>No UniProt IDs found with RNA-binding probabilities > 0.99.</p>";
                        }
                        
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                ?>
            </div>
        </div>
    </div>

    <div class="container">

        <?php 
        // check if search form is submitted using POST method
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
            try {
                // connect to mysql database using credentials stored in login.php
                $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                // construct mysql query based on filter values and prepare query to avoid SQL injection
                $query = "SELECT * FROM All_combined_results WHERE 1=1";
                $params = [];

                if (!empty($_GET['uniprot_search'])) {
                    $query .= " AND ID = :uniprot_search";
                    $params[':uniprot_search'] = $_GET['uniprot_search'];
                }
                if (!empty($_GET['prediction_min'])) {
                    $query .= " AND predictions >= :prediction_min";
                    $params[':prediction_min'] = $_GET['prediction_min'];
                }
                if (!empty($_GET['prediction_max'])) {
                    $query .= " AND predictions <= :prediction_max";
                    $params[':prediction_max'] = $_GET['prediction_max'];
                }
                if (!empty($_GET['aarna_min'])) {
                    $query .= " AND aaRNA >= :aarna_min";
                    $params[':aarna_min'] = $_GET['aarna_min'];
                }
                if (!empty($_GET['aarna_max'])) {
                    $query .= " AND aaRNA <= :aarna_max";
                    $params[':aarna_max'] = $_GET['aarna_max'];
                }
                if (!empty($_GET['pst_prna_min'])) {
                    $query .= " AND PST_PRNA >= :pst_prna_min";
                    $params[':pst_prna_min'] = $_GET['pst_prna_min'];
                }
                if (!empty($_GET['pst_prna_max'])) {
                    $query .= " AND PST_PRNA <= :pst_prna_max";
                    $params[':pst_prna_max'] = $_GET['pst_prna_max'];
                }
                if (!empty($_GET['bindup_min'])) {
                    $query .= " AND BindUP >= :bindup_min";
                    $params[':bindup_min'] = $_GET['bindup_min'];
                }
                if (!empty($_GET['bindup_max'])) {
                    $query .= " AND BindUP <= :bindup_max";
                    $params[':bindup_max'] = $_GET['bindup_max'];
                }
                if (!empty($_GET['ftmap_min'])) {
                    $query .= " AND FTMap_distances >= :ftmap_min";
                    $params[':ftmap_min'] = $_GET['ftmap_min'];
                }
                if (!empty($_GET['ftmap_max'])) {
                    $query .= " AND FTMap_distances <= :ftmap_max";
                    $params[':ftmap_max'] = $_GET['ftmap_max'];
                }
                if (!empty($_GET['rnabindrplus_min'])) {
                    $query .= " AND RNABindRPlus >= :rnabindrplus_min";
                    $params[':rnabindrplus_min'] = $_GET['rnabindrplus_min'];
                }
                if (!empty($_GET['rnabindrplus_max'])) {
                    $query .= " AND RNABindRPlus <= :rnabindrplus_max";
                    $params[':rnabindrplus_max'] = $_GET['rnabindrplus_max'];
                }
                if (!empty($_GET['disordpbind_min'])) {
                    $query .= " AND DisoRDPbind >= :disordpbind_min";
                    $params[':disordpbind_min'] = $_GET['disordpbind_min'];
                }
                if (!empty($_GET['disordpbind_max'])) {
                    $query .= " AND DisoRDPbind <= :disordpbind_max";
                    $params[':disordpbind_max'] = $_GET['disordpbind_max'];
                }
                if (!empty($_GET['hydra_min'])) {
                    $query .= " AND HydRa >= :hydra_min";
                    $params[':hydra_min'] = $_GET['hydra_min'];
                }
                if (!empty($_GET['hydra_max'])) {
                    $query .= " AND HydRa <= :hydra_max";
                    $params[':hydra_max'] = $_GET['hydra_max'];
                }

                // Prepare the statement
                $stmt = $pdo->prepare($query);
                $stmt->execute($params);

                // Fetch and display results
                $displayedCount = 0;

                echo "<button style='margin-left: 900px;' onclick='downloadTableAsTSV()'>Download as TSV</button>
                <table id='results_table'>
                    <thead>
                        <tr>
                            <th>UniProt ID</th>
                            <th>Residue</th>
                            <th>Amino Acid</th>
                            <th>XGBoost</th>
                            <th>aaRNA</th>
                            <th>PST PRNA</th>
                            <th>BindUP</th>
                            <th>FTMap Distance</th>
                            <th>RNABindRPlus</th>
                            <th>DisoRDPbind</th>
                            <th>HydRa</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($displayedCount >= 1000) break;
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ID'] ?? 'N/A') . "</td>";
                            echo "<td>" . htmlspecialchars($row['residue_number'] ?? 'N/A') . "</td>";
                            echo "<td>" . htmlspecialchars($row['amino_acid'] ?? 'N/A') . "</td>";
                            echo "<td>" . (isset($row['predictions']) ? round($row['predictions'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['aaRNA']) ? round($row['aaRNA'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['PST_PRNA']) ? round($row['PST_PRNA'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['BindUP']) ? round($row['BindUP'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['FTMap_distances']) ? round($row['FTMap_distances'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['RNABindRPlus']) ? round($row['RNABindRPlus'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['DisoRDPbind']) ? round($row['DisoRDPbind'], 5) : 'N/A') . "</td>";
                            echo "<td>" . (isset($row['HydRa']) ? round($row['HydRa'], 5) : 'N/A') . "</td>";
                            echo "</tr>";

                    $displayedCount++;
                }
                echo "</tbody>
                </table>";

                if ($stmt->rowCount() > 1000) {
                    echo "<tr><td colspan='11'> More than 1000 results found. Only the first 1000 results are displayed.</td></tr>";
                }

                if ($displayedCount == 0) {
                    echo "<tr><td colspan='11'>No results found.</td></tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>
    </div>

    <?php include 'footer_pyrbdome.php'; ?>

    <script>
    function downloadTableAsTSV() {
            const table = document.getElementById("results_table");
            let tsvContent = "";

            // Loop through each row of the table
            for (let row of table.rows) {
                let rowData = [];
                // Loop through each cell in the row
                for (let cell of row.cells) {
                    rowData.push(cell.textContent);
                }
                // Join row data with tab separator and add a newline at the end
                tsvContent += rowData.join("\t") + "\n";
            }

            // Create a Blob with the TSV content
            const blob = new Blob([tsvContent], { type: "text/tab-separated-values;charset=utf-8;" });

            // Create a link element to initiate download
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "table_data.tsv";

            // Append the link to the body
            document.body.appendChild(link);
            // Programmatically click the link to trigger the download
            link.click();
            // Remove the link from the document
            document.body.removeChild(link);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>