"use strict";
window.addEventListener('load', init);

function init(){
  console.log("custom_fitting.js loaded, init() running");
  var form = document.getElementById('contact-information');
  if (!form) return;

  // 1) Hook your existing validation
  form.addEventListener("submit", validateForm);

  // 2) Bolt on Prototype AJAX to fetch saved data
  new Ajax.Request('get_measurements.php', {
    method: 'get',
    onSuccess: function(response) {
      var data;
      //error catch block for parsing
      try {
        data = response.responseText.evalJSON();
      } catch(e) {
        console.error('Could not parse JSON from get_measurements.php:', e);
        return;
      }
      // autofill each field if it exists
      Object.keys(data).forEach(function(key){
        var fld = form.elements[key];
        if (fld != null) fld.value = data[key];
      });
    },
    onFailure: function() {
      console.warn('Failed to fetch measurements (not logged in or server error).');
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
    ["chest", "waist", "hips", "rise"].forEach(id => {
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
