<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        $pageTitle = "New Task"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        $task_details = "SELECT E.emp_email, T.task_id, T.task_title, D.dept_name, T.startDate, T.endDate, TS.task_status
        FROM TASK T, TASK_STATUS TS, DEPARTMENT D, EMPLOYEE E
        WHERE D.dept_id = E.dept_id AND E.emp_id = TS.emp_id AND T.task_id = TS.task_id AND TS.task_status = 'Not Started'";
        $task_result = $conn->query($task_details);

    ?>
    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'employeeSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'employeeTopbar.php' ?>

            <!--- ***** New Task ****** -->
            <section id="newTask">
                
                <div class="box">
                    <div class="title">
                        <p>View New Tasks</p>
                    </div>
                    <table>
                        <tr>
                            <th>S.No</th>
                            <th>Task Title</th>
                            <th>Department Name</th>
                            <th>Assigned Date</th>
                            <th>End Date</th>
                            <th>Task Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            if ($task_result->num_rows > 0) {
                                $serialNo = 1; // Initialize the serial number
                                while ($row = $task_result->fetch_assoc()) {
                                    $emp_email = $row["emp_email"];
                                    $task_id = $row["task_id"];
                                    echo "<tr>";
                                    echo "<td>" . $serialNo . "</td>";
                                    echo "<td>" . $row["task_title"] . "</td>";
                                    echo "<td>" . $row["dept_name"] . "</td>";
                                    echo "<td>" . $row["startDate"] . "</td>";
                                    echo "<td>" . $row["endDate"] . "</td>";
                                    echo "<td>" . $row["task_status"] . "</td>";
                                    echo "<td class='buttons'><button onclick='viewTasks(\"$emp_email\", \"$task_id\")'>View</button></td>";
                                    echo "</tr>";
                                    $serialNo++; 
                                }
                            } else {
                                echo "<tr><td colspan='7'>No New Tasks</td></tr>";
                            }
                        ?>
                    </table>
                </div>

            </section>            

        </div>

    </div>
    <script src="../js/adminDashboard.js"></script>
    
</body>

</html>