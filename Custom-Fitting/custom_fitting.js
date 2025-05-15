"use strict";
window.addEventListener('load', init);

function init(){
  console.log("custom_fitting.js loaded, init() running");
  var form = document.getElementById('contact-information');
  if (!form) return;

  // 1) Hook your existing validation
  form.addEventListener("submit", validateForm);

  // Attach AJAX lookup on email blur
  var emailField = document.getElementById('email');
  if (emailField) {
    emailField.addEventListener('blur', function() {
      var email = this.value.trim();
      if (!email) return;

      new Ajax.Request(BASE_URL +'/Custom-Fitting/get_measurements.php', {
        method: 'post',
        parameters: { email: email },
        onSuccess: function(response) {
          var data;
          try {
            data = response.responseText.evalJSON();
          } catch (e) {
            console.error('Invalid JSON from get_by_email.php:', e);
            return;
          }
          autofillMeasurements(data, form);
        },
        onFailure: function() {
          console.warn('Email lookup failed.');
        }
      });
    });
  }
  
}


// Fill measurement fields from AJAX response
function autofillMeasurements(data, form) {
  ['chest', 'waist', 'neck', 'shoulder', 'arm', 'inseam', 'hips', 'rise', 'special_instructions'].forEach(function(key) {
    var fld = form.elements[key];
    if (fld && data[key] != null) {
      fld.value = data[key];
    }
  });
}




function validateForm(event) {
    var form   = document.getElementById("contact-information"),
    errors = [];


    var emailInput = form.elements["email"];
    if (emailInput) {
        var ev = emailInput.value.trim();
        if (
            ev === "" ||
            ev.length > 75 ||
            !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(ev)
        ) {
            errors.push("Please enter a valid email (max 75 chars).");
        }
    }


    // Numeric measurements > 0
    ['chest', 'waist', 'neck', 'shoulder', 'arm', 'inseam', 'hips', 'rise', 'special_instructions'].forEach(id => {
        const val = form.elements[id].value.trim();
        if (val) {
            const num = parseFloat(val);
            if (Number.isNaN(num) || num <= 0) {
                errors.push(`${id.charAt(0).toUpperCase() + id.slice(1)} must be a positive number.`);
            }
        }
    });

    const special = form.elements.special_instructions.value;
    if (special && special.length > 500) {
        errors.push("Special instructions must be 500 characters or fewer.");
    }

    if (errors.length) {
        event.preventDefault();
        alert(errors.join("\n"));
    }
}
