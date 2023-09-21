<?php

    include '../php/config.php';

    if(isset($_POST['emp_email'])) {

        $emp_email = $_POST['emp_email'];

        $query = "DELETE FROM EMPLOYEE WHERE emp_email = '$emp_email'";
        $result = $conn->query($query);

    }
?>