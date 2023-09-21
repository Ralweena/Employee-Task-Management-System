function validateRegistrationForm() {
    var name = document.forms["registration-form"]["emp_name"].value;
    var Dname = document.forms["registration-form"]["dept_name"].value;
    var phone = document.forms["registration-form"]["emp_phone"].value; 
    var email = document.forms["registration-form"]["emp_email"].value;
    var password = document.forms["registration-form"]["emp_pass"].value;
    var cpassword = document.forms["registration-form"]["emp_c_pass"].value;
    var gender = document.forms["registration-form"]["emp_gender"].value;

    if (name === "" || email === "" || password === "" || phone === "" || gender === "") {
        alert("All fields are required.");
        return false;
    }
    
    // Name validation
    var nameRegex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
    if (!name.match(nameRegex) || !Dname.match(nameRegex)) {
        alert("Must contain a valid name.");
        return false;
    }

    // Email validation
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailRegex)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Phone number validation
    var phoneRegex = /^\d{10}$/;
    if (!phone.match(phoneRegex)) {
        alert("Phone No. must contain 10 digits.");
        return false;
    }

    // Password validation
    var passwordRegex = /^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[!@#$%^&*()])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    if (!password.match(passwordRegex)) {
        alert("Password must contain at least 1 small letter, 1 capital letter, 1 number, 1 special case character and must have minimun 8 characters.");
        return false;
    }

    if(password != cpassword) {
        alert("Incorrect Confirm Password!")
    }

    return true;
}