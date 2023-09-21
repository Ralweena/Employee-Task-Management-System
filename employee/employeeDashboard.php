<!DOCTYPE html>
<html lang="en">

<head>

    <?php
        $pageTitle = "Dashboard"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">

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

        $newTask = "SELECT COUNT(*) as total_new_task FROM TASK_STATUS WHERE emp_id = $emp_id AND task_status = 'Not Started'";
        $newTask_result = $conn->query($newTask);
        
        if ($newTask_result->num_rows >= 0) {
            $newTask_row = $newTask_result->fetch_assoc();
            $total_new_task = $newTask_row["total_new_task"];
        } 

        $allTask = "SELECT COUNT(*) as total_task FROM TASK_STATUS WHERE emp_id = $emp_id";
        $task_result = $conn->query($allTask);

        if ($task_result->num_rows >= 0) {
            $task_row = $task_result->fetch_assoc();
            $total_task = $task_row["total_task"];
        } 

        $completedTask = "SELECT COUNT(*) as total_completed_task FROM TASK_STATUS WHERE task_status = 'Completed' AND emp_id = $emp_id";
        $completedTask_result = $conn->query($completedTask);

        if ($completedTask_result->num_rows >= 0) {
            $completedTask_row = $completedTask_result->fetch_assoc();
            $total_completed_task = $completedTask_row["total_completed_task"];
        } 

        $inprogressTask = "SELECT COUNT(*) as total_inprogress_task FROM TASK_STATUS WHERE task_status = 'In Progress' AND emp_id = $emp_id";
        $inprogressTask_result = $conn->query($inprogressTask);

        if ($inprogressTask_result->num_rows >= 0) {
            $inprogressTask_row = $inprogressTask_result->fetch_assoc();
            $total_inprogress_task = $inprogressTask_row["total_inprogress_task"];
        } 

    ?>
    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'employeeSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'employeeTopbar.php' ?>

            <!--- ***** Dashboard ****** -->
            <section id="dashboard">
                
                <!-- ***** Cards ***** -->
                <div class="cardBox">
                    <div class="card">
                        <div class="newTask">
                            <div class="Number"><?php echo $total_new_task ?></div>
                            <div class="CardName">New Task</div>
                        </div>
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                    </div>
                    <div class="card">
                        <div class="totalTasks">
                            <div class="Number"><?php echo $total_task ?></div>
                            <div class="CardName">All Tasks</div>
                        </div>
                        <div class="icon"><i class="fas fa-tasks"></i></div>
                    </div>
                    <div class="card">
                        <div class="completedTasks">                   
                            <div class="Number"><?php echo $total_completed_task ?></div>   
                            <div class="CardName">Completed Tasks</div>
                        </div>
                        <div class="icon"><i class="fa-solid fa-file-circle-check"></i></div>
                    </div>
                    <div class="card">
                        <div class="inprogressTasks">
                            <div class="Number"><?php echo $total_inprogress_task ?></div>
                            <div class="CardName">Inprogress Tasks</div>
                        </div>
                        <div class="icon"><i class="fa-solid fa-bars-progress"></i></div>
                    </div>
                </div>

            </section>            

        </div>

    </div>
    <script src="../js/adminDashboard.js"></script>
    
</body>

</html>