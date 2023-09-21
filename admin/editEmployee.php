<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Edit Employee"; // Set the custom title for this page
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
        $emp_email = $_COOKIE['emp_email'];
        $name = $_SESSION['admin_name'];

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

        $sql = "SELECT emp_name, emp_phone FROM EMPLOYEE WHERE emp_email = '$emp_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($emp_row = $result->fetch_assoc()) {
                $emp_name = $emp_row["emp_name"];
                $emp_phone = $emp_row["emp_phone"];
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

            <!--- ***** Edit Employee ****** -->
            <section id="editEmployee">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Edit Employee</p>
                    </div>

                    <form action="../php/process.php" method="post">
                        <p style="display: none;"><input type="email" name="old_emp_email" value="<?php echo $emp_email ?>" required/></p>
                        <p>
                            <label for="emp_name">Employee Name :</label>
                            <input type="text" name="emp_name" id="emp_name" value="<?php echo $emp_name ?>" required/>
                        </p>

                        <p>
                            <label for="emp_email">Employee Email :</label>
                            <input type="email" name="emp_email" id="emp_email" value="<?php echo $emp_email ?>" required />
                        </p>

                        <p>
                            <label for="emp_phone">Employee Contact Number :</label>
                            <input type="number" name="emp_phone" id="emp_phone" value="<?php echo $emp_phone ?>" required/>
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

                        <div class="submitBtn">
                            <button type="submit" name="editEmployee">Edit</button>
                        </div>
                    </form>
                </div>
                
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>    

</body>

</html>