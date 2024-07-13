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

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script type="text/javascript" src="./jsmol/JSmol.min.js"></script>

    <title>JSmol</title>

    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 5px;
            margin-bottom: 5px;
        }
        .jmol-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        #JmolDiv {
            width: 750px;
            height: 500px;
        }
        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 20px;
        }
        .buttons input {
            margin-bottom: 5px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <form method="GET" action="jsmol_pyrbdome.php">
                <label for="uniprot_id"><h3>Enter UniProt ID:</h3></label>
                <input type="text" id="uniprot_id" name="uniprot_id" required>
                <input type="submit" value="Search">
            </form>
        </div>  

        <div class="row">
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
                        $pdb_dir = "./pyRBDome_Notebooks/analysed_pdbs/{$uniprot_id}/prediction_results/" ;
                        
                        $loadScript = "";
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_aaRNA.pdb';"; 
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_PST_PRNA.pdb';";
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_BindUP.pdb';"; 
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_FTMap_distances.pdb';"; 
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_DisoRDPbind.pdb';"; 
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_HydRa.pdb';"; 
                        $loadScript .= "load '{$pdb_dir}{$pdb_id}_{$chains}_model_predictions.pdb';"; 

                        // Display the PDB structure using JSmol
                        echo "<div class='jmol-container'>
                                <div id='JmolDiv'></div>
                                <div class='buttons'>
                                    <input type=\"button\" value=\"Spacefill\" style=\"width:120px\" onClick=\"javascript:Jmol.script(jmolApplet0,'select *;cartoons off;spacefill only')\"><br />
                                    <input type=\"button\" value=\"Wire-frame\" style=\"width:120px\" onClick=\"javascript:Jmol.script(jmolApplet0,'select *;cartoons off;wireframe -0.1')\"><br />
                                    <input type=\"button\" value=\"Ball & Stick\" style=\"width:120px\" onClick=\"javascript:Jmol.script(jmolApplet0,'select *;cartoons off;spacefill 23%;wireframe 0.15')\"><br />
                                    <input type=\"button\" value=\"Label Atoms\" style=\"width:120px\" onClick=\"javascript:Jmol.script(jmolApplet0,'select *;label %e;')\"><br />
                                    <input type=\"button\" value=\"Atom Labels Off\" style=\"width:120px\" onClick=\"javascript:Jmol.script(jmolApplet0,'select *;labels off')\"><br />

                                </div>
                            </div>";

                        echo "<script type=\"text/javascript\">
                            $(document).ready(function(){
                                var loadScript = `" . $loadScript . "`;
                                var JmolInfo = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#E2F4F5',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScript);
                                    }
                                };
                                $('#JmolDiv').html(Jmol.getAppletHtml('jmolApplet0', JmolInfo));
                            });
                        </script>";
                    } else {
                        echo "<p>No PDB IDs found for the given UniProt ID.</p>";
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
