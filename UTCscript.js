"use strict";
window.addEventListener('load', init);

function init() {
    $("TEmail").addEventListener('blur', checkTailor);

    $("Ayes").addEventListener('blur', setAller);
    $("Ano").addEventListener('blur', setAller);

    $("Ryes").addEventListener('blur', setResize);
    $("Rno").addEventListener('blur', setResize);

    $("preD").addEventListener('blur', setOther);

    $("RSpyes").addEventListener('blur', setRsp);
    $("RSpno").addEventListener('blur', setRsp);

    $("Alname").addEventListener('blur', checkAlname);
    $("ODname").addEventListener('blur', checkODname);
    $("res").addEventListener('blur', checkRes);
    $("dSpec").addEventListener('blur', checkSpecInst);

    $("sub").addEventListener('click', checkAndSend);
}

var tailorEmailEl = $("TEmail");

var allergenYesEl = $("Ayes");
var allergenNoEl = $("Ano");
var allergenNameEl = $("Alname");
var allergenNAOpt = $("Aln");
var allergenMildOp = $("Almi");
var allergenModerateOp = $("Almo");
var allergenSevereOp = $("Alse");

var resizeYesEl = $("Ryes");
var resizeNoEl = $("Rno");
var resizeDimEl = $("preD");

var resizeDimNAOp = $("NAres");
var resizeChestOp = $("Cres");
var resizeWaistOp = $("Wres");
var resizeNeckOp = $("Nres");
var resizeShoulderOp = $("Sres");
var resizeArmOp = $("Ares");
var resizeInSeamOp = $("INres");
var resizeHipOp = $("Hres");
var resizeRiseOp = $("Rres");
var resizeDimOtOp = $("Othres");

var resizeOtherDimEl = $("ODname");
var resizeNumEl = $("res");
var resizeSpecYesEl = $("RSpyes");
var resizeSpecNoEl = $("RSpno");
var resizeSpecificEl = $("dSpec");

var errTailorNameEl = $("errTName");
var errAllergenEl = $("errAller");
var errOtherDimEl = $("errOdim");
var errResizeEl = $("errRes");
var errSpecialInstructionEl = $("errSpecInst");

function checkTailor() {
    var tailorEmailEl = $("TEmail");
    var errTailorEmailEl = $("errTEmail");
    var enteredTEmail = tailorEmailEl.value;
    if (enteredTEmail == "") {
        errTailorEmailEl.innerHTML = " Error : Empty Name ";
    } else {
        new Ajax.Request( "tailorEmailCheck.php" ,
        {
            method: "post",
            parameters: {TEmail:enteredTEmail},
            onSuccess: processEmail
        } );
    }
}

function processEmail(ajax) {
    var tailorEmailEl = $("TEmail");
    var errTailorEmailEl = $("TEmail");
    errTailorEmailEl.innerHTML = ajax.responseText;
    if (errTailorEmailEl.innerHTML == "No matching tailor email") {
        tailorEmailEl.value = "";
    }
}

function setAller() {
    var allergenYesEl = $("Ayes");
    var allergenNoEl = $("Ano");
    var allergenNameEl = $("Alname");
    var allergenNAOpt = $("Aln");
    var allergenMildOp = $("Almi");
    var allergenModerateOp = $("Almo");
    var allergenSevereOp = $("Alse");

    var ayesChecked = allergenYesEl.checked;
    var anoChecked = allergenNoEl.checked;

    if (ayesChecked) {
        allergenNameEl.value = "";
        allergenNameEl.disabled = false;
        allergenNAOpt.checked = false;
        allergenNAOpt.disabled = true;
        allergenMildOp.checked = true;
        allergenMildOp.disabled = false;
        allergenModerateOp.disabled = false;
        allergenSevereOp.disabled = false;
    } else if (anoChecked) {
        allergenNameEl.value = "N/A";
        allergenNameEl.disabled = true;
        allergenNAOpt.checked = true;
        allergenNAOpt.disabled = true;
        allergenMildOp.checked = false;
        allergenMildOp.disabled = true;
        allergenModerateOp.disabled = true;
        allergenSevereOp.disabled = true;
    }
}

