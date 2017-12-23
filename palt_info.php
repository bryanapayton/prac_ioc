<?php
  include('dbconnect.php');
  include('index.php');
  ?>

<html>
<head>
 <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/3.3.7-js-bootstrap.min.js"></script>
 <link rel="stylesheet" href="css/1.12.1-jquery-ui.css">
    <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
    <script type="text/javascript" src="js/1.12.1-jquery-ui.js"></script>
    <script type="text/javascript" src="js/palt-functions.js"></script>
<script>
	function DisplayMilestones() {
		var contract_number = document.getElementById("edit-contract_number").value;
		var apr_number = document.getElementById("edit-apr_number").value;
		var contract_specialist = document.getElementById("edit-contract_specialist").value;
		var tech_poc = document.getElementById("edit-tech_poc").value;
		var cor = document.getElementById("edit-cor").value;
		var kind_of_action = document.getElementById("edit-kind_of_action").value;
   		var est_action_value = document.getElementById("edit-est_action_value").value;
   		var spend_plan_id = document.getElementById("edit-spend_plan_id").value;
   		var purpose = document.getElementById("edit-purpose").value;
		var modification = document.getElementById("edit-modification").value;
		var contract_type = document.getElementById("edit-contract_type").value;
		var diaOrg = document.getElementById("edit-dia_org").value;
		var contractOfficer = document.getElementById("edit-contracting_officer").value;
		var ext_competed = document.getElementById("edit-extent_competed").value;
		var fund_type = document.getElementById("edit-fund_type").value;
		var the_date = document.getElementById("edit-the_date").value;
		var re=/[0-9]{4}\/(0[1-9]\/|1[0-2])/;

		
						$('div#milestonesTable').show();
				
   	 }
     


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
    	
    	
    
});


function validateHeader() {
        var contract_number = document.getElementById("edit-contract_number").value;
        var apr_number = document.getElementById("edit-apr_number").value;
        var contract_specialist = document.getElementById("edit-contract_specialist").value;
        var tech_poc = document.getElementById("edit-tech_poc").value;
        var cor = document.getElementById("edit-cor").value;
        var kind_of_action = document.getElementById("edit-kind_of_action").value;
        var est_action_value = document.getElementById("edit-est_action_value").value;
        var spend_plan_id = document.getElementById("edit-spend_plan_id").value;
        var purpose = document.getElementById("edit-purpose").value;
        var modification = document.getElementById("edit-modification").value;
        var contract_type = document.getElementById("edit-contract_type").value;
        var diaOrg = document.getElementById("edit-dia_org").value;
        var contractOfficer = document.getElementById("edit-contracting_officer").value;
        var ext_competed = document.getElementById("edit-extent_competed").value;
        var fund_type = document.getElementById("edit-fund_type").value;
        var the_date = document.getElementById("edit-the_date").value;
        
        var contractFormat = /[Hh]{2}[Mm]402-\d{2}-[Rr]|[Qq]-\d{4}|[Hh]{2}[Mm]402-\d{2}-[a-zA-Z0-9]-\d{4}/;
        var aprFormat = /\d{3}-\d{4}-\d{2}-[a-zA-Z0-9]/;

	if (!contractFormat.test(contract_number)){
		document.getElementById("edit-contract_number").focus();
                return false;
        } else if (!aprFormat.test(apr_number)){
		document.getElementById("edit-apr_number").focus();
                return false;
        } else if (contract_specialist==""){
		document.getElementById("edit-contract_specialist").focus();
                return false;
        } else if (tech_poc==""){
		document.getElementById("edit-tech_poc").focus();
                return false;
        } else if (cor==""){
		document.getElementById("edit-cor").focus();
                return false;
        } else if (kind_of_action=="select action"){
		document.getElementById("edit-kind_of_action").focus();
                return false;
        } else if (est_action_value=="" || isNaN(est_action_value)){
		document.getElementById("edit-est_action_value").focus();
                return false;
        } else if (spend_plan_id==""){
		document.getElementById("edit-spend_plan_id").focus();
                return false;
        } else if (modification==""){
		document.getElementById("edit-modification").focus();
                return false;
        } else if (contract_type=="select action"){
		document.getElementById("edit-contract_type").focus();
                return false;
        } else if (diaOrg=="select action"){
		document.getElementById("edit-dia_org").focus();
                return false;
        } else if (contractOfficer==""){
		document.getElementById("edit-contracting_officer").focus();
                return false;
        } else if (ext_competed=="select action"){
		document.getElementById("edit-extent_competed").focus();
                return false;
        } else if (fund_type=="select action"){
		document.getElementById("edit-fund_type").focus();
                return false;
        }
        return true;
}

 
	function getMilestone(str) {
					$.ajax({
				url: "templates/MilestoneTemplate.php",
				type: "POST",
				data: "contract_type="+encodeURIComponent(str),
				success: function(data){
				var x, i;
				var obj = JSON.parse(data)
				for (i=0; i<obj.length; i++){
				$("input[name='"+obj[i].name+"']").val(obj[i].value);
				}
				updateTemplateDate();
				}   
		   });
 				
					 	
		}//End of function
		
		
		
	function showPalt(){
	 document.getElementById("txtHint").innerHTML = "";
           var contract_number = document.getElementById("contract_number").value;
    var apr_number = document.getElementById("apr_number").value;
    var tech_poc = document.getElementById("tech_poc").value;
    var cor = document.getElementById("cor").value;
    var contract_specialist = document.getElementById("contract_specialist").value;
           $.ajax({
				url: "templates/palt_query_template.php",
				type: "POST",
				data: "contract_number="+contract_number+"&apr_number="+apr_number+
        "&tech_poc="+tech_poc+"&cor="+cor+"&contract_specialist="+contract_specialist,
        		dataType: "html",
				success: function(data){
					$('#txtHint').html(data);
				}   
		   });
       
     
        }
        
