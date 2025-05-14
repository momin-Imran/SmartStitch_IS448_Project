// Author: Adams Ubini
// Description: AJAX email availability checker using Prototype.js

"use strict";
document.observe("dom:loaded", function () {
    // Watch for changes to the email input field
    $("email").observe("input", function () {
        const email = $F("email").strip();

        // Skip very short inputs
        if (email.length < 5) {
            $("email-status").update("").hide();
            return;
        }

        // Make an AJAX POST request to checkEmail.php
        new Ajax.Request(BASE_URL +"/customer/check_email.php", {
            method: "post",
            parameters: { email: email },
            onSuccess: function (response) {
                const result = response.responseText.evalJSON();

                if (result.exists) {
                    $("email-status")
                        .update("Email already in use")
                        .setStyle({ color: "red" })
                        .show();
                } else {
                    $("email-status")
                        .update("Available")
                        .setStyle({ color: "green" })
                        .show();
                }
            },
            onFailure: function () {
                $("email-status")
                    .update("Error checking email")
                    .setStyle({ color: "orange" })
                    .show();
            }
        });

    });
})