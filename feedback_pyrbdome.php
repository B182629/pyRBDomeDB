<?php

// This webpage is the home page: contains information about the database as well as brief introduction to the tools and features

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

    <title>Feedback</title>
</head>

<body>
<h1>Website Feedback Form</h1>
    <form action="process_feedback.php" method="post">
        <fieldset>
            <legend>User Information</legend>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="affiliation">Affiliation/Institution:</label>
            <input type="text" id="affiliation" name="affiliation">
        </fieldset>
        
        <fieldset>
            <legend>Usability</legend>
            <label for="navigation">Ease of Navigation:</label>
            <select id="navigation" name="navigation">
                <option value="very_easy">Very Easy</option>
                <option value="easy">Easy</option>
                <option value="difficult">Difficult</option>
                <option value="very_difficult">Very Difficult</option>
            </select>
            
            <label for="design">Design and Layout</label>
            <select id="design" name="design">
                <option value="excellent">Excellent</option>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
            </select>
            
            <label for="performance">Performance</label>
            <select id="performance" name="performance">
                <option value="very_fast">Very Fast</option>
                <option value="fast">Fast</option>
                <option value="average">Average</option>
                <option value="slow">Slow</option>
                <option value="very_slow">Very Slow</option>
            </select>

        </fieldset>
        
        <fieldset>
            <legend>Data and Content</legend>
            <label for="quality1">Quality of pyRBDome Information:</label>
            <p>Was the pyRBDomeDB and pyRBDome pipeline information clear and informative?</p>
            <select id="quality1" name="quality1">
                <option value="very_high">Very High</option>
                <option value="high">High</option>
                <option value="average">Average</option>
                <option value="low">Low</option>
                <option value="very_low">Very Low</option>
            </select>
            
            <label for="quality2">Quality of pyRBDomeDB Data:</label>
            <p>Were the instructions on how to use pyRBDomeDB tools and features clear and useful?</p>
            <select id="quality2" name="quality2">
                <option value="very_high">Very High</option>
                <option value="high">High</option>
                <option value="average">Average</option>
                <option value="low">Low</option>
                <option value="very_low">Very Low</option>
            </select>

            <label for="quality3">Quality of Tools and Features Information:</label>
            <p>Were the instructions on how to use pyRBDomeDB tools and features clear and useful?</p>
            <select id="quality3" name="quality3">
                <option value="very_high">Very High</option>
                <option value="high">High</option>
                <option value="average">Average</option>
                <option value="low">Low</option>
                <option value="very_low">Very Low</option>
            </select>

            <label for="tools">Data Access and Tools:</label>
            <p>Were the pyRBDomeDB tools easy to use and effective?</p>
            <select id="tools" name="tools">
                <option value="very_easy">Very Easy</option>
                <option value="easy">Easy</option>
                <option value="difficult">Difficult</option>
                <option value="very_difficult">Very Difficult</option>
            </select>
        </fieldset>
        
        <fieldset>
            <legend>User Experience</legend>
            <label for="experience">Overall Experience:</label>
            <select id="experience" name="experience">
                <option value="excellent">Excellent</option>
                <option value="good">Good</option>
                <option value="fair">Fair</option>
                <option value="poor">Poor</option>
            </select>
            
            <label for="liked_features">What features/tools were most effective in exploring RNA-binding protein data?</label>
            <textarea id="liked_features" name="liked_features" rows="4"></textarea>
            
            <label for="improvements">Are there any tools/functionalities you would improve?</label>
            <textarea id="improvements" name="improvements" rows="4"></textarea>

            <label for="improvements">Are there any additional tools/functionalities you would add?</label>
            <textarea id="improvements" name="improvements" rows="4"></textarea>
            
            <label for="bugs">Did you encounter any bugs or issues? Please describe them:</label>
            <textarea id="bugs" name="bugs" rows="4"></textarea>

            <label for="bugs">Additional comments:</label>
            <textarea id="bugs" name="bugs" rows="4"></textarea>
        </fieldset>
        
        <fieldset>
            <legend>Open-Ended Questions</legend>
            <label for="general_feedback">General Feedback:</label>
            <textarea id="general_feedback" name="general_feedback" rows="4"></textarea>
            
            <label for="use_cases">How do you typically use RNA-binding protein data in your research? How well does this website meet those needs?</label>
            <textarea id="use_cases" name="use_cases" rows="4"></textarea>
        </fieldset>
        
        <button type="submit">Submit Feedback</button>
    </form>
</body>
</html>