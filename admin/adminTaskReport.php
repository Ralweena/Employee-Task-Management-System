<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Task Report"; // Set the custom title for this page
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

        $currentDateTime = new DateTime();
        $currentDateTime->setTime(0, 0, 0);
        $currentDateTime->modify('first day of this month');
        $firstDayOfMonth = $currentDateTime->format('Y-m-d H:i:s');
        $firstDay = $currentDateTime->format('d-m-Y');
        $currentDateTime->modify('last day of this month');
        $lastDayOfMonth = $currentDateTime->format('Y-m-d H:i:s');
        $lastDay = $currentDateTime->format('d-m-Y');

        $sql_completed_task =  "SELECT E.emp_name, T.task_title, TS.updated_info, TS.updated_date, T.endDate, T.task_priority, TS.task_status 
        FROM DEPARTMENT D, EMPLOYEE E, TASK T, TASK_STATUS TS
        WHERE D.dept_id = E.dept_id AND E.emp_id = TS.emp_id AND T.task_id = TS.task_id AND TS.task_status = 'Completed' AND T.startDate >= '$firstDayOfMonth' AND T.endDate <= '$lastDayOfMonth'";
        
        $sql_inprogress_task = "SELECT E.emp_name, T.task_title, TS.updated_info, TS.updated_date, T.endDate, T.task_priority, TS.task_status 
        FROM DEPARTMENT D, EMPLOYEE E, TASK T, TASK_STATUS TS
        WHERE D.dept_id = E.dept_id AND E.emp_id = TS.emp_id AND T.task_id = TS.task_id AND TS.task_status = 'In Progress' AND T.startDate >= '$firstDayOfMonth' AND T.endDate <= '$lastDayOfMonth'";
        
        $result_completed_task = $conn->query($sql_completed_task);
        $result_inprogress_task = $conn->query($sql_inprogress_task);

        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Task Status ****** -->
            <section id="taskReport">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Task Report from <?php echo $firstDay ?> to <?php echo  $lastDay ?></p>
                    </div>

                    <div class="innerBox">
                        <div class="title">
                            <p>In Progress Tasks</p>
                        </div>
                        <!--- ***** In Progress Tasks ****** -->
                        <table>
                            <tr>
                                <th>S.No</th>
                                <th>Assigned To</th>
                                <th>Task Title</th>
                                <th>Remark</th>
                                <th>End Date</th>
                                <th>Task Priority</th>
                                <th>Task Status</th>
                                <th>Updated Date</th>
                            </tr>
                            <?php
                                if ($result_inprogress_task->num_rows > 0) {
                                    $serialNo = 1; // Initialize the serial number
                                    while ($row = $result_inprogress_task->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $serialNo . "</td>";
                                        echo "<td>" . $row["emp_name"] . "</td>";
                                        echo "<td>" . $row["task_title"] . "</td>";
                                        echo "<td>" . $row["updated_info"] . "</td>";
                                        echo "<td>" . $row["endDate"] . "</td>";
                                        echo "<td>" . $row["task_priority"] . "</td>";
                                        echo "<td>" . $row["task_status"] . "</td>";
                                        echo "<td>" . $row["updated_date"] . "</td>";
                                        echo "</tr>";
                                        $serialNo++; 
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No records found</td></tr>";
                                }
                            ?>
                        </table>
                    </div>

                    
                    <div class="innerBox">
                        <!--- ***** Completed Tasks ****** -->
                        <div class="title">
                            <p>Completed Tasks</p>
                        </div>
                        <table>
                            <tr>
                                <th>S.No</th>
                                <th>Assigned To</th>
                                <th>Task Title</th>
                                <th>Remark</th>
                                <th>End Date</th>
                                <th>Task Priority</th>
                                <th>Task Status</th>
                                <th>Updated Date</th>
                            </tr>
                            <?php
                                if ($result_completed_task->num_rows > 0) {
                                    $serialNo = 1; // Initialize the serial number
                                    while ($row = $result_completed_task->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $serialNo . "</td>";
                                        echo "<td>" . $row["emp_name"] . "</td>";
                                        echo "<td>" . $row["task_title"] . "</td>";
                                        echo "<td>" . $row["updated_info"] . "</td>";
                                        echo "<td>" . $row["endDate"] . "</td>";
                                        echo "<td>" . $row["task_priority"] . "</td>";
                                        echo "<td>" . $row["task_status"] . "</td>";
                                        echo "<td>" . $row["updated_date"] . "</td>";
                                        echo "</tr>";
                                        $serialNo++; 
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No records found</td></tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
                
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js"></script>    
    <script src="../js/validation.js"></script>    

</body>

</html>