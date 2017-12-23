

   $(function() {
      $( "#edit-the_date, #from" ).datepicker({
        showOn: "button",
        buttonImage: "graphics/calendar-icon.gif",
      	buttonImageOnly: true,
        defaultDate: "+1w",
        dateFormat: "mm/dd/yy",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
  	    onSelect: function( selectedDate ) {
				  $('#templateDate18').val(selectedDate);
				  $('#actualDate18').val(selectedDate);
					if(this.id == 'from'){
						 var tempId = 18;
							$("input[id^='templateDate']").each(function() {
								 var dateMin = new Date(document.getElementById('templateDate' + tempId).value); 
								 var rMin = new Date(dateMin.getFullYear(), dateMin.getMonth(),dateMin.getDate() - parseInt(document.getElementById("templateDuration" + tempId).value)); 
								 $('#templateDate' + (tempId - 1) ).val($.datepicker.formatDate('mm/dd/yy', new Date(rMin)));
								 $('#actualDate' + (tempId - 1) ).val($.datepicker.formatDate('mm/dd/yy', new Date(rMin)));
									tempId--;
								 });
						}
				
					}
	   
        	});
        $( "#edit-pop_date, #pop" ).datepicker({
        showOn: "button",
        buttonImage: "graphics/calendar-icon.gif",
      	buttonImageOnly: true,
        defaultDate: "+1w",
        dateFormat: "mm/dd/yy",
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        });
    });
    
    
	function updateTemplateDate()
    {
    var actualId = 18;
    	var total = 0;
    	
  		$("input[id^='templateDate']").each(function() {
   		 	var dateActual = new Date(document.getElementById('templateDate' + actualId).value); 
   		 	console.log(dateActual);
  	    	 var actual = new Date(dateActual.getUTCFullYear(), dateActual.getUTCMonth(),dateActual.getUTCDate() - parseInt(document.getElementById("templateDuration" + actualId).value)); 
     	     total = total + parseInt(document.getElementById("templateDuration" + actualId).value);  	    	 
  	    	 console.log(actual);
 			 $('#templateDate' + (actualId - 1) ).val($.datepicker.formatDate('mm/dd/yy', new Date(actual)));
 			 $('#tempDurationTotal').val(total);
			//$('#actualDuration' + actualId).style.backgroundColor = "yellow";
			actualId--;
		 });
	}
    
	function updateDate()
    {
    	var actualId = 18;
    	var total = 0;
    	
  		$("input[id^='actualDate']").each(function() {
     		 var dateActual = new Date(document.getElementById('actualDate' + actualId).value); 
			 var actual = new Date(dateActual.getUTCFullYear(), dateActual.getUTCMonth(),dateActual.getUTCDate() - parseInt(document.getElementById("actualDuration" + actualId).value)); 
     	     total = total + parseInt(document.getElementById("actualDuration" + actualId).value);
			 $('#actualDate' + (actualId - 1) ).val($.datepicker.formatDate('mm/dd/yy', new Date(actual)));
			 $('#totalActualDuration').val(total);
			 //$('#actualDuration' + actualId).stylZe.backgroundColor = "yellow";
				actualId--;
		 });
	}
	
	    function loadNewMilestoneTemplate(str){
    if (str == "") {
      						document.getElementById("milestonesTable").innerHTML = "";
  							return;
						}	else { 
   					 					if (window.XMLHttpRequest) {
											// code for IE7+, Firefox, Chrome, Opera, Safari
  						   				 xmlhttp = new XMLHttpRequest();
										}	else {

											// code for IE6, IE5
											xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
								 }
					
 					 xmlhttp.onreadystatechange = function() {
   						 if (this.readyState == 4 && this.status == 200) {
    							  document.getElementById("milestonesTable").innerHTML = this.responseText;
								$('#templateDate18').val($('#edit-the_date').val());
								$('#actualDate18').val($('#edit-the_date').val());
								updateTemplateDate();
								updateDate();
            					}
        				};
					 	 xmlhttp.open("GET","templates/showMilestoneTemplate.php?q="+encodeURIComponent(str),true);
						  xmlhttp.send();
    				}	
    }
    
    
    	function getMilestoneTemplate(str) {
    				if (str == "") {
      						document.getElementById("milestonesTable").innerHTML = "";
  							return;
						}	else { 
   					 					if (window.XMLHttpRequest) {
											// code for IE7+, Firefox, Chrome, Opera, Safari
  						   				 xmlhttp = new XMLHttpRequest();
										}	else {

											// code for IE6, IE5
											xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
								 }
					
 					 xmlhttp.onreadystatechange = function() {
   						 if (this.readyState == 4 && this.status == 200) {
    							  document.getElementById("milestonesTable").innerHTML = this.responseText;
								$('#templateDate18').val($('#from').val());
								$('#actualDate18').val($('#from').val());
								updateTemplateDate();
								updateDate();
            					}
        				};
					 	 xmlhttp.open("GET","templates/showMilestoneTemplate.php?q="+encodeURIComponent(str),true);
						  xmlhttp.send();
    				}	
		}//End of function

