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

        $gender = $_SESSION['admin_gender'];
        $name = $_SESSION['admin_name'];

        $dept = "SELECT COUNT(*) as total_dept FROM DEPARTMENT";
        $dept_result = $conn->query($dept);

        if ($dept_result->num_rows >= 0) {
            $dept_row = $dept_result->fetch_assoc();
            $total_dept = $dept_row["total_dept"];
        } 

        $emp = "SELECT COUNT(*) as total_emp FROM EMPLOYEE";
        $emp_result = $conn->query($emp);
        
        if ($emp_result->num_rows >= 0) {
            $emp_row = $emp_result->fetch_assoc();
            $total_emp = $emp_row["total_emp"];
        } 

        $task = "SELECT COUNT(*) as total_task FROM TASK";
        $task_result = $conn->query($task);

        if ($task_result->num_rows >= 0) {
            $task_row = $task_result->fetch_assoc();
            $total_task = $task_row["total_task"];
        } 

        $completedTask = "SELECT COUNT(*) as total_completed_task FROM TASK_STATUS WHERE task_status = 'Completed'";
        $completedTask_result = $conn->query($completedTask);

        if ($completedTask_result->num_rows >= 0) {
            $completedTask_row = $completedTask_result->fetch_assoc();
            $total_completed_task = $completedTask_row["total_completed_task"];
        } 

        $inprogressTask = "SELECT COUNT(*) as total_inprogress_task FROM TASK_STATUS WHERE task_status = 'In Progress'";
        $inprogressTask_result = $conn->query($inprogressTask);

        if ($inprogressTask_result->num_rows >= 0) {
            $inprogressTask_row = $inprogressTask_result->fetch_assoc();
            $total_inprogress_task = $inprogressTask_row["total_inprogress_task"];
        } 

    ?>
    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Dashboard ****** -->
            <section id="dashboard">
                
                <!-- ***** Cards ***** -->
                <div class="cardBox">
                    <div class="card">
                        <div class="department">
                            <div class="Number"><?php echo $total_dept ?></div>
                            <div class="CardName">Departments</div>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="card">
                        <div class="employee">
                            <div class="Number"><?php echo $total_emp ?></div>
                            <div class="CardName">Employees</div>
                        </div>
                        <div class="icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="card">
                        <div class="totalTasks">
                            <div class="Number"><?php echo $total_task ?></div>
                            <div class="CardName">Total Tasks</div>
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