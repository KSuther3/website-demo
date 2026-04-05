<?php
// --- Configuration ---
$to = "ksuther2@student.scf.edu";   // Your email
$subject = "New Contact Form Submission";

// --- Collect and sanitize form data ---
$firstName = filter_input(INPUT_POST, 'FirstName', FILTER_SANITIZE_STRING);
$lastName  = filter_input(INPUT_POST, 'LastName', FILTER_SANITIZE_STRING);
$city      = filter_input(INPUT_POST, 'City', FILTER_SANITIZE_STRING);
$state     = filter_input(INPUT_POST, 'State', FILTER_SANITIZE_STRING);
$zip       = filter_input(INPUT_POST, 'Zip', FILTER_SANITIZE_STRING);
$email     = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
$gender    = filter_input(INPUT_POST, 'Gender', FILTER_SANITIZE_STRING);
$education = '';
if (!empty($_POST['HS'])) $education .= 'H.S. ';
if (!empty($_POST['College'])) $education .= 'College ';
$comments  = filter_input(INPUT_POST, 'Comments', FILTER_SANITIZE_STRING);

// --- Check required fields ---
if (!$firstName || !$lastName || !$email) {
    die("Error: Please fill in all required fields.");
}

// --- Create the email body ---
$message = "Contact Form Submission\n\n";
$message .= "First Name: $firstName\n";
$message .= "Last Name: $lastName\n";
$message .= "City: $city\n";
$message .= "State: $state\n";
$message .= "Zip Code: $zip\n";
$message .= "Email: $email\n";
$message .= "Gender: $gender\n";
$message .= "Education: $education\n";
$message .= "Comments:\n$comments\n";

// --- Set headers ---
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";

// --- Send the email ---
mail($to, $subject, $message, $headers);

// --- Redirect to confirmation page ---
header("Location: contactSent.htm");
exit;
?>