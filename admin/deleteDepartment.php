<?php

    include '../php/config.php';

    if(isset($_POST['dept_name'])) {

        $dept_name = $_POST['dept_name'];

        $query = "DELETE FROM DEPARTMENT WHERE dept_name = '$dept_name'";
        $result = $conn->query($query);

    }
?>