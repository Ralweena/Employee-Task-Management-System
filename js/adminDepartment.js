function editDepartment(dName) {
    document.cookie = "dept_name = "+dName;
    window.location.href = "editDepartment.php";  

}
 
function deleteDepartment(val) {
    var confirmDelete = confirm("Are you sure you want to delete this department?");
    if (confirmDelete) {
        $.ajax({
            type: "POST",
            url: "deleteDepartment.php", 
            data: {dept_name : val },
            success: function(response) {
                alert("Department Deleted Succcessfully");
                location.reload();
            },
            error: function(error) {
                alert("Error while deleting");
            }
        });
    }
}