function setResize() {
    var resizeYesEl = $("Ryes");
    var resizeNoEl = $("Rno");
    var resizeDimEl = $("preD");

    var resizeDimNAOp = $("NAres");
    var resizeChestOp = $("Cres");
    var resizeWaistOp = $("Wres");
    var resizeNeckOp = $("Nres");
    var resizeShoulderOp = $("Sres");
    var resizeArmOp = $("Ares");
    var resizeInSeamOp = $("INres");
    var resizeHipOp = $("Hres");
    var resizeRiseOp = $("Rres");
    var resizeDimOtOp = $("Othres");

    var resizeOtherDimEl = $("ODname");
    var resizeNumEl = $("res");
    var resizeSpecYesEl = $("RSpyes");
    var resizeSpecNoEl = $("RSpno");
    var resizeSpecificEl = $("dSpec");

    var ryesChecked = resizeYesEl.checked;
    var rnoChecked = resizeNoEl.checked;

    if (ryesChecked) {
        resizeDimEl.disabled = false;

        resizeChestOp.selected = true;
        resizeDimNAOp.disabled = true;

        resizeChestOp.disabled = false;
        resizeWaistOp.disabled = false;
        resizeNeckOp.disabled = false;
        resizeShoulderOp.disabled = false;
        resizeArmOp.disabled = false;
        resizeInSeamOp.disabled = false;
        resizeHipOp.disabled - false;
        resizeRiseOp.disabled = false;
        resizeDimOtOp.disabled = false; 

        resizeOtherDimEl.value = "N/A";
        resizeOtherDimEl.disabled = true;

        resizeNumEl.value="";
        resizeNumEl.disabled = false;

        resizeSpecYesEl.disabled = false;
        resizeSpecNoEl.disabled = false;
        resizeSpecificEl.value="N/A";
        resizeSpecificEl.disabled = true;

    } else if (rnoChecked) {
        resizeDimEl.disabled = true;

        resizeDimNAOp.selected = true;
        resizeDimNAOp.disabled = true;

        resizeChestOp.disabled = true;
        resizeWaistOp.disabled = true;
        resizeNeckOp.disabled = true;
        resizeShoulderOp.disabled = true;
        resizeArmOp.disabled = true;
        resizeInSeamOp.disabled = true;
        resizeHipOp.disabled - true;
        resizeRiseOp.disabled = true;
        resizeDimOtOp.disabled = true; 

        resizeOtherDimEl.value = "N/A";
        resizeOtherDimEl.disabled = true;

        resizeNumEl.value="N/A";
        resizeNumEl.disabled = true;

        resizeSpecYesEl.disabled = true;
        resizeSpecNoEl.disabled = true;
        resizeSpecificEl.value="N/A";
        resizeSpecificEl.disabled = true;
    }
}

function setOther() {
    var resizeDimOtOp = $("Othres");

    var resizeOtherDimEl = $("ODname");

    var otherDimSelected = resizeDimOtOp.selected;

    if (otherDimSelected) {
        resizeOtherDimEl.value = "";
        resizeOtherDimEl.disabled = false;
    } else {
        resizeOtherDimEl.value = "N/A";
        resizeOtherDimEl.disabled = true;
    }
}

function setRsp() {
    var resizeSpecYesEl = $("RSpyes");
    var resizeSpecNoEl = $("RSpno");
    var resizeSpecificEl = $("dSpec");

    var rspyesChecked = resizeSpecYesEl.checked;
    var rspnoChecked = resizeSpecNoEl.checked;

    if (rspyesChecked) {
        resizeSpecificEl.value = "";
        resizeSpecificEl.disabled = false;
    } else if (rspnoChecked) {
        resizeSpecificEl.value = "N/A";
        resizeSpecificEl.disabled = true;
    }
}

function checkAlname() {
    var allergenYesEl = $("Ayes");
    var allergenNameEl = $("Alname");

    var errAllergenEl = $("errAller");

    var ryesChecked = allergenYesEl.checked;
    if (ryesChecked) {
        if (allergenNameEl.value == "") {
            errAllergenEl.innerHTML = "Error : Value cannot be empty";
        } else {
            errAllergenEl.innerHTML = "";
        }
    }
}

function checkODname() {
    var resizeDimOtOp = $("Othres");

    var resizeOtherDimEl = $("ODname");

    var errOtherDimEl = $("errOdim");

    var otherDimSelected = resizeDimOtOp.selected;
    if (otherDimSelected) {
        if (resizeOtherDimEl.value == "") {
            errOtherDimEl.innerHTML = "Error : Value cannot be empty";
        } else {
            errOtherDimEl.innerHTML = "";
        }
    }
}

function checkRes() {
    var resizeNumEl = $("res");
    var resizeYesEl = $("Ryes");
    var errResizeEl = $("errRes");

    var ryesChecked = resizeYesEl.checked;
    if (ryesChecked) {
        if (resizeNumEl.value == "") {
            errResizeEl.innerHTML = "Error : Value cannot be empty";
        } else {
            errResizeEl.innerHTML = "";
        }
    }
}

