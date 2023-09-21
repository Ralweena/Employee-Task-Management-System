<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Add Employee"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">

</head>
<body>
    
<?php 
        session_start();

        include '../php/config.php';

        $gender = $_SESSION['admin_gender'];
        $email = $_SESSION['admin_email'];

        $admin = "SELECT admin_id FROM ADMIN_MANAGER WHERE admin_email = '$email'";
        $result_admin = $conn->query($admin);

        if ($result_admin->num_rows > 0) {
            while ($row = $result_admin->fetch_assoc()) {
                $admin_id = $row["admin_id"];
            }
        }

        $dept = "SELECT dept_name FROM DEPARTMENT WHERE admin_id = $admin_id";
        $result_dept = $conn->query($dept);

        $department_names = array();

        if ($result_dept->num_rows > 0) {
            while ($row = $result_dept->fetch_assoc()) {
                $department_names[] = $row["dept_name"];
            }
        }

        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Add Employee ****** -->
            <section id="addEmployee">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Add Employee</p>
                    </div>

                    <form action="../php/process.php" method="post" name="registration-form" onsubmit="validateRegistrationForm()">
                        <p>
                            <label for="emp_name">Employee Name :</label>
                            <input type="text" name="emp_name" id="emp_name" required/>
                        </p>

                        <p>
                            <label for="emp_email">Employee Email :</label>
                            <input type="email" name="emp_email" id="emp_email" required />
                        </p>

                        <p>
                            <label for="emp_phone">Employee Contact Number :</label>
                            <input type="number" name="emp_phone" id="emp_phone" required/>
                        </p>

                        <p>
                            <label for="emp_gender">Employee Gender :</label>
                            <select name="emp_gender" id="emp_gender" required>
                                <option value="" disabled selected>---- Select Gender ----</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </p>

                        <p>
                            <label for="dept_name">Department Name :</label>
                            <select name="dept_name" id="dept_name" required>
                                <option value="" disabled selected>---- Select Department ----</option>
                                <?php 
                                    foreach ($department_names as $dept_name) {
                                        echo "<option>$dept_name</option>";
                                    }
                                ?>
                            </select>
                        </p>

                        <p>
                            <label for="emp_pass">Password :</label>
                            <input type="password" name="emp_pass" id="emp_pass" required/>
                        </p>

                        <p>
                            <label for="emp_c_pass">Confirm password :</label>
                            <input type="password" name="emp_c_pass" id="emp_c_pass" required/>
                        </p>

                        <div class="submitBtn">
                            <button type="submit" name="addEmployee">Add</button>
                        </div>
                    </form>
                </div>
                
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>    
    <script src="../js/validation.js"></script>    

</body>

</html>