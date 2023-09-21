<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Task Status"; // Set the custom title for this page
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

        $sql = "SELECT D.dept_name, E.emp_name, T.task_title, T.startDate, T.endDate, TS.task_status, TS.task_percentage
        FROM DEPARTMENT D, EMPLOYEE E, TASK T, TASK_STATUS TS
        WHERE D.dept_id = E.dept_id AND E.emp_id = Ts.emp_id AND T.task_id = TS.task_id";
        
        $result = $conn->query($sql);

        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Task Report ****** -->
            <section id="taskStatus">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Task Status</p>
                    </div>

                    <table>
                        <tr>
                            <th>S.No</th>
                            <th>Department Name</th>
                            <th>Task Title</th>
                            <th>Assigned To</th>
                            <th>End Date</th>
                            <th>Task Status</th>
                            <th>Work Completion</th>
                        </tr>
                        <?php
                            if ($result->num_rows > 0) {
                                $serialNo = 1; // Initialize the serial number
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $serialNo . "</td>";
                                    echo "<td>" . $row["dept_name"] . "</td>";
                                    echo "<td>" . $row["task_title"] . "</td>";
                                    echo "<td>" . $row["emp_name"] . "</td>";
                                    echo "<td>" . $row["endDate"] . "</td>";
                                    echo "<td>" . $row["task_status"] . "</td>";
                                    echo "<td><input type='range' id='work_completion' min='1' max='100' value='".$row["task_percentage"]."' step='1' readonly></td>";
                                    echo "</tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='7'>No records found</td></tr>";
                            }
                        ?>
                    </table>
                </div>
                
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>    
    <script src="../js/validation.js"></script>    

</body>

</html>