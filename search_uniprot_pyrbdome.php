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
</head>
<body>
    <!-- build layout of website using bootstrap CSS -->
    <div class="container">
        <div class="row">
            <h3>Search UniProt IDs</h3>
        </div>
        <div class="row">
            <p>Search for compounds using their Catalogue Name or Manufacturer. To view more details about a specific compound, click of the 'Catalogue Name' of the compound.</p>
        </div>          
        <div class="row">
            <!-- form for searching compounds using post method -->
            <form action="" method="POST">
                <div class="input-group mb-3">
                    <!-- input field for entering search query using placeholder examples -->
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search Example: SPH1-002-081, 002, SPH2" required>
                    <!-- button to submit the search form to server -->
                    <button type="submit" name="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>


    <div class="row">
        <table>
            <thead>
                <tr>
                    <th>Catalogue Name</th>
                    <th>Manufacturer</th>
                    <th>Number of Atoms</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // check if search form is submitted using POST method
                if(isset($_POST['submit'])) {
                    try {
                        // connect to mysql database using credentials stored in login.php
                        $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $filtervalues = '%' . $_POST['search'] . '%'; // add wildcard before and after search sting to find patial string
                        // construct mysql query based on filter values and prepare query to avoid SQL injection
                        $query = "SELECT c.id, c.catn, o.name, c.natm FROM Compounds c JOIN Manufacturers o ON c.ManuID = o.id WHERE c.catn LIKE :filtervalues OR o.name LIKE :filtervalues";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':filtervalues', $filtervalues);
                        $stmt->execute();
                        
                        // count no. rows and initialise displayed count
                        $rows = $stmt->rowCount();
                        $displayedCount = 0;

                        // only displays first 100 results 
                        if ($rows > 100) {
                            echo "<tr><td colspan='3'> $rows results. Only the first 100 results are displayed.</td></tr>";
                        }
                        if ($rows > 0) {
                            while($items = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                if ($displayedCount >= 100) {
                                    break; // Exit the loop if 100 results have been displayed
                                    }
                ?>
                                <tr>
                                    <!-- display search results in a table -->
                                    <td><?= $items['name']; ?></td>
                                    <td><?= $items['natm']; ?></td>
                                </tr>
                <?php
                                $displayedCount++; // add 1 to the the counter for each displayed result
                            }
                        } else {
                ?>
                            <tr>
                                <td colspan="3">No Record Found</td>
                            </tr>
                    <?php
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>