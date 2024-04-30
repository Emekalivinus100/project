
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

// Insert the fingerprint template into the database
$query = "INSERT INTO fingerprints (user_id, template) VALUES (1, ?)";
if ($stmt = mysqli_prepare($conn, $query)) {
    mysqli_stmt_bind_param($stmt, "s", json_encode($fpTemplate));
    if (mysqli_stmt_execute($stmt)) {
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        if ($affectedRows == 0) {
            $errors[] = "Insert failed: No rows affected";
        }
    } else {
        $errors[] = "Insert failed: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    $errors[] = "Prepare failed: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);

// Display any errors that occurred
if (!empty($errors)) {
    echo "Errors occurred:<br>";
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    echo "Enrollment successful";
}



