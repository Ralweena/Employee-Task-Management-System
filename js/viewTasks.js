const currentDate = new Date();
currentDate.setTime(currentDate.getTime() + (5.5 * 60 * 60 * 1000)); 
let currentDateTime = currentDate.toISOString().slice(0, 16);
document.getElementById("updated_date").value = currentDateTime;

function updateTasks() {
    const closePopupBtn = document.getElementById("closePopupBtn");
    const popup = document.getElementById("update_popup");

    popup.style.display = "block";

    closePopupBtn.addEventListener("click", function () {
        popup.style.display = "none";
    });
}

function calculateValue() {
    const percentageInput = document.getElementById('percentage');
    const resultInput = document.getElementById('task_status');
    const percentage = parseFloat(percentageInput.value);
    
    if (isNaN(percentage)) {
        alert('Please enter a valid percentage');
    } else if (percentage == 0) {
        resultInput.value = "Not Started";
    } else if (percentage >= 1 && percentage <= 99) {
        resultInput.value = 'In Progress';
    } else if (percentage === 100) {
        resultInput.value = "Completed";
    } else {
        resultInput.value = "Completed";
    }
}
