<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "EditDepartment"; // Set the custom title for this page
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
        $name = $_SESSION['admin_name'];
        $dept_name = $_COOKIE['dept_name'];

        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Edit Employee ****** -->
            <section id="editDepartment">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Edit Department</p>
                    </div>

                    <form action="../php/process.php" method="post">
                        <p style="display: none;"><input type="text" name="old_dept_name" value="<?php echo $dept_name ?>" required></p>
                        <p>
                            <label for="dept_name">Department Name :</label>
                            <input type="text" name="new_dept_name" id="new_dept_name" value="<?php echo $dept_name ?>" required/>
                        </p>

                        <p>
                            <label for="admin_name">Manager Name :</label>
                            <input type="text" name="admin_name" id="admin_name" value="<?php echo $name ?>" readonly required/>
                        </p>

                        <div class="submitBtn">
                            <button type="submit" name="editDepartment">Edit</button>
                        </div>
                    </form>
                </div>
                
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>  

</body>

</html>