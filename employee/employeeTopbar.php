<?php 

    echo '<div class="topbar">
            <div class="toggle">
                <i class="fa-solid fa-bars"></i>
            </div>
            <div class="search">
                <label>
                    <input type="search" placeholder=" Search here... ">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </label>    
            </div>
            <!-- employee img -->
            <div class="profile">
                <div class="employee">
                    <img src="../images/'.$gender.'.png" alt="Employee">
                </div>
                <div class="employee_name">
                    <span>'.$name.'</span>
                </div>
            </div>
        </div>';
?>