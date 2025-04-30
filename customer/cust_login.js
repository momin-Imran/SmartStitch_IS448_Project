// Author:          Adams Ubini
// Description:     JS validation for customer login form

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");

    form.addEventListener("submit", function (event) {
        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password_login").value.trim();


        let errors = [];

        if (!email || !password) {
            errors.push("Both fields are required.");
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errors.push("Please enter a valid email address.");
        }

        if (password.length < 8) {
            errors.push("Password must be at least 8 characters long.");
        }

        passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
        if (!passwordPattern.test(password)) {
            errors.push("Invalid password");
        }

        if (errors.length > 0) {
            event.preventDefault();
            alert(errors.join("\n"));
        }

    });
        
});