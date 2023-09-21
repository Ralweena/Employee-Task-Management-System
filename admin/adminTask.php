<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php
        $pageTitle = "Task"; // Set the custom title for this page
        $cssFileName = "../css/admin.css";
        include "../head.php"; // Include the common head section
    ?> 
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/topbar.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
        function getDepartmentName(val) {
            $.ajax({
                type : "POST",
                url : "getDepartment.php",
                data : {dept_name : val},
                success : function(data){
                    $('#emp_name').html(data);
                }
            });
        }
    </script>

</head>
<body>
    
    <?php 
        session_start();

        include '../php/config.php';

        $gender = $_SESSION['admin_gender'];
        $name = $_SESSION['admin_name'];

        $admin_sql = "SELECT admin_id FROM ADMIN_MANAGER WHERE admin_name = '$name'";
        $result_admin = $conn->query($admin_sql);
        
        while ($row = $result_admin->fetch_assoc()) {
            $admin_id = $row['admin_id'];
        }
        
        $dept = "SELECT dept_name FROM DEPARTMENT WHERE admin_id = $admin_id";
        $result_dept = $conn->query($dept);

        $department_names = array();

        if ($result_dept->num_rows > 0) {
            while ($row = $result_dept->fetch_assoc()) {
                $department_names[] = $row["dept_name"];
            }
        }


        ?>

    <div class="container">
        <!-- **** Navigation Bar **** -->
        <?php include 'adminSidebar.php' ?>
   
        <!-- Main Content-->
        <div class="main">

            <!--- ***** Topbar ****** -->
            <?php include 'adminTopbar.php' ?>

            <!--- ***** Add task ****** -->
            <section id="task">

                <!--- ***** Box ****** -->
                <div class="box">
                    <div class="title">
                        <p>Add Task</p>
                    </div>
                    <form action="../php/process.php" method="post" >
                        <p>
                            <label for="dept_name">Department Name :</label>
                            <select name="dept_name" id="dept_name" onchange="getDepartmentName(this.value);" required>
                                <option value="" disabled selected>---- Select Department ----</option>
                                <?php 
                                    foreach ($department_names as $dept_name) {
                                        echo "<option value='$dept_name'>$dept_name</option>";
                                    }
                                ?>
                            </select>
                        </p>

                        <p>
                            <label for="emp_name">Employee Name :</label>
                            <select name="emp_name" id="emp_name" required>
                                <option value="" disabled selected>---- Select Employee ----</option>
                            </select>
                        </p>

                        <p>
                            <label for="task_id">Task Id :</label>
                            <input type="text" name="task_id" id="task_id" required/>
                        </p>

                        <p>
                            <label for="task_name">Task Title :</label>
                            <input type="text" name="task_name" id="task_name" required/>
                        </p>

                        <p>
                            <label for="task_desc">Task Desc : </label>
                            <input type="text" name="task_desc" id="task_desc" required/>
                        </p>

                        <p>
                            <label for="task_priority">Task Priority :</label>
                            <select name="task_priority" id="task_priority" required>
                                <option value="">---- Select Task Priority ----</option>
                                <option value="Normal">Normal</option>
                                <option value="Medium">Medium</option>
                                <option value="Urgent">Urgent</option>
                                <option value="Most Urgent">Most Urgent</option>
                            </select>
                        </p>

                        <p>
                            <label for="end_date">End date :</label>
                            <input type="datetime-local" name="end_date" id="end_date" required />
                        </p>

                        <div class="submitBtn">
                            <button type="submit" name="addTask">Add</button>
                        </div>

                    </form>
                </div>
            </section>            

        </div>

    </div>

    <script src="../js/adminDashboard.js" type="text/javascript"></script> 

</body>

</html>