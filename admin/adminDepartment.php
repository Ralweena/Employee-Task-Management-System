<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Department"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">      
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    
    <?php 
        session_start();

        include '../php/config.php';

        $gender = $_SESSION['admin_gender'];
        $email = $_SESSION['admin_email'];
        $name = $_SESSION['admin_name'];

        $sql = "SELECT dept_name, admin_name, admin_email, admin_phone FROM DEPARTMENT NATURAL JOIN ADMIN_MANAGER WHERE ADMIN_MANAGER.admin_email = '$email'";
        $result = $conn->query($sql);

    ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Department ****** -->
            <section id="department">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Manage Department</p>
                        <button><a href="addDepartment.php">Add</a></button>
                    </div>
                    <table>
                        <tr>
                            <th>S.No</th>
                            <th>Department Name</th>
                            <th>Manager Name</th>
                            <th>Manager Email</th>
                            <th>Employee Contact Number</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if ($result->num_rows > 0) {
                                $serialNo = 1; // Initialize the serial number
                                while ($row = $result->fetch_assoc()) {
                                    $dept_name = $row["dept_name"];
                                    echo "<tr>";
                                    echo "<td>" . $serialNo . "</td>";
                                    echo "<td>" . $row["dept_name"] . "</td>";
                                    echo "<td>" . $row["admin_name"] . "</td>";
                                    echo "<td>" . $row["admin_email"] . "</td>";
                                    echo "<td>" . $row["admin_phone"] . "</td>";
                                    echo "<td class='buttons'><button onclick='editDepartment(\"$dept_name\")'>Edit</button><button onclick='deleteDepartment(\"$dept_name\")'>Delete</button></td>";
                                    echo "</tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='5'>No records found</td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>
    <script  type="text/javascript" src="../js/adminDepartment.js"></script>

</body>

</html>