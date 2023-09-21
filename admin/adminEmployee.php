<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Employee"; // Set the custom title for this page
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
        $name = $_SESSION['admin_name'];

        $sql = "SELECT dept_name, emp_name, emp_email, emp_phone FROM EMPLOYEE E, DEPARTMENT D WHERE E.dept_id = D.dept_id";
        $result = $conn->query($sql);

    ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Employee ****** -->
            <section id="employee">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Manage Employees</p>
                        <button><a href="addEmployee.php">Add</a></button>
                    </div>
                    <table>
                        <tr>
                            <th>S.No</th>
                            <th>Department Name</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>Employee Contact Number</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if ($result->num_rows > 0) {
                                $serialNo = 1; // Initialize the serial number
                                while ($row = $result->fetch_assoc()) {
                                    $emp_email = $row["emp_email"];
                                    echo "<tr>";
                                    echo "<td>" . $serialNo . "</td>";
                                    echo "<td>" . $row["dept_name"] . "</td>";
                                    echo "<td>" . $row["emp_name"] . "</td>";
                                    echo "<td>" . $row["emp_email"] . "</td>";
                                    echo "<td>" . $row["emp_phone"] . "</td>";
                                    echo "<td class='buttons'><button onclick='editEmployee(\"$emp_email\")'>Edit</button><button onclick='deleteEmployee(\"$emp_email\")'>Delete</button></td>";
                                    echo "</tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }
                        ?>
                    </table>
                </div>
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>    
    <script src="../js/adminEmployee.js"></script>    

</body>

</html>