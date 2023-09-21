function editEmployee(emp_email) {
    document.cookie = "emp_email = "+emp_email;
    window.location.href = "editEmployee.php";  

}

function deleteEmployee(val) {
    var confirmDelete = confirm("Are you sure you want to delete this employee?");
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "deleteEmployee.php", 
            data: {emp_email : val },
            success: function(response) {
                alert("Employee Deleted Succcessfully");
                location.reload();
            },
            error: function(error) {
                alert("Error while deleting");
            }
        });
    }
}