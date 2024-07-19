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

        .jmol-container {
            display: flex;
            justify-content: left;
            align-items: left;
        }
        #JmolDivPredictions {
            width: 750px;
            height: 650px;
        }
        #JmolDivaaRNA {
            width: 750px;
            height: 650px;
        }
        #JmolDivPST_PRNA {
            width: 750px;
            height: 650px;
        }
        #JmolDivBindUP {
            width: 750px;
            height: 650px;
        }
        #JmolDivHydRa {
            width: 750px;
            height: 650px;
        }
        #JmolDivDisoRDPbind {
            width: 750px;
            height: 650px;
        }
        .buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 20px;
        }
        .button-outline {
            flex-direction: column;
            justify-content: center;
            margin-left: 11px;
            display: flex;
        }
        .buttons input {
            margin-bottom: 5px;
        }
        .hidden {
            display: none;
        }
        #JmolPredictions {
            padding: 10px;
            margin-top: 10px;
        }
        #JmolaaRNA {
            padding: 10px;
            margin-top: 10px;
        }
        #JmolPST_PRNA {
            padding: 10px;
            margin-top: 10px;
        }
        #JmolBindUP {
            padding: 10px;
            margin-top: 10px;
        }
        #JmolDisoRDPbind {
            padding: 10px;
            margin-top: 10px;
        }
        #JmolHydRa {
            padding: 10px;
            margin-top: 10px;
        }

    </style>
</head>

