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

    <script>
        function viewTasks(emp_email, task_id) {
            document.cookie = "emp_email = "+emp_email;
            document.cookie = " task_id = "+ task_id;
            window.location.href = "viewTasks.php";  

        }
    </script>

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

        $sql = "SELECT  E.emp_email, T.task_id, T.task_title, TS.task_status, T.endDate, TS.task_percentage 
        FROM TASK T, TASK_STATUS TS, EMPLOYEE E
        WHERE E.emp_id = $emp_id AND T.task_id = TS.task_id AND TS.emp_id = E.emp_id
        GROUP BY T.endDate
        ORDER BY T.endDate DESC";
        
        $result = $conn->query($sql);

        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'employeeSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'employeeTopbar.php' ?>

            <!--- ***** Task Report ****** -->
            <section id="taskStatus">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Task History</p>
                    </div>

                    <table>
                        <tr>
                            <th>S.No</th>
                            <th>Task Title</th>
                            <th>End Date</th>
                            <th>Task Status</th>
                            <th>Work Completion</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if ($result->num_rows > 0) {
                                $serialNo = 1; // Initialize the serial number
                                while ($row = $result->fetch_assoc()) {
                                    $emp_email = $row["emp_email"];
                                    $task_id = $row["task_id"];
                                    echo "<tr>";
                                    echo "<td>" . $serialNo . "</td>";
                                    echo "<td>" . $row["task_title"] . "</td>";
                                    echo "<td>" . $row["endDate"] . "</td>";
                                    echo "<td>" . $row["task_status"] . "</td>";
                                    echo "<td><input type='range' id='work_completion' min='1' max='100' value='".$row["task_percentage"]."' step='1' readonly></td>";
                                    echo "<td class='buttons'><button onclick='viewTasks(\"$emp_email\", \"$task_id\")'>View</button></td>";
                                    echo "</tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='6'>No New Tasks</td></tr>";
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