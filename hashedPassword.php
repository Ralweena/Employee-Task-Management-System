<?php
$plaintextPassword = "secret@123"; // Replace with the password you want to hash

$hashedPassword = password_hash($plaintextPassword, PASSWORD_BCRYPT);

echo "Hashed Password: " . $hashedPassword;
?> 
