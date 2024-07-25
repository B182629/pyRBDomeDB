<?php

// This webpage is the home page: contains information about the database as well as brief introduction to the tools and features

session_start(); // Start session management
include 'menu_pyrbdome.php'; // Include menu script to show menu bar
include 'login_pyrbdome.php';
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
<div class='container'>
    <br>
    <h3>pyRBDomeDB Feedback Form</h3>
        <form action="feedback_pyrbdome.php" method="post">
            <fieldset>
                <h4>User Information</h4>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="affiliation">Affiliation/Institution:</label>
                <input type="text" id="affiliation" name="affiliation">
            </fieldset>
            
            <fieldset>
                <h4>Usability</h4>
                <label for="navigation">Ease of Navigation</label>
                <select id="navigation" name="navigation">
                    <option value="very_easy">Very Easy</option>
                    <option value="easy">Easy</option>
                    <option value="easy">OK</option>
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

                <label for="improvements">Additional comments regarding navigation, design/layout or performnace:</label>
                <textarea id="improvements" name="improvements" rows="4"></textarea>
            </fieldset>
            
            <fieldset>
                <h4>Data, Tools and Content</h4>
                <label for="quality1">Was the pyRBDomeDB and pyRBDome pipeline information clear and informative?</label>
                <select id="quality1" name="quality1">
                    <option value="very_clear/informative">Very Clear/Informative</option>
                    <option value="clear/informative">Clear/Informative</option>
                    <option value="average">Average</option>
                    <option value="unclear/uninformative">Unclear/Uninformative</option>
                    <option value="very_unclear/uninformative">Very Unclear/Uninformative</option>
                </select>
                
                <label for="quality2">Was the retrieved pyRBDome prediction data of high quality?</label>
                <select id="quality2" name="quality2">
                    <option value="very_high">Very High</option>
                    <option value="high">High</option>
                    <option value="average">Average</option>
                    <option value="low">Low</option>
                    <option value="very_low">Very Low</option>
                </select>

                <label for="quality3">Were the instructions on how to use pyRBDomeDB tools and features clear and useful?</label>
                <select id="quality3" name="quality3">
                    <option value="very_clear/useful">Very Clear/Useful</option>
                    <option value="clear/useful">Clear/Useful</option>
                    <option value="average">Average</option>
                    <option value="unclear/unuseful">Unclear/Unuseful</option>
                    <option value="very_unclear/unuseful">Very Unclear/Unuseful</option>
                </select>

                <label for="tools">Were the pyRBDomeDB tools easy to use?</label>
                <select id="tools" name="tools">
                    <option value="very_easy">Very Easy</option>
                    <option value="easy">Easy</option>
                    <option value="difficult">Difficult</option>
                    <option value="very_difficult">Very Difficult</option>
                </select>

                <label for="liked_features">What features/tools were most effective in exploring RNA-binding proteome data?</label>
                <textarea id="liked_features" name="liked_features" rows="4"></textarea>
                
                <label for="improvements">Are there any tools/functionalities you would improve?</label>
                <textarea id="improvements" name="improvements" rows="4"></textarea>

                <label for="additional_tools">Are there any additional tools/functionalities you would add?</label>
                <textarea id="additional_tools" name="additional_tools" rows="4"></textarea>

                <label for="bugs">Additional comments regarding data, tools and content:</label>
                <textarea id="bugs" name="bugs" rows="4"></textarea>
            </fieldset>
            
            <fieldset>
                <h4>Overall Experience</h4>
                <label for="experience">How was your overall experience with pyRBDomeDB?</label>

                <select id="experience" name="experience">
                    <option value="excellent">Excellent</option>
                    <option value="good">Good</option>
                    <option value="fair">Fair</option>
                    <option value="poor">Poor</option>
                </select>

                <label for="bugs">Did you encounter any bugs or issues? Please describe them:</label>
                <textarea id="bugs" name="bugs" rows="4"></textarea>

                <label for="use_cases">How do you typically use RNA-binding proteome data in your research? How well does pyRBDomeDB meet those requirements?</label>
                <textarea id="use_cases" name="use_cases" rows="4"></textarea>

                <label for="general_feedback">General feedback/improvements:</label>
                <textarea id="general_feedback" name="general_feedback" rows="4"></textarea>
                
            </fieldset>
            
            <button type="submit">Submit Feedback</button>
        </form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data and sanitize
    $name = htmlspecialchars($_POST['name']);
    $user_email = htmlspecialchars($_POST['email']);
    $affiliation = htmlspecialchars($_POST['affiliation']);
    $navigation = htmlspecialchars($_POST['navigation']);
    $design = htmlspecialchars($_POST['design']);
    $performance = htmlspecialchars($_POST['performance']);
    $improvements = htmlspecialchars($_POST['improvements']);
    $quality1 = htmlspecialchars($_POST['quality1']);
    $quality2 = htmlspecialchars($_POST['quality2']);
    $quality3 = htmlspecialchars($_POST['quality3']);
    $tools = htmlspecialchars($_POST['tools']);
    $liked_features = htmlspecialchars($_POST['liked_features']);
    $improvements = htmlspecialchars($_POST['improvements']);
    $additional_tools = htmlspecialchars($_POST['additional_tools']);
    $bugs = htmlspecialchars($_POST['bugs']);
    $experience = htmlspecialchars($_POST['experience']);
    $use_cases = htmlspecialchars($_POST['use_cases']);
    $general_feedback = htmlspecialchars($_POST['general_feedback']);

    // Validate email
    if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }
    
    // Set the recipient email address
    $to = $email;
    
    // Set the email subject
    $subject = "New Feedback from " . $name;
    
    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $user_email\n";
    $email_content .= "Affiliation: $affiliation\n\n";
    $email_content .= "Ease of Navigation: $navigation\n";
    $email_content .= "Design and Layout: $design\n";
    $email_content .= "Performance: $performance\n";
    $email_content .= "Improvements: $improvements\n\n";
    $email_content .= "Quality of pyRBDomeDB Information: $quality1\n";
    $email_content .= "Quality of Prediction Data: $quality2\n";
    $email_content .= "Clarity of Instructions: $quality3\n";
    $email_content .= "Ease of Use of Tools: $tools\n";
    $email_content .= "Liked Features: $liked_features\n";
    $email_content .= "Improvements: $improvements\n";
    $email_content .= "Additional Tools/Functionalities: $additional_tools\n";
    $email_content .= "Bugs or Issues: $bugs\n\n";
    $email_content .= "Overall Experience: $experience\n";
    $email_content .= "Use Cases: $use_cases\n";
    $email_content .= "General Feedback: $general_feedback\n";
    
    // Set the email headers
    $headers = "From: $user_email";
    
    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "Thank you for your feedback!";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
}
?>
    <p></p>
    </div>
</body>
</html>