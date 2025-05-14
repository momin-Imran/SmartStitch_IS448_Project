"use strict"

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const messageBox = document.createElement("p");
    form.parentNode.insertBefore(messageBox, form); // inseert message above form 

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // prevent default form submission

        const formData = new FormData(form);

        fetch("updateAvailability.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error("Network respnse was not ok");
            return response.text(); 
        })
        .then(data => {
            messageBox.textContent = "Availability succesffully updated!";
            messageBox.style.color = "green";
        })
        .catch(error => {
            messageBox.textContent = "Error updating availability.";
            messageBox.style.color = "red";
            console.error("fetch error:", error);
        });
    });
});