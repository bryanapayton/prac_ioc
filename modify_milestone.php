<?php
require_once('dbconnect.php');
include('index.php');


//Get column names from specified table
$result = db_query("select template_name from milestones_table");
if (!$result) {
    echo 'Could not run query: ' . db_error();
    exit;
}


$query = db_query("select * from milestone_table where name ="); 
?>

<html>
<head>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="js/3.3.7-js-bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
 <link rel="stylesheet" href="css/1.12.1-jquery-ui.css">
    
    <script type="text/javascript" src="js/1.12.1-jquery-ui.js"></script>
    <script type="text/javascript" src="js/palt-functions.js"></script>
<script>

$(document).ready(function(){
var successUpdate = $( "#dialog-message" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
});

function successMessage(){
successUpdate = $( "#dialog-message" ).dialog({
autoOpen: false,
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
	  window.location.href = 'index.php'
        }
      }
    });
    
    successUpdate.dialog("open");
}

function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}

function showMilestone(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","templates/getMilestone.php?q="+str,true);
        xmlhttp.send();
    }
}
		function saveMe(){
	 $( ".editor" ).each(function() {
            var column=  $(this).attr("name");
            var id = $(this).attr("id");
            var value = this.innerHTML;
           $.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+value+'&id='+id,
				success: function(data){
					$(this).css("background","#FDFDFD");
					successMessage();
				}   
		   });
        });

}
</script>

<style>

<?php

include ('css/style.css');

?>

</style>

</head>

<body>

<div id="wrapper">

<div class="form-style-2mm-heading">Modify Milestone Templates</div>

<div class="form-style-2mm">

<form>

<?php
$result = db_query("select template_name from milestones_table");
if (!$result) {
    echo 'Could not run query: ' . db_error();
    exit;
}

        echo "<select name=\"milestone\" class=\"select-field\" onchange=\"showMilestone(this.value)\">";
        echo "<option selected value=\"Select Milestone Template\" disabled>Select Milestone Template</option>";
        if (db_num_rows($result) > 0) {
    while ($row = db_fetch_array($result)) {    
	echo "<option value=\"".$row[0]."\">".$row[0]."</option>";
}}
echo "</select>";

?>
<div id="dialog-message" title="PALT Message">
  <p>
    <span style="float:left; margin:0 7px 50px 0;"></span>
    Milestone Template UPDATED
  </p>
  
</div>
</form>
<br>
<div id="txtHint">
<a href="index.php"><input type="button" value=" Cancel "/></a>
</div>
</div>
</div>
</body>
</html>