<body>
    <div class='container'>
        <br>
        <div class="row">
            <h3>RNA-Binding Predictions: 3D Structures from Individual Predictor Algorithms</h3>
        </div>
        <div class="row">
            <p>Individual predictor algorithms utilised in the pyRBDome pipeline produce RNA-binding predictions which are fed into an XGBoost model to calculate RNA-bidning probabilities for each amino acid. These predictors include aaRNA, PST PRNA, BindUP, DisoRDPbind, FTMap, HydRa. The RNA-binding prediction structures for these predictors can be viewed below.</p>
        </div>
    </div>
    <div class='container'>
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
                        $domain_dir = "./pyRBDome_Notebooks/analysed_pdbs/{$uniprot_id}/filtered_pdb_files/";
                        
                        $loadScriptaaRNA = "load '{$pdb_dir}{$pdb_id}_{$chains}_aaRNA.pdb'; ";
                        $loadScriptPST_PRNA = "load '{$pdb_dir}{$pdb_id}_{$chains}_PST_PRNA.pdb'; ";
                        $loadScriptBindUP = "load '{$pdb_dir}{$pdb_id}_{$chains}_BindUP.pdb'; ";
                        $loadScriptFTMap = "load '{$pdb_dir}{$pdb_id}_{$chains}_FTMap_distances.pdb'; ";
                        $loadScriptDisoRDPbind = "load '{$pdb_dir}{$pdb_id}_{$chains}_DisoRDPbind.pdb'; ";
                        $loadScriptHydRa = "load '{$pdb_dir}{$pdb_id}_{$chains}_HydRa.pdb'; ";

                        echo "<p><a href=\"jsmol_pyrbdome.php?uniprot_id=" . $uniprot_id . "\">Back to UniProt Search</a></p>
                            </div>
                            <div class='column column-50'>
                                <div class='row'>
                                    <button class='jmol-button button-outline' data-target='JmolaaRNA'>aaRNA</button>
                                    <button class='jmol-button button-outline' data-target='JmolPST_PRNA'>PST PRNA</button>
                                    <button class='jmol-button button-outline' data-target='JmolBindUP'>BindUP</button>
                                    <button class='jmol-button button-outline' data-target='JmolDisoRDPbind'>DisoRDPbind</button>
                                    <button class='jmol-button button-outline' data-target='JmolHydRa'>HydRa</button>
                                </div>
                            </div>
                        </div>

                        <div class='container jmol-container' id='JmolaaRNA'>
                            <div class='row'>
                                <div id='JmolDivaaRNA' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>aaRNA</h4>
                                    <p>Brief description here</p>
                                </div>
                            </div>
                        </div>
                        <div class='container jmol-container' id='JmolPST_PRNA'>
                            <div class='row'>
                                <div id='JmolDivPST_PRNA' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>PST PRNA</h4>
                                    <p>Brief description here</p>
                                </div>
                            </div>
                        </div>
                        <div class='container jmol-container' id='JmolBindUP'>
                            <div class='row'>
                                <div id='JmolDivBindUP' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>BindUP</h4>
                                    <p>Brief description here</p>
                                </div>
                            </div>
                        </div>
                        <div class='container jmol-container' id='JmolDisoRDPbind'>
                            <div class='row'>
                                <div id='JmolDivDisoRDPbind' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>DisoRDPbind</h4>
                                    <p>Brief description here</p>
                                </div>
                            </div>
                        </div>
                        <div class='container jmol-container' id='JmolHydRa'>
                            <div class='row'>
                                <div id='JmolDivHydRa' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>HydRa</h4>
                                    <p>Brief description here</p>
                                </div>
                            </div>
                        </div>";

                        echo "<script type=\"text/javascript\">
                            $(document).ready(function(){
                                loadScriptaaRNA = `" . $loadScriptaaRNA . "`;
                                var JmolInfoaaRNA = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#f8f8f8',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScriptaaRNA + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDivaaRNA').html(Jmol.getAppletHtml('jmolAppletaaRNA', JmolInfoaaRNA));

                                loadScriptPST_PRNA = `" . $loadScriptPST_PRNA . "`;
                                var JmolInfoPST_PRNA = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#f8f8f8',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScriptPST_PRNA + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDivPST_PRNA').html(Jmol.getAppletHtml('jmolAppletPST_PRNA', JmolInfoPST_PRNA));

                                loadScriptBindUP = `" . $loadScriptBindUP . "`;
                                var JmolInfoBindUP = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#f8f8f8',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScriptBindUP + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDivBindUP').html(Jmol.getAppletHtml('jmolAppletBindUP', JmolInfoBindUP));

                                loadScriptDisoRDPbind = `" . $loadScriptDisoRDPbind . "`;
                                var JmolInfoDisoRDPbind = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#f8f8f8',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScriptDisoRDPbind + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDivDisoRDPbind').html(Jmol.getAppletHtml('jmolAppletDisoRDPbind', JmolInfoDisoRDPbind));

                                loadScriptHydRa = `" . $loadScriptHydRa . "`;
                                var JmolInfoHydRa = {
                                    width: '100%',
                                    height: '100%',
                                    color: '#f8f8f8',
                                    debug: false,
                                    disableJ2SLoadMonitor: true,
                                    disableInitialConsole: true,
                                    addSelectionOptions: false,
                                    j2sPath: 'jsmol/j2s',
                                    serverURL: 'jsmol/php/jsmol.php',
                                    use: 'html5',
                                    readyFunction: function(applet) {
                                        console.log('Jmol is ready');
                                        Jmol.script(applet, loadScriptHydRa + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDivHydRa').html(Jmol.getAppletHtml('jmolAppletHydRa', JmolInfoHydRa));
                            });
                        </script>";

                    } else {
                        echo "<p>No PDB files found for the given UniProt ID.</p>";
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>

    <?php include 'footer_pyrbdome.php'; ?>

</body>
<script>

function toggleSpacefillaaRNA() {
        const spacefill100aaRNA = document.getElementById('spacefill100aaRNA').checked;
        const spacefill50aaRNA = document.getElementById('spacefill50aaRNA').checked;
        const spacefill25aaRNA = document.getElementById('spacefill25aaRNA').checked;
        
        if (spacefill100aaRNA) {
            Jmol.script(jmolAppletaaRNA, 'select *; spacefill');

        } else if (spacefill50aaRNA) {
            Jmol.script(jmolAppletaaRNA, 'select *; spacefill 50%');

        } else if (spacefill25aaRNA) {
            Jmol.script(jmolAppletaaRNA, 'select *; spacefill 25%');
        }
    }

    function toggleSpacefillPST_PRNA() {
        const spacefill100PST_PRNA = document.getElementById('spacefill100PST_PRNA').checked;
        const spacefill50PST_PRNA = document.getElementById('spacefill50PST_PRNA').checked;
        const spacefill25PST_PRNA = document.getElementById('spacefill25PST_PRNA').checked;
        
        if (spacefill100PST_PRNA) {
            Jmol.script(jmolApplePST_PRNA, 'select *; spacefill');

        } else if (spacefill50PST_PRNA) {
            Jmol.script(jmolAppletPST_PRNA, 'select *; spacefill 50%');

        } else if (spacefill25PST_PRNA) {
            Jmol.script(jmolAppletPST_PRNA, 'select *; spacefill 25%');
        }
    }

    function toggleSpacefillBindUP() {
        const spacefill100BindUP = document.getElementById('spacefill100BindUP').checked;
        const spacefill50BindUP = document.getElementById('spacefill50BindUP').checked;
        const spacefill25BindUP = document.getElementById('spacefill25BindUP').checked;
        
        if (spacefill100BindUp) {
            Jmol.script(jmolAppletBindUP, 'select *; spacefill');

        } else if (spacefill50BindUP) {
            Jmol.script(jmolAppletBindUP, 'select *; spacefill 50%');

        } else if (spacefill25BindUP) {
            Jmol.script(jmolAppletBindUP, 'select *; spacefill 25%');
        }
    }

    function toggleSpacefillDisoRDPbind() {
        const spacefill100DisoRDPbind = document.getElementById('spacefill100DisoRDPbind').checked;
        const spacefill50DisoRDPbind = document.getElementById('spacefill50DisoRDPbind').checked;
        const spacefill25DisoRDPbind = document.getElementById('spacefill25DisoRDPbind').checked;
        
        if (spacefill100DisoRDPbind) {
            Jmol.script(jmolAppletDisoRDPbind, 'select *; spacefill');

        } else if (spacefill50DisoRDPbind) {
            Jmol.script(jmolAppletDisoRDPbind, 'select *; spacefill 50%');

        } else if (spacefill25DisoRDPbind) {
            Jmol.script(jmolAppletDisoRDPbind, 'select *; spacefill 25%');
        }
    }

    function toggleSpacefillHydRa() {
        const spacefill100HydRa = document.getElementById('spacefill100HydRa').checked;
        const spacefill50HydRa = document.getElementById('spacefill50HydRa').checked;
        const spacefill25HydRa = document.getElementById('spacefill25HydRa').checked;
        
        if (spacefill100HydRa) {
            Jmol.script(jmolAppletHydRa, 'select *; spacefill');

        } else if (spacefill50HydRa) {
            Jmol.script(jmolAppletHydRa, 'select *; spacefill 50%');

        } else if (spacefill25HydRa) {
            Jmol.script(jmolAppletHydRa, 'select *; spacefill 25%');
        }
    }

document.addEventListener('DOMContentLoaded', function() {
        // Get all buttons and containers
        var buttons = document.querySelectorAll('.jmol-button');
        var containers = document.querySelectorAll('.jmol-container');

        // Function to handle button click
        function handleButtonClick(event) {
            var targetId = event.target.getAttribute('data-target');

            // Hide all containers
            containers.forEach(function(container) {
                container.style.display = 'none';
            });

            // Show the targeted container
            var targetContainer = document.getElementById(targetId);
            if (targetContainer) {
                targetContainer.style.display = 'block';
            }
        }

        // Attach click event listeners to buttons
        buttons.forEach(function(button) {
            button.addEventListener('click', handleButtonClick);
        });

        // Show the Protein Backbone container by default
        var defaultContainer = document.getElementById('JmolaaRNA');
        if (defaultContainer) {
            defaultContainer.style.display = 'block';
        }

        // Hide other containers initially
        containers.forEach(function(container) {
            if (container.id !== 'JmolaaRNA') {
                container.style.display = 'none';
            }
        });
    });

</script>
</html>