$(document).ready(function(){
    	
    	
    	//new fuction 
    		var palt_id;
	var edit_window = $("#frmEdit").dialog({autoOpen: false,
      height: 700,
      width: 1000,
      modal: true});

	var success = $( "#dialog-message" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
	  
	var add_window = $("#frmAdd").dialog({
	  autoOpen: false,
	  height: 700,
	  width: 900,
	  resizable: true,
	  modal: true,
	  buttons: {
		"Post": addComment
	  },
	  close: function() {
		add_window.dialog( "close" );
	  }
	});

	function addComment() {
		add_window.dialog( "close" );
		callCrudAction('add','');
	} 

	$( 'body' ).on('click', '.btnAddAction', function() {
	  add_window.dialog( "open" );
	});

	$( 'body').on( 'click', '.btnEditAction', function() {
		DisplayMilestones();
		openEditBox($(this).attr("id"));
		var $row = $(this).closest("tr"), 
		$tds = $row.find("td");
		$.each($tds, function() { 
		var name = $(this).attr("name"); 
		var editVal = $(this).text();
		
	if(name == "pop_date"){
		var p_date = new Date(editVal);
		var dd;
		dd = p_date.getUTCDate();
		if(dd < 10){
		dd = '0'+dd;
		}
		var mm = p_date.getUTCMonth() + 1;
		if (mm < 10) {
			mm = '0' + mm;
		}
		$("#edit-pop_date").val(mm+'/'+dd+'/'+p_date.getUTCFullYear());
		}
	else if(name == "the_date" || name == "contract_signed_date"){
		var dd;
		var contractDate = new Date(editVal);
                dd = contractDate.getUTCDate();
                if(dd < 10){
                dd = '0'+dd;
                }
		var mm = contractDate.getUTCMonth() + 1;
		if (mm < 10) {
			mm = '0' + mm;
		}
		$("input[name=tempDate18], input[name=contract_signed_date], #edit-the_date").val(mm+'/'+dd+'/'+contractDate.getUTCFullYear());
		}else if (name == "modification" && $("#edit-kind_of_action").val() != 'Modification') {
                    $("input[name="+name+"]").val("N/A");
                    $("input[name="+name+"]").prop('readonly', true);
                  } else {
                    $("input[name="+name+"]").val(editVal);
                    $("select[name="+name+"]").val(editVal);
		}
		if(name=="contract_type"){
		getMilestone(editVal);
		}

});
updateDate();
	});
});

function successMessage(){
success = $( "#dialog-message" ).dialog({
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

function openEditBox(id) {
	edit_window = $("#frmEdit").dialog({
	  title: "Edit Palt",
      buttons: {
       
      },
      close: function() {
		
        edit_window.dialog( "close" );
      }
    });
	edit_window.dialog( "open" );
	palt_id = id;
	

}

function saveMe(){
	if (validateHeader()) {
    		callCrudAction('edit', palt_id);
    		}   
        }
function close(){
	edit_window.dialog("close");
	}        
function editComment() {
	if (validateHeader()) {
	edit_window.dialog( "close" );
	callCrudAction('edit', palt_id);
	}
} 

function callCrudAction(action, id) {
	var paramsToSend = {};

	//It is better to sanitise user input to avoid XSS attack and SQL injection
	switch(action) {
		case "add":
			queryString = 'action='+action+'&txtmessage='+ $("#txtmessage").val();
		break;
		case "edit":
    		 paramsToSend = $("#frmEdit").find("input, select").not('[name^="tempDate"]').not('[name^="hithere"]').not('[name="totalActualDuration"]').not('[name="action"]').serializeArray();
    		 paramsToSend[paramsToSend.length] = {name: "palt_id", value: id};
    		 paramsToSend[paramsToSend.length] = {name: "action", value: action};
		break;
		case "delete":
			paramsToSend = $("#frmEdit").find("input, select").not('[name^="tempDate"]').not('[name^="hithere"]').not('[name="totalActualDuration"]').not('[name="action"]').serializeArray();
    		 paramsToSend[paramsToSend.length] = {name: "palt_id", value: id};
    		 paramsToSend[paramsToSend.length] = {name: "action", value: action};
		break;
	}	 
	jQuery.ajax({
	url: "savePalt.php",
	data: { params: JSON.stringify(paramsToSend)},
	type: "POST",
	success:function(data){
				if(data.status == 'success'){
						showPalt();
       					  successMessage(); 
  					  }else if(data.status == 'delete'){
  					  showPalt();
   						     alert("PALT has been deleted");
   						 }else if(data.status == 'error'){
   						     alert("PALT failed to update");
   						 }
		
	},
	error:function (){}
	});
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

function toggleModification() {
  var mod = document.getElementById("edit-modification");
  var kindOfAction = document.getElementById("edit-kind_of_action");
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
thead.query, tbody.query{ display: block; }
.search-table-outter {padding-left:10px; padding-right:10px; padding-bottom: 50px; border:2px solid blue;}
.search-table{table-layout: fixed; margin:10px auto 0px auto; }
.search-table, td.query, th.query{border-collapse:collapse; border:1px solid #777;}
th.query{ font-size:15px; color:#444; background:#66C2E0;}
td.query{ font-size:15px;}

.search-table-outter { overflow-x: scroll; }
.search-table tbody.query {max-height: 200px; overflow-y: auto;}
th.query, td.query { height: 30px; min-width: 200px; }

</style>

</head>

<body>
<div id="wrapper">
<?php


    ?>
<div class="palt_input" style="display:block" align="center" >
<div class="form-style-2-heading">Query PALT Records</div>


<div class="form-style-2-query">
<label for="contract_number"><span>Solicitation/Contract Number</span><input id="contract_number" type="text" required pattern="^\S" class="input-field"  /></label>
<label for="apr_number"><span>APR Number</span><input id="apr_number" type="text" class="input-field"  required/></label>
<label for="contract_specialist"><span>Contract Specialist</span></span><input id="contract_specialist" type="text" class="input-field" required /></label>
<label for="tech_poc"><span>Technical POC</span><input id="tech_poc" type="text" class="input-field"  required/></label>
<label for="cor"><span>COR</span><input id="cor" type="text" class="input-field" required /></label>


</div>
<div id="continue" class="form-style-3">
<input type="button" class="button" value =" Search " onclick="showPalt()"/>
</div>
<div id="txtHint">

</div>
</div>

<label><span>&nbsp;</span></label>
</br>






</div>
</div>
<div id="frmEdit">

	<form id="paltForm" class="validate" action="mod_palt_query.php" method="post">

	<div class="form-style-2">
	<div class="sub-entry">
		<label for="contract_number"><span>Solicitation/Contract Number<span class="required">*</span></span><input id="edit-contract_number" type="text" required pattern="([Hh]{2}[Mm]402-\d{2}-[Rr]|[Qq]-\d{4}|[Hh]{2}[Mm]402-\d{2}-[a-zA-Z0-9]-\d{4})" class="input-field" name="contract_number" title="Format: HHM402-NN-R or Q-NNNN or HHM402-NN-A-NNNN" onBlur="javascript:{this.value = this.value.toUpperCase();}"/></label>
		<label for="apr_number"><span>APR Number<span class="required">*</span></span><input id="edit-apr_number" type="text" class="input-field" name="apr_number" required pattern="\d{3}-\d{4}-\d{2}-[a-zA-Z0-9]" title="Format: NNN-NNNN-NN-A" onBlur="javascript:{this.value = this.value.toUpperCase();}"/></label>
	        <label for="startDate"><span>PoP Start Date<span class="required">*</span></span><input type="text" id="edit-the_date" class="input-field" name="the_date" required readonly/></label>
	        <label for="pop"><span>PoP End Date<span class="required">*</span></span><input type="text" id="edit-pop_date" class="input-field" name="pop_date" required readonly/></label>
	</div>

	<div class="sub-entry">
<?php
		$result = db_query("select * from action_table");
		if (!$result) {
    			echo 'Could not run query: ' . db_error();
    		exit;
}

        	echo "<label for=\"kind_of_action\"><span>Kind of Action<span class=\"required\">*</span></span><select id=\"edit-kind_of_action\" name=\"kind_of_action\" class=\"select-field\" onChange=\"toggleModification();\">";
        	echo "<option value=\"select action\" disabled selected>Select Kind of Action</option>";
        	if (db_num_rows($result) > 0) {
    			while ($row = db_fetch_array($result)) {    
			echo "<option name=\"".$row[1]."\" value=\"".$row[1]."\">".$row[1]."</option>";
}}	
			echo "</select>";
?>
</label>
		<label for="modification"><span>Modification</span><input id="edit-modification" type="text" class="input-field" name="modification"/></label>
		<label for="purpose"><span>Purpose<span></span></span><input id="edit-purpose" type="text" class="input-field" name="purpose"/></label>
<?php
	$result = db_query("select * from contract_type_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"contract_type\"><span>Type of Contract<span class=\"required\">*</span></span><select id=\"edit-contract_type\" name=\"contract_type\" onchange=\"loadNewMilestoneTemplate(this.value);\" class=\"select-field\">";
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

        echo "<label for=\"ext_competed\"><span>Extent Competed<span class=\"required\">*</span></span><select id=\"edit-extent_competed\" name=\"extent_competed\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select Extent Competed</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[1]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
	<label for="spend_plan"><span>Spend Plan ID<span class="required">*</span></span><input id="edit-spend_plan_id" type="text" class="input-field" name="spend_plan_id" required /></label>

<?php
	$result = db_query("select * from fund_type_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"fund_type\"><span>Fund Type<span class=\"required\">*</span></span><select id=\"edit-fund_type\" name=\"fund_type\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select Fund Type</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[1]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
	<label for="action_value"><span>Estimated Action Value ($)<span class="required">*</span></span><input id="edit-est_action_value" type="text" class="input-field" name="est_action_value" title="Enter number" pattern="\d+" required/></label>


	</div>


	<div class="sub-entry">
	        <label for="contractOfficer"><span>Contracting Officer<span class="required">*</span></span><input id="edit-contracting_officer" type="text" class="input-field" name="contracting_officer" required/></label>
		<label for="contract_specialist"><span>Contract Specialist<span class="required">*</span></span><input id="edit-contract_specialist" type="text" class="input-field" name="contract_specialist" required /></label>
		<label for="cor"><span>COR/Requisitioner<span class="required">*</span><span></span></span><input id="edit-cor" type="text" class="input-field" name="cor" required /></label>

<?php
	$result = db_query("select * from org_table");
	if (!$result) {
    		echo 'Could not run query: ' . db_error();
    	exit;
}

        echo "<label for=\"diaOrg\"><span>DIA Directorate/Division<span class=\"required\">*</span></span><select id=\"edit-dia_org\" name=\"dia_org\" class=\"select-field\">";
        echo "<option value=\"select action\" disabled selected>Select DIA Directorate/Division</option>";
        if (db_num_rows($result) > 0) {
    		while ($row = db_fetch_array($result)) {    
		echo "<option value=\"".$row[1]."\">".$row[2]."</option>";
}}
	echo "</select>";
?>
</label>
	<span></span><span></span><span></span>
        <label for="tech_poc"><span>Technical POC<span class="required">*</span></span><input id="edit-tech_poc" type="text" class="input-field" name="tech_poc" required/></label>

	</div>
	</div>
	
<div id="milestonesTable" style="display:block">	
<div class="form-style-3" id="milestonesTable">
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
    <tbody id="milestone"><tr><td><label class="inner-format" for="milestones"><span>Full Package Received</span></label></td>
  <td><input type="text" class="table-size" id="templateDate0" name="tempDate0" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration0" name="hithere0" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate0" name="full_package_received_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration0" name="full_package_received" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Mandatory Approvals (J&A, JOFOC, DD254, D&Fs, Acquisition Plan, Source Selection Plan)</span></label></td>
  <td><input type="text" class="table-size" id="templateDate1" name="tempDate1" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration1" name="hithere1" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate1" name="mandatory_approvals_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration1" name="mandatory_approvals" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>RFI/Sources Sought Released</span></label></td>
  <td><input type="text" class="table-size" id="templateDate2" name="tempDate2" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration2" name="hithere2" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate2" name="rfi_src_sought_rel_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration2" name="rfi_src_sought_rel" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Responses to RFI/Sources Sought Evaluated</span></label></td>
  <td><input type="text" class="table-size" id="templateDate3" name="tempDate3" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration3" name="hithere3" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate3" name="rfi_src_sought_eval_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration3" name="rfi_src_sought_eval" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Small Business Coordination (DD Form 2579</span></label></td>
  <td><input type="text" class="table-size" id="templateDate4" name="tempDate4" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration4" name="hithere4" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate4" name="small_business_coord_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration4" name="small_business_coord" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Synopsis Released</span></label></td>
  <td><input type="text" class="table-size" id="templateDate5" name="tempDate5" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration5" name="hithere5" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate5" name="synopsis_released_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration5" name="synopsis_released" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>RFP Prepared/Reviewed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate6" name="tempDate6" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration6" name="hithere6" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate6" name="rfp_prep_rev_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration6" name="rfp_prep_rev" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Pre Solicitation SCRB</span></label></td>
  <td><input type="text" class="table-size" id="templateDate7" name="tempDate7" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration7" name="hithere7" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate7" name="pre_solicitation_scrb_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration7" name="pre_solicitation_scrb" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>RFP Released</span></label></td>
  <td><input type="text" class="table-size" id="templateDate8" name="tempDate8" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration8" name="hithere8" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate8" name="rfp_released_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration8" name="rfp_released" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Proposals Due</span></label></td>
  <td><input type="text" class="table-size" id="templateDate9" name="tempDate9" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration9" name="hithere9" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate9" name="proposals_due_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration9" name="proposals_due" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Tech Eval Completed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate10" name="tempDate10" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration10" name="hithere10" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate10" name="tech_eval_end_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration10" name="tech_eval_end" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Cost/Price Evaluation Completed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate11" name="tempDate11" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration11" name="hithere11" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate11" name="cost_price_eval_end_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration11" name="cost_price_eval_end" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Negotiations Completed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate12" name="tempDate12" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration12" name="hithere12" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate12" name="neg_end_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration12" name="neg_end" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Revised Proposals Received</span></label></td>
  <td><input type="text" class="table-size" id="templateDate13" name="tempDate13" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration13" name="hithere13" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate13" name="rev_proposal_received_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration13" name="rev_proposal_received" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Tech Eval of Revised Proposals Completed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate14" name="tempDate14" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration14" name="hithere14" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate14" name="tech_eval_rev_end_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration14" name="tech_eval_rev_end" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Cost/Price Eval of Revised Proposals Completed</span></label></td>
  <td><input type="text" class="table-size" id="templateDate15" name="tempDate15" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration15" name="hithere15" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate15" name="cost_price_eval_rev_end_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration15" name="cost_price_eval_rev_end" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Award Documentation Prepared</span></label></td>
  <td><input type="text" class="table-size" id="templateDate16" name="tempDate16" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration16" name="hithere16" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate16" name="award_doc_prepared_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration16" name="award_doc_prepared" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Pre-Award SCRB</span></label></td>
  <td><input type="text" class="table-size" id="templateDate17" name="tempDate17" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration17" name="hithere17" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate17" name="pre_award_scrb_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration17" name="pre_award_scrb" value="" /></td></tr><tr><td><label class="inner-format" for="milestones"><span>Contract Signed/Released</span></label></td>
  <td><input type="text" class="table-size" id="templateDate18" name="tempDate18" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration18" name="hithere18" value="" readonly/></td>
 <td><input type="text" class="table-size" id="actualDate18" name="contract_signed_date" readonly/></td>
 <td><input type="text" class="table-size" id="actualDuration18" name="contract_signed" value="" /></td></tr><tr><td><label class="inner-format" for="totals"><span>Totals</span></label></td><td></td><td><input type="text" class="table-size" id="tempDurationTotal" name="tempDateTotal" value="" readonly/></td><td></td><td><input type="text" class="table-size" id="totalActualDuration" name="totalActualDuration" value="" readonly/></td></tr> </tbody>


	</table>
  <input class="button" type="submit" name="action" onclick="saveMe();" value="Export to PDF"/>
<input class="button" type="submit" name="action" onclick="saveMe();" value="Export to CSV"/>
<input class="button" type="button" onclick="saveMe();" name="action" value="Submit"/>
<input type="button" class="button" value =" Close " onclick="parent.window.close();"/>
    </div>
	</fieldset>
	</div>
	</div>
	<label><span>&nbsp;</span></label>
	</br>
<div id="dialog-message" title="PALT Message">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
    PALT UPDATED SUCCESSFULLY
  </p>
  
</div>
	</form>
	</div>
</body>
</html>
