verify.php

<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'Emmy', 'Pennywise13@', 'emmy');

// Check connection
if (!$conn) {
    $errors[] = "Connection failed: " . mysqli_connect_error();
}

// Define the fingerprint template as a JSON string
$jsonString = '{"name":"John","age":30,"fingerprint":"1234567890abcdef"}';

// Decode the JSON string into an associative array
$fpTemplate = json_decode($jsonString, true);

// Retrieve the stored fingerprint template from the database
$query = "SELECT template FROM fingerprints WHERE user_id = 1";
if ($result = mysqli_query($conn, $query)) {
    $storedTemplate = mysqli_fetch_assoc($result);
} else {
    $errors[] = "Database error: " . mysqli_error($conn);
}

// Verify the scanned fingerprint template against the stored template
$verificationResult = verifyFingerprint($fpTemplate, $storedTemplate);

// Send the verification result back to the client
echo json_encode($verificationResult);

// Close the connection
mysqli_close($conn);

// Function to verify the fingerprint templates
function verifyFingerprint($fpTemplate, $storedTemplate) {
    // Your verification logic here
    // Return true or false
}