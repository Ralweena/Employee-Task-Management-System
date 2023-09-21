<?php

    include '../php/config.php';

    if(isset($_POST['dept_name'])) {

        $dept_name = $_POST['dept_name'];

        $sql = "SELECT dept_id FROM DEPARTMENT WHERE dept_name = '$dept_name'";
        $sql_res = $conn->query($sql);

        while ($row = $sql_res->fetch_assoc()) {
            $dept_id = $row["dept_id"];
        }

        $query = "SELECT emp_name FROM EMPLOYEE WHERE dept_id = '$dept_id'";
        $result = $conn->query($query);

    ?>
    <option value="" disabled selected>---- Select Employee ----</option>

    <?php
        foreach ($result as $emp) {
    ?>

    <option value="<?php echo $emp['emp_name']; ?>"> <?php echo $emp['emp_name'] ?></option>
    
    <?php
        }
    }
?>