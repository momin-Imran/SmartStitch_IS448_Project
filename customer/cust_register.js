// Author:          Adams Ubini
// Description:     JS validation for customer registration form

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");

    form.addEventListener("submit", function (event) {
        const firstName = document.getElementById("first_name").value.trim();
        const lastName = document.getElementById("last_name").value.trim();
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();
        const confirmPassword = document.getElementById("confirm_password").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const title = document.getElementById("title").value.trim();

        let errors = [];

        if (!firstName || !lastName || !email || !password || !confirmPassword || !phone || !title) {
            errors.push("All fields are required.");
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.push("Please enter a valid email address.");
        }

        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test(phone)) {
            errors.push("Phone number must be 10 digits long.");
        }

        if (password !== confirmPassword) {
            errors.push("Passwords do not match.");
        }

        if (password.length < 8) {
            errors.push("Password must be at least 8 characters long.");
        }

        passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
        if (!passwordPattern.test(password)) {
            errors.push("Password must contain at least one uppercase letter, one lowercase letter, and one number.");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }

    });
        
});