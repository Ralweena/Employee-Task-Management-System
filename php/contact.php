<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // You can add more validation and security measures here

    // Process the data (for demonstration purposes, just send a simple response)
    $response = ["success" => true];
    echo json_encode($response);
} else {
    // Handle invalid requests here
    http_response_code(400);
    echo json_encode(["success" =>  false]);
}
?>
