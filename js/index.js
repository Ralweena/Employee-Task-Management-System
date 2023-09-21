const menuIcon = document.getElementById('menuIcon');
const navLinks = document.getElementById('navLinks');

menuIcon.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    const scrollY = window.scrollY;

    if (scrollY > 100) { // You can adjust the scroll threshold as needed
        navbar.classList.add('fixed');
    } else {
        navbar.classList.remove('fixed');
    }
});

// Function to add an 'active' class to the clicked link
function setActiveLink() {
    const links = document.querySelectorAll("nav a");
    links.forEach((link) => {
        link.addEventListener("click", function () {
            links.forEach((l) => l.classList.remove("active"));
            this.classList.add("active");
        });
    });
}

// Function to add an 'active' class when a section is in the viewport
function setActiveSection() {
    const sections = document.querySelectorAll("section");
    window.addEventListener("scroll", () => {
        sections.forEach((section) => {
            const top = section.getBoundingClientRect().top;
            if (top >= 0 && top <= 100) {
                const id = section.getAttribute("id");
                const link = document.querySelector(`nav a[href="#${id}"]`);
                document.querySelectorAll("nav a").forEach((l) => l.classList.remove("active"));
                link.classList.add("active");
            }
        });
    });
}

// Initialize the functions
setActiveLink();
setActiveSection();

// Animated Counter for counts Section
let counts = [0, 0, 0, 0];
let targetCounts = [220, 450, 1463, 40]; // Change these to your desired final counts
let increments = [2, 4, 10, 1]; // Change these to the amounts to increment by

function updateCounter(counterIndex) {
    const counterElement = document.getElementById(`counter${counterIndex}`);
    counterElement.textContent = counts[counterIndex - 1];
    
    if (counts[counterIndex - 1] < targetCounts[counterIndex - 1]) {
        counts[counterIndex - 1] += increments[counterIndex - 1];
        requestAnimationFrame(() => updateCounter(counterIndex));
    } else {
        counts[counterIndex - 1] = targetCounts[counterIndex - 1]; // Ensure the final count is exact
    }
}

// Start counting for each counter on page load
window.onload = () => {
    for (let i = 1; i <= 4; i++) {
        updateCounter(i);
    }
};

// Redirecting to Login Page
function redirectToPage(url) {
    window.location.href = url;
}

// Contact Us Form
document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contact-form");
    const responseDiv = document.getElementById("response");
    const submitBtn = document.getElementById("submit-btn");

    contactForm.addEventListener("submit", function (e) {
        e.preventDefault();
         
        // Disable the submit button while processing
        submitBtn.disabled = true;

        // You can add more client-side validation here if needed
        const formData = new FormData(contactForm);

        // Submit the form data to the server (contact.php)
        fetch(contactForm.action, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            // Handle the response from the server (e.g., show a success message)
            if(data.success) {
                contactForm.reset();
                responseDiv.textContent = "Message sent successfully!";
            } else {
                alert("Message failed to send. Please try again later.");
            }
        })
        .catch((error) => {
            // Handle any errors that occur during the fetch request
            console.error("Error:", error);
            responseDiv.textContent = "An error occurred.";
        })
        .finally(() => {
            // Re-enable the submit button
            submitBtn.disabled = false;
        });
    });
});

