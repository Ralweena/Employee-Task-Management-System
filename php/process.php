<?php
    session_start();

    include 'config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // ------- Admin Login --------

        if (isset($_POST['adminLogin'])) {

            $admin_email  = $_POST['email'];
            $adminPassword   = $_POST['pass'];

            if ( isset($admin_email, $adminPassword) ) {
                // Create connection
                if ($stmt = $conn->prepare(" SELECT admin_id, admin_name, admin_gender, admin_pass FROM ADMIN_MANAGER WHERE admin_email = ?")) {
                    
                    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    $stmt->bind_param('s', $admin_email);
                    $stmt->execute();
                    // Store the result so we can check if the account exists in the database.
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                                                
	                    $stmt->bind_result($admin_id, $admin_name, $admin_gender ,$admin_pass);
                        $stmt->fetch();
                        // Account exists, now we verify the password.
                        if (password_verify($adminPassword, $admin_pass)) {
                            // Verification success! User has logged-in!
                            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                            session_regenerate_id();
                            $_SESSION['admin_loggedin'] = TRUE;
                            $_SESSION['admin_email'] = $admin_email;
                            $_SESSION['admin_id'] = $admin_id;
                            $_SESSION['admin_name'] = $admin_name;
                            $_SESSION['admin_gender'] = $admin_gender;
                            echo "<script>alert('You\'ve Successfully Logged In!');
                                window.location.href = '../admin/adminDashboard.php'</script>";  //redirect to admin dashboard 
                        } else {
                            // Incorrect password
                            echo '<script>alert("Incorrect Password!")
                                window.location.href = "../adminLogin.php";</script>';
                        }
                    } else {
                        // Incorrect password
                        echo '<script>alert("Account does not exist!");
                            window.location.href = "../adminLogin.php";</script>';
                    }
                
                    $stmt->close();
                }
             }
            else {
                echo "<script>alert('Please fill out the details')</script>";
            }           
        } 

        // ------- Employee Login --------

        if (isset($_POST['employeeLogin'])) {

            $employee_email  = $_POST['email'];
            $employeePassword   = $_POST['pass'];

            if ( isset($employee_email, $employeePassword) ) {
                // Create connection
                if ($stmt = $conn->prepare(" SELECT emp_id, emp_pass FROM EMPLOYEE WHERE emp_email = ?")) {
                    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                    $stmt->bind_param('s', $employee_email);
                    $stmt->execute();
                    // Store the result so we can check if the account exists in the database.
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                                                
	                    $stmt->bind_result($employee_id, $employee_pass);
                        $stmt->fetch();
                        // Account exists, now we verify the password.
                        if (password_verify($employeePassword, $employee_pass)) {
                            // Verification success! User has logged-in!
                            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
                            session_regenerate_id();
                            $_SESSION['employee_loggedin'] = TRUE;
                            $_SESSION['employee_email'] = $employee_email;
                            $_SESSION['employee_id'] = $employee_id;
                            echo "<script>alert('You\'ve Successfully Logged In!');
                                window.location.href = '../employee/employeeDashboard.php';</script>";  //redirect to employee dashboard 
                        } else {
                            // Incorrect password
                            echo '<script>alert("Incorrect Password!")
                                window.location.href = "../employeeLogin.php";</script>';
                        }
                    } else {
                        // Incorrect password
                        echo '<script>alert("Account does not exist!");
                            window.location.href = "../employeeLogin.php";</script>';
                    }
                
                    $stmt->close();
                }
             }
            else {
                echo "<script>alert('Please fill out the details')</script>";
            }
        }

        // ------- Add Department --------

        if (isset($_POST['addDepartment'])) {

            $department_name = $_POST['dept_name'];
            $admin_name = $_POST['admin_name'];

            if ( isset($department_name, $admin_name) ) {

                $sql = "SELECT dept_id FROM DEPARTMENT WHERE dept_name = ".$department_name;
                $res = mysqli_query($conn,$sql);
                if ($res) {
                    echo "<script>alert('Department already exists!');
                        window.location.href = '../admin/addDepartment.php';</script>";
                }
                else {
                    // Retrieve the admin id
                    $admin = "SELECT admin_id FROM ADMIN_MANAGER WHERE admin_name = '$admin_name'";
                    $admin_res = $conn->query($admin);

                    if ($admin_res->num_rows > 0) {
                        $row = $admin_res->fetch_assoc();
                        $admin_id = $row["admin_id"];

                        $ins = "INSERT INTO DEPARTMENT (dept_name, admin_id) VALUES ('$department_name', '$admin_id')";
                        if ($conn->query($ins) === TRUE) {
                            echo "<script>alert('Department Added Successfully');
                            window.location.href='../admin/adminDepartment.php'</script>";
                        } 
                        else {
                            echo "<script>alert('Error While Inserting.');
                            window.location.href='../admin/addDepartment.php'</script>";
                        }
                    } 
                                                  
                }
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../admin/addDepartment.php'</script>";
            } 
        }

        // ------- Edit Department --------

        if (isset($_POST['editDepartment'])) {

            $new_dept_name = $_POST['new_dept_name'];
            $old_dept_name = $_POST['old_dept_name'];

            if ( isset($new_dept_name, $old_dept_name) ) {

                $dept = "SELECT dept_id FROM DEPARTMENT WHERE dept_name = '$old_dept_name'";
                $dept_res = $conn->query($dept);

                if ($dept_res->num_rows > 0) {
                    $row = $dept_res->fetch_assoc();
                    $dept_id = $row["dept_id"];

                    $sql_update = "UPDATE DEPARTMENT SET dept_name = '$new_dept_name' WHERE dept_id = $dept_id";
                    $update_res = $conn->query($sql_update);

                    if($update_res) {
                        echo "<script>alert('Department Updated Successfully');
                        window.location.href='../admin/adminDepartment.php'</script>";
                    } 
                    else {
                        echo "<script>alert('Department Name must be unique.');
                        window.location.href='../admin/adminDepartment.php'</script>";
                    }
                    
                }
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../admin/adminDepartment.php'</script>";
            } 
        }

        // ------- Add Employee --------
        if (isset($_POST['addEmployee'])) {

            $employee_name = $_POST['emp_name'];
            $employee_email  = $_POST['emp_email'];
            $employee_phone = $_POST['emp_phone'];
            $employee_gender = $_POST['emp_gender'];
            $employeePassword = $_POST['emp_pass'];
            $dept_name = $_POST['dept_name'];

            if ( isset($employee_name, $employee_email, $employee_phone, $employee_gender, $employeePassword, $dept_name) ) {

                $sql = "SELECT emp_id FROM EMPLOYEE WHERE emp_email = ".$employee_email;
                $res = mysqli_query($conn,$sql);
                if ($res) {
                    echo "<script>alert('Account already exists!');
                        window.location.href = '../admin/addEmployee.php';</script>";
                }
                else {
                    // Hash the password using password_hash
                    $hashed_password = password_hash($employeePassword, PASSWORD_BCRYPT);
                    // Retrieve the department id
                    $dept = "SELECT dept_id FROM DEPARTMENT WHERE dept_name = '$dept_name'";
                    $dept_res = $conn->query($dept);

                    if ($dept_res->num_rows > 0) {
                        $row = $dept_res->fetch_assoc();
                        $dept_id = $row["dept_id"];

                        $ins = "INSERT INTO EMPLOYEE (emp_name, emp_email, emp_phone, emp_gender, emp_pass, dept_id) VALUES ('$employee_name', '$employee_email', '$employee_phone', '$employee_gender', '$hashed_password', '$dept_id')";
                        if ($conn->query($ins) === TRUE) {
                            echo "<script>alert('Employee Added Successfully');
                            window.location.href='../admin/adminEmployee.php'</script>";
                        } 
                        else {
                            echo "<script>alert('Error While Inserting.');
                            window.location.href='../admin/addEmployee.php'</script>";
                        }
                    } 
                                                  
                }
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../admin/addEmployee.php'</script>";
            } 
        }

        // ------- Edit Employee --------
        if (isset($_POST['editEmployee'])) {

            $employee_name = $_POST['emp_name'];
            $employee_email  = $_POST['emp_email'];
            $employee_phone = $_POST['emp_phone'];
            $employee_gender = $_POST['emp_gender'];
            $dept_name = $_POST['dept_name'];
            $old_emp_email = $_POST['old_emp_email'];

            if ( isset($employee_name, $employee_email, $employee_phone, $employee_gender, $dept_name, $old_emp_email) ) {

                $dept = "SELECT dept_id FROM DEPARTMENT WHERE dept_name= '$dept_name'";
                $dept_res = $conn->query($dept);

                if ($dept_res->num_rows > 0) {
                    $row = $dept_res->fetch_assoc();
                    $dept_id = $row["dept_id"];

                    $emp_update = "UPDATE EMPLOYEE SET emp_name = '$employee_name', emp_phone = '$employee_phone', emp_gender = '$employee_gender' , emp_email = '$employee_email', dept_id = $dept_id WHERE emp_email = '$old_emp_email'";
                    $update_res = $conn->query($emp_update);
    
                    if($update_res) {
                        echo "<script>alert('Employee Updated Successfully');
                        window.location.href='../admin/adminEmployee.php'</script>";
                    } 
                    else {
                        echo "<script>alert('Error while Updating.');
                        window.location.href='../admin/adminEmployee.php'</script>";
                    }                        
                }               
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../admin/adminEmployee.php'</script>";
            } 
        }

        // ------- Add Task --------
        if (isset($_POST['addTask'])) {

            $employee_name = $_POST['emp_name'];
            $department_name = $_POST['dept_name'];
            $task_id =$_POST['task_id'];
            $task_name = $_POST['task_name'];
            $task_desc  = $_POST['task_desc'];
            $task_priority = $_POST['task_priority'];
            $end_date = $_POST['end_date'];

            if ( isset($employee_name, $department_name, $task_name, $task_priority, $end_date, $task_id) ) {

                $emp = "SELECT emp_id FROM EMPLOYEE WHERE emp_name = '$employee_name'";
                $emp_res = $conn->query($emp);
                $emp_row = $emp_res->fetch_assoc();
                $emp_id = $emp_row['emp_id'];

                $ins_task = "INSERT INTO TASK (task_id, task_title, task_desc, task_priority, endDate) VALUES ('$task_id','$task_name', '$task_desc', '$task_priority', '$end_date')";
                $ins_task_status = "INSERT INTO TASK_STATUS (task_id, emp_id) VALUES ('$task_id','$emp_id')";
                if ($conn->query($ins_task) === TRUE && $conn->query($ins_task_status) === TRUE) {
                    echo "<script>alert('Task Added Successfully');
                    window.location.href='../admin/adminTask.php'</script>";
                } 
                else {
                    echo "<script>alert('Error While Inserting.');
                    window.location.href='../admin/adminTask.php'</script>";
                }                
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../admin/adminTask.php'</script>";
            } 
        }

        
        // ------- Update Task --------
        if (isset($_POST['updateTask'])) {

            $updated_info = $_POST['updated_info'];
            $updated_date = $_POST['updated_date'];
            $percentage = $_POST['percentage'];
            $task_status = $_POST['task_status'];
            $task_id = $_POST['task_id'];

            if ( isset($updated_info, $updated_date, $percentage, $task_status) ) {

                $update_sql = "UPDATE TASK_STATUS SET task_status = '$task_status', task_percentage = $percentage, updated_info = '$updated_info', updated_date = '$updated_date' WHERE task_id = '$task_id'";
                if ($conn->query($update_sql)) {
                    echo "<script>alert('Task Updated Successfully');
                    window.location.href='../employee/viewTasks.php'</script>";
                } 
                else {
                    echo "<script>alert('Error While Updating.');
                    window.location.href='../employee/viewTasks.php'</script>";
                }                
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../employee/viewTasks.php'</script>";
            } 
        }

        // -------- Edit Password --------
        if (isset($_POST['editPassword'])) {

            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $emp_id = $_POST["emp_id"];

            if ( isset($old_password, $new_password, $emp_id) ) {
                
                $sql = "SELECT emp_pass FROM EMPLOYEE WHERE emp_id = $emp_id";
                $result = $conn->query($sql);
        
                if ($result->num_rows >= 0) {
                    $row = $result->fetch_assoc();
                    $old_pass = $row['emp_pass'];

                    if(password_verify($old_password,$old_pass)) {
                        $hashedPass = password_hash($new_password, PASSWORD_BCRYPT);

                        $update_sql = "UPDATE EMPLOYEE SET emp_pass = '$hashedPass' WHERE emp_id = $emp_id";
                        if ($conn->query($update_sql)) {
                            echo "<script>alert('Password Updated Successfully');
                            window.location.href='../employee/employeeDashboard.php'</script>";
                        } 
                        else {
                            echo "<script>alert('Error While Updating.');
                            window.location.href='../employee/editPassword.php'</script>";
                        }  
                    }
                    else {
                        echo "<script>alert('Password Mismatch');
                        window.location.href='../employee/editPassword.php'</script>";
                    } 
                }              
            }
            else {
                echo "<script>alert('Fill out all details');
                window.location.href='../employee/editPassword.php'</script>";
            } 
        }

    }   

?>