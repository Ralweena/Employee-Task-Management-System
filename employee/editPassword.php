<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        $pageTitle = "Edit Password"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">

</head>

<body>

    <?php 
        session_start();

        include "../php/config.php";

        $emp_id = $_SESSION['employee_id'];

        $emp = "SELECT emp_name, emp_gender FROM EMPLOYEE WHERE emp_id = $emp_id";
        $emp_result = $conn->query($emp);
        
        if ($emp_result->num_rows >= 0) {
            $emp_row = $emp_result->fetch_assoc();
            $name = $emp_row["emp_name"];
            $gender = $emp_row["emp_gender"];
        } 

    ?>
    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'employeeSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'employeeTopbar.php' ?>

            <!--- ***** New Task ****** -->
            <section id="editPassword">
                
                <div class="box">
                    <div class="title">
                        <p>Edit Password</p>
                    </div>
                    <form action="../php/process.php" method="post" name="registration-form" onsubmit="validateRegistrationForm()">
                        
                        <p style="display: none;"><input type="text" name="emp_id" value="<?php echo $emp_id ?>" readonly required/></p>
                        <p>
                            <label for="old_password">Password :</label>
                            <input type="password" name="old_password" id="old_password" required/>
                        </p>

                        <p>
                            <label for="new_password">New Password:</label>
                            <input type="password" name="new_password" id="new_password" required/>
                        </p>

                        <p>
                            <label for="confirm_password">Confirm New Password :</label>
                            <input type="password" name="confirm_password" id="confirm_password" required/>
                        </p>

                        <div class="submitBtn">
                            <button type="submit" name="editPassword">Edit</button>
                        </div>
                    </form>
                </div>

            </section>            

        </div>

    </div>
    <script src="../js/adminDashboard.js"></script>
    
</body>

</html>
