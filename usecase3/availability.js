/**
 * availability.js
 * ---------------
 * Author: Nathan Rakhamimov
 * 
 * This script handles asynchronous form submission for a tailor's availability update.
 * It listens for the form's submit event, prevents the default page reload,
 * and sends the form data via `fetch()` to `updateAvailability.php`.
 * Success or error messages are displayed dynamically above the form without refreshing the page.
 * 
 * Expected to be used on tailorAvailability.php.
 */

"use strict";

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form"); // Select the availability form

    // Create a message box element for feedback (success/error)
    const messageBox = document.createElement("p");
    form.parentNode.insertBefore(messageBox, form); // Insert message box above the form

    // Handle form submission
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent full page reload on form submission

        const formData = new FormData(form); // Capture form input as key-value pairs

        // Send form data to server via POST using fetch API
        fetch("updateAvailability.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Network response was not ok");
            return response.text(); // Parse the server response
        })
        .then(data => {
            // Display success message
            messageBox.textContent = "Availability successfully updated!";
            messageBox.style.color = "green";
        })
        .catch(error => {
            // Display error message and log to console
            messageBox.textContent = "Error updating availability.";
            messageBox.style.color = "red";
            console.error("Fetch error:", error);
        });
    });
});
