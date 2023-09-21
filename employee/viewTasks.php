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
    <link rel="stylesheet" href="../css/viewTasks.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        $emp_email = $_COOKIE['emp_email'];
        $task_id = $_COOKIE['task_id'];

        $sql = "SELECT T.task_title, T.task_desc, D.dept_name, T.startDate, T.endDate, T.task_priority, TS.task_status
        FROM TASK T, TASK_STATUS TS, DEPARTMENT D, EMPLOYEE E
        WHERE T.task_id = '$task_id' AND TS.task_id = '$task_id' AND D.dept_id = E.dept_id AND E.emp_id = TS.emp_id AND E.emp_email = '$emp_email'";

        $result = $conn->query($sql);

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
                    <div class="details">

                        <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {

                                    echo "<div>
                                            <span class='title'><b>Task Title</b></span>
                                            <span class='response'>". $row["task_title"] ."</span>
                                        </div> 
                                        <div>
                                            <span class='title'><b>Task Description</b></span>
                                            <span class='response'>". $row["task_desc"] ."</span>
                                        </div>
                                        <div>
                                            <span class='title'><b>Department Name</b></span>
                                            <span class='response'>". $row["dept_name"] ."</span>
                                        </div>
                                        <div>
                                            <span class='title'><b>Assigned Date</b></span>
                                            <span class='response'>". $row["startDate"] ."</span>
                                        </div>
                                        <div>
                                            <span class='title'><b>End Date</b></span>
                                            <span class='response'>". $row["endDate"] ."</span>
                                        </div>
                                        <div>
                                            <span class='title'><b>Task Priority</b></span>
                                            <span class='response'>". $row["task_priority"] ."</span>
                                        </div>
                                        <div>
                                            <span class='title'><b>Task Status</b></span>
                                            <span class='response'>". $row["task_status"] ."</span>
                                        </div>";
                                }
                            } 
                        ?>
                        <div class="buttons"><button onclick="updateTasks()">Update</button></div>
                    </div>
                </div>

                <div id="update_popup" class="update_popup">
                    <div class="popup-content">
                        <span class="close" id="closePopupBtn">&times;</span>
                        <h3>Update Task Status</h3>
                        <form id="dataForm" action="../php/process.php" method="post">
                            <p style="display:none"><input type="text" name="task_id" id="task_id" value="<?php echo $task_id ?>"></p>
                            <p>
                                <label for="updated_info">Remark : </label><br>
                                <textarea id="updated_info" name="updated_info" rows="3" cols="50" required></textarea>
                            </p>
                            <p>
                                <label for="updated_date">Updated Date : </label>
                                <input type="datetime-local" id="updated_date" name="updated_date" readonly required/>
                            </p>
                            <p>
                                <label for="percentage">Work Completion (in percentage): </label>
                                <input type="number" name="percentage" id="percentage" onchange="calculateValue()" min="0" max="100" required/>
                            </p>
                            <p>
                                <label for="task_status">Status : </label>
                                <input type="text" id="task_status" name="task_status" readonly required/>
                            </p>
                
                            <button type="submit" name="updateTask">Update</button>
                        </form>
                    </div>
                </div>

            </section>            

        </div>

    </div>
    <script src="../js/adminDashboard.js"></script>
    <script src="../js/viewTasks.js"></script>
    
</body>

</html>