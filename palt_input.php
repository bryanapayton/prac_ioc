<?php
	include('dbconnect.php');
	include('index.php');


//Get column names from specified table
	$result = db_query("select template_name from milestones_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    		exit;
}

	if( $_GET['status'] == 'success'):
		echo "<script>
		alert('PALT record was successfully saved');
		window.location.href='palt_input.php';
		</script>";
	endif;
	if( $_GET['status'] == 'unsuccessful'):
		echo "<script>
		alert('That PALT record already exists in the database');
		window.location.href='palt_input.php';
		</script>";
	endif;
?>


<html>
<head>
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/3.3.7-js-bootstrap.min.js"></script>
  <script type="text/javascript" src="jonthornton-jquery-timepicker-3e0b283/jquery.timepicker.min.js"></script>
  <script type="text/javascript" src="add_task.js"></script>
      
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CFO - Palt</title>
   
    <link rel="stylesheet" href="css/1.12.1-jquery-ui.css">
    <link rel="stylesheet" href="jonthornton-jquery-timepicker-3e0b283/jquery.timepicker.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/1.12.1-jquery-ui.js"></script>
    <script type="text/javascript" src="js/palt-functions.js"></script>
  
  <script>


 

	$(document).on('keyup', "input[id^='actualDuration']",function (){  updateDate(); });
	$(document).on('keyup', "input[id='contract_number']",function (){$('div#continue').show(); $('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='apr_number']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='contract_specialist']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='tech_poc']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='cor']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='est_action_value']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='spend_plan_id']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='purpose']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='modification']",function (){$('div#milestonesTable').hide();});
	$(document).on('keyup', "input[id='spend_plan_id']",function (){$('div#milestonesTable').hide();});

	$(document).ready(function(){
    	$("input[id^='actualDuration']").keyup(function(){  updateDate(); }); 
    	
    	var success = $( "#dialog-save, #dialog-update" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });	
    
});

function saveMessage(){
success = $( "#dialog-save" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    
    success.dialog("open");
}

function updateMessage(){
success = $( "#dialog-update" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    success.dialog("open");
}

  

	function DisplayMilestones() {
		var contract_number = document.getElementById("contract_number").value;
		var apr_number = document.getElementById("apr_number").value;
		var contract_specialist = document.getElementById("contract_specialist").value;
		var tech_poc = document.getElementById("tech_poc").value;
		var cor = document.getElementById("cor").value;
		var kind_of_action = document.getElementById("kind_of_action").value;
   		var est_action_value = document.getElementById("est_action_value").value;
   		var spend_plan_id = document.getElementById("spend_plan_id").value;
   		var purpose = document.getElementById("purpose").value;
		var modification = document.getElementById("modification").value;
		var contract_type = document.getElementById("contract_type").value;
		var diaOrg = document.getElementById("diaOrg").value;
		var contractOfficer = document.getElementById("contractOfficer").value;
		var ext_competed = document.getElementById("ext_competed").value;
		var fund_type = document.getElementById("fund_type").value;
		var the_date = document.getElementById("from").value;
		var contractFormat = /[Hh]{2}[Mm]402-\d{2}-[Rr]|[Qq]-\d{4}|[Hh]{2}[Mm]402-\d{2}-[a-zA-Z0-9]-\d{4}/;
		var re=/[0-9]{4}\/(0[1-9]\/|1[0-2])/;
                var aprFormat = /\d{3}-\d{4}-\d{2}-[a-zA-Z0-9]/;
					if (!contractFormat.test(contract_number)){
					document.getElementById("contract_number").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (!aprFormat.test(apr_number)){
					document.getElementById("apr_number").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (contract_specialist==""){
					document.getElementById("contract_specialist").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (tech_poc==""){
					document.getElementById("tech_poc").focus();
						$('div#milestonesTable').hide();
					}else if (cor==""){
					document.getElementById("cor").focus();	
						$('div#milestonesTable').hide();
						return false;
					}else if (kind_of_action=="select action"){
					document.getElementById("kind_of_action").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (est_action_value=="" || isNaN(est_action_value)){
					document.getElementById("est_action_value").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (spend_plan_id==""){
					document.getElementById("spend_plan_id").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (modification==""){
					document.getElementById("modification").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (contract_type=="select action"){
					document.getElementById("contract_type").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (diaOrg=="select action"){
					document.getElementById("diaOrg").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (contractOfficer==""){
					document.getElementById("contractOfficer").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (ext_competed=="select action"){
					document.getElementById("ext_competed").focus();
						$('div#milestonesTable').hide();
						return false;
					}else if (fund_type=="select action"){
					document.getElementById("fund_type").focus();
						$('div#milestonesTable').hide();
						return false;
					}else {
						$('div#milestonesTable').show();
				}
   	 }
     
//*******************************************************************
// Add the novalidate attribute when the JS loads

	var forms = document.querySelectorAll('.validate');
	for (var i = 0; i < forms.length; i++) {
    	forms[i].setAttribute('novalidate', true);
}


// Validate the field
	var hasError = function (field) {

// Don't validate submits, buttons, file and reset inputs, and disabled fields
	if (field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button') return;

// Get validity
	var validity = field.validity;

// If valid, return null
	if (validity.valid) return;

// If field is required and empty
	if (validity.valueMissing) return 'Please fill out this field.';

// If not the right type
	if (validity.typeMismatch) {

// Email
  if (field.type === 'email') return 'Please enter an email address.';

//URL
  if (field.type === 'url') return 'Please enter a URL.';
    }

//If too short
  if (validity.tooShort) return 'Please lengthen this text to ' + field.getAttribute('minLength') + ' characters or more. You are currently using ' + field.value.length + ' characters.';

//If too long
  if (validity.tooLong) return 'Please shorten this text to no more than ' + field.getAttribute('maxLength') + ' characters. You are currently using ' + field.value.length + ' characters.';

//If number input isn't a number
  if (validity.badInput) return 'Please enter a number.';

//If a number value doesn't match the step interval
	if (validity.stepMismatch) return 'Please select a valid value.';

//If a number field is over the max
	if (validity.rangeOverflow) return 'Please select a value that is no more than ' + field.getAttribute('max') + '.';

//If a number field is below the min
	if (validity.rangeUnderflow) return 'Please select a value that is no less than ' + field.getAttribute('min') + '.';

//If pattern doesn't match
	if (validity.patternMismatch) {

//If pattern info is included, return custom error
	if (field.hasAttribute('title')) return field.getAttribute('title');

// Otherwise, generic error
  return 'Please match the requested format.';
    }

//If all else fails, return a generic catchall error
  return 'The value you entered for this field is invalid.';

};

// Show an error message
	var showError = function (field, error) {

// Add error class to field
    	field.classList.add('error');

// If the field is a radio button and part of a group, error all and get the last item in the group
    	if (field.type === 'radio' && field.name) {
        	var group = document.getElementsByName(field.name);
        if (group.length > 0) {
		for (var i = 0; i < group.length; i++) {
// Only check fields in current form
        if (group[i].form !== field.form) continue;
        group[i].classList.add('error');
            }
	field = group[group.length - 1];
        }
    }

// Get field id or name
	var id = field.id || field.name;
	if (!id) return;

// Check if error message field already exists
// If not, create one
	var message = field.form.querySelector('.error-message#error-for-' + id );
	if (!message) {
        	message = document.createElement('div');
        message.className = 'error-message';
        message.id = 'error-for-' + id;
        
// If the field is a radio button or checkbox, insert error after the label
	var label;
	if (field.type === 'radio' || field.type ==='checkbox') {
		label = field.form.querySelector('label[for="' + id + '"]') || field.parentNode;
  if (label) {
		label.parentNode.insertBefore( message, label.nextSibling );
            }
        }

// Otherwise, insert it after the field
  if (!label) {
    field.parentNode.insertBefore( message, field.nextSibling );
        }

    }
    
// Add ARIA role to the field
	field.setAttribute('aria-describedby', 'error-for-' + id);

// Update error message
	message.innerHTML = error;

// Show error message
	message.style.display = 'block';
	message.style.visibility = 'visible';

};


// Remove the error message
	var removeError = function (field) {

// Remove error class to field
	field.classList.remove('error');
    
// Remove ARIA role from the field
	field.removeAttribute('aria-describedby');

// If the field is a radio button and part of a group, remove error from all and get the last item in the group
  if (field.type === 'radio' && field.name) {
    var group = document.getElementsByName(field.name);
  if (group.length > 0) {
		for (var i = 0; i < group.length; i++) {
// Only check fields in current form
	if (group[i].form !== field.form) continue;
	group[i].classList.remove('error');
            }
  field = group[group.length - 1];
        }
    }

// Get field id or name
	var id = field.id || field.name;
	if (!id) return;
    

// Check if an error message is in the DOM
	var message = field.form.querySelector('.error-message#error-for-' + id + '');
	if (!message) return;

// If so, hide it
	message.innerHTML = '';
	message.style.display = 'none';
	message.style.visibility = 'hidden';

};


// Listen to all blur events
	document.addEventListener('blur', function (event) {

// Only run if the field is in a form to be validated
	if (!event.target.form.classList.contains('validate')) return;

// Validate the field
	var error = hasError(event.target);
  
// If there's an error, show it
	if (error) {
    showError(event.target, error);
  return;
    }

// Otherwise, remove any existing error message
	removeError(event.target);

}, true);


function exportMe(){

            var column=  $(this).attr("name");
            var id = $(this).attr("id");
            var value = this.innerHTML;
            var paramsToSend = {};
            var paramsToSend = $("#paltForm").find("input, select").serializeArray();
           paramsToSend[paramsToSend.length] = {name: "action", value: "Export to PDF"};
           $.ajax({
                                url: "mod_palt_query.php",
                                type: "POST",
                                data: { params: JSON.stringify(paramsToSend)},
                                success: function(data){
                                        if(data.status == 'success'){
                                         saveMessage();
                                          }else if(data.status == 'update'){
                                                     updateMessage();
                                                 }
                                        }
                                 });//success function

        }



	function saveMe(){
	
            var column=  $(this).attr("name");
            var id = $(this).attr("id");
            var value = this.innerHTML;
            var paramsToSend = {};
            var paramsToSend = $("#paltForm").find("input, select").not('[name^="tempDate"]').not('[name^="hithere"]').not('[name="totalActualDuration"]').not('[name="action"]').serializeArray();
           paramsToSend[paramsToSend.length] = {name: "action", value: "save"};
           $.ajax({
				url: "savePalt.php",
				type: "POST",
				data: { params: JSON.stringify(paramsToSend)},
				success: function(data){
					if(data.status == 'success'){
       					 saveMessage();
  					  }else if(data.status == 'update'){
   						     updateMessage();
   						 }
					}   
		  		 });//success function
              
        }
//*******************************************************************
/*onclick task will be added but not submitted.
Values are stored in an array and sent via POST*/

 	 $("#theForm").submit({url: 'ajax.php', type: 'post'})
 	 
	function toggleModification() {
		$('div#milestonesTable').hide();
		var mod = document.getElementById("modification");
		var kindOfAction = document.getElementById("kind_of_action");
		if (kindOfAction.options[kindOfAction.selectedIndex].value == "Modification") {
			mod.readOnly = false;
			mod.value = "";
			mod.required = true;
		} else {
			mod.required = false;
			mod.focus();
			mod.value = "N/A";
			mod.blur();
			mod.readOnly = true;
		}		
  	}
</script>
<style>
<?php

include ('css/style.css');

?>


</style>
</head>
<body>
<span id="error-message">Invalid Input</span>
<div id="wrapper">


	<div class="palt_input" style="display:block">
	<div class="form-style-2-heading">Generate PALT</div>

<div id="dialog-save" title="PALT Message">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    PALT Saved
  </p>

</div>

<div id="dialog-update" title="PALT Message">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    PALT Updated
  </p>

</div>

	<form id="paltForm" class="validate" method="post">

	<div class="form-style-2">
	<div class="sub-entry">
		<label for="contract_number"><span>Solicitation/Contract Number<span class="required">*</span></span><input id="contract_number" type="text" required pattern="([Hh]{2}[Mm]402-\d{2}-[Rr]|[Qq]-\d{4}|[Hh]{2}[Mm]402-\d{2}-[a-zA-Z0-9]-\d{4})" class="input-field" name="contract_number" title="Format: HHM402-NN-R or Q-NNNN or HHM402-NN-A-NNNN" onBlur="javascript:{this.value = this.value.toUpperCase();}"/></label>
		<label for="apr_number"><span>APR Number<span class="required">*</span></span><input id="apr_number" type="text" class="input-field" name="apr_number" required pattern="\d{3}-\d{4}-\d{2}-[a-zA-Z0-9]" title="Format: NNN-NNNN-NN-A" onBlur="javascript:{this.value = this.value.toUpperCase();}"/></label>
	        <label for="startDate"><span>PoP Start Date<span class="required">*</span></span><input type="text" id="from" class="input-field" name="the_date" required readonly title="Please select a date from the calendar widget"/></label>
	        <label for="pop"><span>PoP End Date<span class="required">*</span></span><input type="text" id="pop" class="input-field" name="pop_date" required readonly/></label>
	</div>

	<div class="sub-entry">
<?php
		$result = db_query("select * from action_table");
		if (!$result) {
    			echo 'Could not run query: ' . db_error();
    		exit;
}
?>
        	<label for="kind_of_action"><span>Kind of Action<span class="required">*</span></span><select id="kind_of_action" name="kind_of_action" class="select-field" onChange="toggleModification();">
        	<option value="select action" disabled selected>Select Kind of Action</option>
<?php
        	if (db_num_rows($result) > 0) {
    			while ($row = db_fetch_array($result)) {    
			echo "<option name=\"".$row[1]."\" value=\"".$row[1]."\">".$row[1]."</option>";
}}	
			echo "</select></label>";
?>
		<label for="modification"><span>Modification</span><input id="modification" type="text" class="input-field" name="modification" readonly value="N/A"/></label>
		<label for="purpose"><span>Purpose</span><input id="purpose" type="text" class="input-field" name="purpose"/></label>
<?php
	$result = db_query("select * from contract_type_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"contract_type\"><span>Type of Contract<span class=\"required\">*</span></span><select id=\"contract_type\" name=\"contract_type\" onchange=\"getMilestoneTemplate(this.value);\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select Type of Contract</option>";
        if (db_num_rows($result) > 0) {
  		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[1]."</option>";
}}
echo "</select>";
?>
	</label>
	<span></span><span></span><span></span>

	</div>


	<div class="sub-entry">

<?php
	$result = db_query("select * from extent_competed_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"ext_competed\"><span>Extent Competed<span class=\"required\">*</span></span><select id=\"ext_competed\" name=\"extent_competed\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select Extent Competed</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[1]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
	<label for="spend_plan"><span>Spend Plan ID<span class="required">*</span></span><input id="spend_plan_id" type="text" class="input-field" name="spend_plan_id" required /></label>

<?php
	$result = db_query("select * from fund_type_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"fund_type\"><span>Fund Type<span class=\"required\">*</span></span><select id=\"fund_type\" name=\"fund_type\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select Fund Type</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[1]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
	<label for="action_value"><span>Estimated Action Value ($)<span class="required">*</span></span><input id="est_action_value" type="text" class="input-field" name="est_action_value" title="Enter number" pattern="\d+" required/></label>


	</div>


	<div class="sub-entry">
	        <label for="contractOfficer"><span>Contracting Officer<span class="required">*</span></span><input id="contractOfficer" type="text" class="input-field" name="contracting_officer" required/></label>
		<label for="contract_specialist"><span>Contract Specialist<span class="required">*</span></span><input id="contract_specialist" type="text" class="input-field" name="contract_specialist" required /></label>
		<label for="cor"><span>COR/Requisitioner<span class="required">*</span><span></span></span><input id="cor" type="text" class="input-field" name="cor" required /></label>

<?php
	$result = db_query("select * from org_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"diaOrg\"><span>DIA Directorate/Division<span class=\"required\">*</span></span><select id=\"diaOrg\" name=\"dia_org\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select DIA Directorate/Division</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[2]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
        <label for="tech_poc"><span>Technical POC<span class="required">*</span></span><input id="tech_poc" type="text" class="input-field" name="tech_poc" required/></label>

	</div>
	</div>

	<div id="continue" class="form-style-3">
	<input type="button" class="button" value =" Continue " onclick="DisplayMilestones();"/>
	<a href="index.php"><input class="button" type="button" value=" Cancel "/></a>
	</div>

	<div id="milestonesTable" style="display:none">
	<div class="form-style-3">
	<fieldset>
	<legend>Major Milestones</legend>

	<div id="tab">
   	<table style="width:100%" id="list" cellspacing="10px" cellpadding="0px" text-align="left">
        <thead>
        <tr>
        	<th align="left"></th>
                <th align="left">Template Date</th>
                <th align="left">Template Duration</th>
                <th align="left">Forecast Date</th>
                <th align="left">Forecast Duration</th>
        </tr>
        </thead>
        <tbody id="milestone">
 
    
 

?>

	</tbody>
	</table>
    	</div>
	
	<input class="button" type="submit" name="action" value="Export to CSV"/>
	<input class="button" id="btnAddAction" type="submit" name="action" value="Submit"/>
	<a href="index.php"><input class="button" type="button" value=" Cancel "/></a>

	</fieldset>
	</div>
	</div>
	<label><span>&nbsp;</span></label>
	</br>



	</form>

	</div>
</div>
	

	</body>
	</html>
