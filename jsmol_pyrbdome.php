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
        #JmolDiv0 {
            width: 750px;
            height: 650px;
        }
        #JmolDiv1 {
            width: 750px;
            height: 650px;
        }
        #JmolDiv2 {
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
            margin-left: 20px;
            display: flex;
        }
        .buttons input {
            margin-bottom: 5px;
        }
        .hidden {
            display: none;
        }
        #Jmol0 {
            padding: 10px;
            margin-top: 10px;
        }
        #Jmol1 {
            padding: 10px;
            margin-top: 10px;
        }
        #Jmol2 {
            padding: 10px;
            margin-top: 10px;

        }

    </style>
</head>

<body>
    <div class='container'>
        <br>
        <div class="row">
            <h3>pyRBDome Results Visualisation with Jmol</h3>
        </div>
        <div class="row">
            <p>The PyRBDome pipeline generates PDB files for each individual predictor, allowing for interactive visualisation of proteins.</p>
            <br>
        </div>  
    </div>
    <div class="container">
        <div class="row">
            <form method="GET" action="jsmol_pyrbdome.php">
                <label for="uniprot_id">UniProt ID</label>
                <input type="text" id="uniprot_id" name="uniprot_id" required>
                <input type="submit" value="Search">
            </form>
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
                        $loadScriptPredictions = "load '{$pdb_dir}{$pdb_id}_{$chains}_model_predictions.pdb'; ";


                        // Display the PDB structure using JSmol
                        echo "<button class='jmol-button button-outline' data-target='Jmol2'>RNA-bidning Predictions</button>
                            <button class='jmol-button button-outline' data-target='Jmol0'>Protein Backbone</button>
                            <button class='jmol-button button-outline' data-target='Jmol1'>Strands</button>
                            <br>
                            </div>
                        </div>
                        <div class='container jmol-container' id='Jmol2'>
                            <div class='row'>
                                <div id='JmolDiv2' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>Misc</h4>
                                </div>
                            </div>
                        <br>
                        </div>
                        <div class='container jmol-container' id='Jmol0'>
                            <div class='row'>
                                <div id='JmolDiv0' class='column column-60'></div>
                                <div class='column column-40'>
                                    <h4>Protein Backbone</h4>
                                    <div class='row'>
                                        <div class='checkboxes'>
                                            <input type='checkbox' id='wireframe' name='wireframe' style='width:40px' onChange='toggleWireframe()' checked>Wire Frame<br />
                                        </div>
                                        <div class='checkboxes'>
                                            <input type='checkbox' id='showAminoAcids' name='showAminoAcids' style='width:40px' onChange='toggleShowAminoAcids()'>Amino Acids<br />
                                        </div>
                                        <div class='checkboxes'>
                                            <input type='checkbox' id='showAtoms' name='showAtoms' style='width:40px' onChange='toggleShowAtoms()' checked>Atoms<br />
                                        </div>
                                    </div>
                                    <br><h6>Backbone</h6>
                                    <div class='row'>
                                        <div class='radio-buttons'>
                                            <p>Weight</p>
                                            <input type='radio' id='backbone0_6' name='backbone' value='0.6' style='width:50px' onChange='toggleBackbone()'>0.6<br />
                                            <input type='radio' id='backbone0_3' name='backbone' value='0.3' style='width:50px' onChange='toggleBackbone()'>0.3<br />
                                            <input type='radio' id='backboneOff' name='backbone' value='off' style='width:50px' onChange='toggleBackbone()' checked>Off<br />
                                        </div>
                                        <div class='radio-buttons'>
                                            <p>Colour</p>
                                            <input type='radio' id='backboneStructure' name='backboneColour' value='structure' style='width:50px' onChange='toggleBackboneColour()'>Structure<br />
                                            <input type='radio' id='backboneGreen' name='backboneColour' value='green' style='width:50px' onChange='toggleBackboneColour()'>Green<br />
                                            <input type='radio' id='backboneRed' name='backboneColour' value='red' style='width:50px' onChange='toggleBackboneColour()'>Red<br />
                                        </div>
                                    </div>
                                    <h6>Trace</h6>
                                    <div class='row'>
                                        <div class='radio-buttons'>
                                            <p>Weight</p>
                                            <input type='radio' id='traceStructure' name='trace' value='structure' style='width:50px' onChange='toggleTrace()'>Structure<br />
                                            <input type='radio' id='trace0_8' name='trace' value='0.8' style='width:50px' onChange='toggleTrace()'>0.8<br />
                                            <input type='radio' id='trace0_4' name='trace' value='0.4' style='width:50px' onChange='toggleTrace()'>0.4<br />
                                            <input type='radio' id='traceOff' name='trace' value='off' style='width:50px' onChange='toggleTrace()' checked>Off<br />
                                        </div>
                                        <div class='radio-buttons'>
                                            <p>Colour</p>
                                            <input type='radio' id='traceColourStructure' name='traceColour' value='structure' style='width:50px' onChange='toggleTraceColour()'>Structure<br />
                                            <input type='radio' id='traceColourOlive' name='traceColour' value='olive' style='width:50px' onChange='toggleTraceColour()'>Olive<br />
                                            <input type='radio' id='traceColourAmino' name='traceColour' value='amino' style='width:50px' onChange='toggleTraceColour()'>Amino<br />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='container jmol-container' id='Jmol1'>
                            <div class='row'>
                                <div id='JmolDiv1' class='column column-60'></div>
                                <div class='column column-40'>
                                    <div class='radio-buttons'>
                                        <p>Count</p>
                                        <input type='radio' id='strandCount_1' name='strandCount' value='strand_1' style='width:50px' onChange='toggleStrandCount()'>1<br />
                                        <input type='radio' id='strandCount_5' name='strandCount' value='strand_5' style='width:50px' onChange='toggleStrandCount()'>5<br />
                                        <input type='radio' id='strandCount_11' name='strandCount' value='strand_11' style='width:50px' onChange='toggleStrandCount()' checked>11<br />
                                        <input type='radio' id='strandCount_20' name='strandCount' value='strand_20' style='width:50px' onChange='toggleStrandCount()'>20<br />
                                    </div>
                                    <div class='radio-buttons'>
                                        <p>Colour</p>
                                        <input type='radio' id='strandColourStructure' name='strandColour' value='Structure' style='width:50px' onChange='toggleStrandColour()'>Structure<br />
                                        <input type='radio' id='strandColourAmino' name='strandColour' value='Amino' style='width:50px' onChange='toggleStrandColour()' checked>Amino<br />
                                        <input type='radio' id='strandColourBlue' name='strandColour' value='Blue' style='width:50px' onChange='toggleStrandColour()'>Blue<br />
                                    </div>
                                </div>
                            </div>
                        </div>";

                        echo "<script type=\"text/javascript\">
                            $(document).ready(function(){
                                var loadScriptPredictions = `" . $loadScriptPredictions . "`;

                                var JmolInfo0 = {
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
                                        Jmol.script(applet, loadScriptPredictions + '; spacefill 0.25; wireframe 0.1;');
                                    }
                                };
                                $('#JmolDiv0').html(Jmol.getAppletHtml('jmolApplet0', JmolInfo0));

                                var JmolInfo1 = {
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
                                        Jmol.script(applet, loadScriptPredictions + '; spacefill off; wireframe off; strands on; set strands 11; color strands amino;');
                                    }
                                };
                                $('#JmolDiv1').html(Jmol.getAppletHtml('jmolApplet1', JmolInfo1));

                                var JmolInfo2 = {
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
                                        Jmol.script(applet, loadScriptPredictions + '; spacefill; color temperature;');
                                    }
                                };
                                $('#JmolDiv2').html(Jmol.getAppletHtml('jmolApplet2', JmolInfo2));
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
        var defaultContainer = document.getElementById('Jmol2');
        if (defaultContainer) {
            defaultContainer.style.display = 'block';
        }

        // Hide other containers initially
        containers.forEach(function(container) {
            if (container.id !== 'Jmol2') {
                container.style.display = 'none';
            }
        });
    });

    function toggleWireframe() {
        const wireframeOn = document.getElementById('wireframe').checked;
        if (wireframeOn) {
            Jmol.script(jmolApplet0, 'select *;wireframe 0.1');
        } else {
            Jmol.script(jmolApplet0, 'select *;wireframe off');
        }
    }

    function toggleShowAminoAcids() {
        const showAminoAcidsOn = document.getElementById('showAminoAcids').checked;
        if (showAminoAcidsOn) {
            Jmol.script(jmolApplet0, 'select *;label %n;');
        } else {
            Jmol.script(jmolApplet0, 'select *;label off;');        
        }
    }

    function toggleShowAtoms() {
        const showAtomsOn = document.getElementById('showAtoms').checked;
        if (showAtomsOn) {
            Jmol.script(jmolApplet0, 'select *;spacefill 0.25;');
        } else {
            Jmol.script(jmolApplet0, 'select *;spacefill off');        
        }
    }

    function toggleBackbone() {
        const backbone0_6 = document.getElementById('backbone0_6').checked;
        const backbone0_3 = document.getElementById('backbone0_3').checked;
        const backboneOff = document.getElementById('backboneOff').checked;
        
        if (backbone0_6) {
            Jmol.script(jmolApplet0, 'select *;backbone 0.6');
        } else if (backbone0_3) {
            Jmol.script(jmolApplet0, 'select *;backbone 0.3');
        } else if (backboneOff) {
            Jmol.script(jmolApplet0, 'select *;backbone off');
        }
    }

    function toggleBackboneColour() {
        const backboneStructure = document.getElementById('backboneStructure').checked;
        const backboneGreen = document.getElementById('backboneGreen').checked;
        const backboneRed = document.getElementById('backboneRed').checked;
        
        if (backboneStructure) {
            Jmol.script(jmolApplet0, 'select *;color backbone structure');
        } else if (backboneRed) {
            Jmol.script(jmolApplet0, 'select *;color backbone firebrick');
        } else if (backboneGreen) {
            Jmol.script(jmolApplet0, 'select *;color backbone greenyellow');
        }
    }

    function toggleTrace() {
        const traceStructure = document.getElementById('traceStructure').checked;
        const trace0_8 = document.getElementById('trace0_8').checked;
        const trace0_4 = document.getElementById('trace0_4').checked;
        const traceOff = document.getElementById('traceOff').checked;

        if (traceStructure) {
            Jmol.script(jmolApplet0, 'select *;trace structure');
        } else if (trace0_8) {
            Jmol.script(jmolApplet0, 'select *;trace 0.8');
        } else if (trace0_4) {
            Jmol.script(jmolApplet0, 'select *;trace 0.4');
        } else if (traceOff) {
            Jmol.script(jmolApplet0, 'select *;trace off');
        }
    }

    function toggleTraceColour() {
        const traceColourStructure = document.getElementById('traceColourStructure').checked;
        const traceColourOlive = document.getElementById('traceColourOlive').checked;
        const traceColourAmino = document.getElementById('traceColourAmino').checked;

        if (traceColourStructure) {
            Jmol.script(jmolApplet0, 'select *;color trace structure');
        } else if (traceColourOlive) {
            Jmol.script(jmolApplet0, 'select *;color trace olive');
        } else if (traceColourAmino) {
            Jmol.script(jmolApplet0, 'select *;color trace amino');
        }
    }

    function toggleStrandCount() {
        const strandCount_1 = document.getElementById('strandCount_1').checked;
        const strandCount_5 = document.getElementById('strandCount_5').checked;
        const strandCount_11 = document.getElementById('strandCount_11').checked;
        const strandCount_20 = document.getElementById('strandCount_20').checked;

        if (strandCount_1) {
            Jmol.script(jmolApplet1, 'select *;set strands 1');
        } else if (strandCount_5) {
            Jmol.script(jmolApplet1, 'select *;set strands 5');
        } else if (strandCount_11) {
            Jmol.script(jmolApplet1, 'select *;set strands 11');
        } else if (strandCount_20) {
            Jmol.script(jmolApplet1, 'select *;set strands 20');
        }
    }

    function toggleStrandColour() {
        const strandColourStructure = document.getElementById('strandColourStructure').checked;
        const strandColourAmino = document.getElementById('strandColourAmino').checked;
        const strandColourBlue = document.getElementById('strandColourBlue').checked;

        if (strandColourStructure) {
            Jmol.script(jmolApplet1, 'select *;color strands structure');
        } else if (strandColourAmino) {
            Jmol.script(jmolApplet1, 'select *;color strands amino');
        } else if (strandColourBlue) {
            Jmol.script(jmolApplet1, 'select *;color strands slateblue');
        }
    }

</script>
</html>