function checkSpecInst() {
    var resizeSpecYesEl = $("RSpyes");

    var resizeSpecificEl = $("dSpec");

    var errSpecialInstructionEl = $("errSpecInst");

    var rspyesChecked = resizeSpecYesEl.checked;
    if (rspyesChecked) {
        if (resizeSpecificEl.value == "") {
            errSpecialInstructionEl.innerHTML = "Error : Value cannot be empty";
        } else {
            errSpecialInstructionEl.innerHTML = "";
        }
    }
}

function checkAndSend(event) {
    // Check if the tailor name field is empty, if so, then there is an error
    var tailorEmailEl = $("TEmail");
    var tailError;
    if (tailorEmailEl.value == "") {
        tailError = true;
    } else {
        tailError = false;
    }

    // Check if the "Yes" option is checked for allergens, and if so, if the name field is empty.
    // If both are true, then there is an error.
    var allergenYesEl = $("Ayes");
    var allergenNameEl = $("Alname");
    var yesACheck = allergenYesEl.checked;
    var empName; 
    var allerError;
    if (allergenNameEl.value == "") {
        empName = true;
    } else {
        empName = false;
    }
    if (yesACheck && empName) {
        allerError = true;
    } else {
        allerError = false;
    }

    // Check if the "Other" option is selected for resize dimenstion, and if so, if the dimension field is empty.
    // If both are true, then there is an error.
    var resizeDimOtOp = $("Othres");
    var resizeOtherDimEl = $("ODname");
    var othSelected = resizeDimOtOp.selected;
    var empDim; 
    var dimError;
    if (resizeOtherDimEl.value == "") {
        empDim = true;
    } else {
        empDim = false;
    }
    if (othSelected && empDim) {
        dimError = true;
    } else {
        dimError = false;
    }

    // Check if the "Yes" option is checked for resizing, and if so, if the resizing specification field is empty.
    // If both are true, then there is an error.
    var resizeYesEl = $("Ryes");
    var resize = $("res");
    var yesRCheck = resizeYesEl.checked;
    var empRes; 
    var resError;
    if (resize.value == "") {
        empRes = true;
    } else {
        empRes = false;
    }
    if (yesRCheck && empRes) {
        resError = true;
    } else {
        resError = false;
    }

    // Check if the "Yes" option is checked for resizing special instruction, and if so, if the specification field is empty.
    // If both are true, then there is an error.
    var resizeSpecYesEl = $("RSpyes");
    var resizeSpecificEl = $("dSpec");
    var yesRSpCheck = resizeSpecYesEl.checked;
    var empRsp; 
    var rspError;
    if (resizeSpecificEl.value == "") {
        empRsp = true;
    } else {
        empRsp = false;
    }
    if (yesRSpCheck && empRsp) {
        rspError = true;
    } else {
        rspError = false;
    }

    // Make sure there are no empty fields upon submission. If there are, then set an error text and prevent form submission.
    // If there are no errors, make sure all fields are enabled and submit.

    var anyErrors = (tailError || allerError || dimError || resError || rspError);
    if (anyErrors) {
        var submitErrEl = $("subErr");
        submitErrEl.innerHTML = "Error : One of your text fields is empty, make sure all fields have a value.";
        event.preventDefault();
    } else {
        var allergenNAOpt = $("Aln");
        var allergenMildOp = $("Almi");
        var allergenModerateOp = $("Almo");
        var allergenSevereOp = $("Alse");

        allergenNameEl.disabled = false;
        allergenNAOpt.disabled = false;
        allergenMildOp.disabled = false;
        allergenModerateOp.disabled = false;
        allergenSevereOp.disabled = false;

        var resizeDimEl = $("preD");
        var resizeDimNAOp = $("NAres");
        var resizeChestOp = $("Cres");
        var resizeWaistOp = $("Wres");
        var resizeNeckOp = $("Nres");
        var resizeShoulderOp = $("Sres");
        var resizeArmOp = $("Ares");
        var resizeInSeamOp = $("INres");
        var resizeHipOp = $("Hres");
        var resizeRiseOp = $("Rres");
        var resizeNumEl = $("res");
        var resizeSpecNoEl = $("RSpno");

        resizeDimEl.disabled = false;
        resizeDimNAOp.disabled = false;
        resizeChestOp.disabled = false;
        resizeWaistOp.disabled = false;
        resizeNeckOp.disabled = false;
        resizeShoulderOp.disabled = false;
        resizeArmOp.disabled = false;
        resizeInSeamOp.disabled = false;
        resizeHipOp.disabled - false;
        resizeRiseOp.disabled = false;
        resizeDimOtOp.disabled = false; 
        resizeOtherDimEl.disabled = false;
        resizeNumEl.disabled = false;
        resizeSpecYesEl.disabled = false;
        resizeSpecNoEl.disabled = false;
        resizeSpecificEl.disabled = false;
    }
}