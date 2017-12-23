<?php 


  $maketemp = "
    CREATE TEMPORARY TABLE temp_table_1 (
    name VARCHAR(100) NOT NULL,
    duration int NOT NULL,
    startDate DATE,
    finishDate DATE,
    template_start_date DATE,
    template_duration int,
    template_finish_date DATE,
    predecessors int NOT NULL,
    contraint_type VARCHAR(50),
    task_mode VARCHAR(50),
    contract_number VARCHAR(50),
    cor VARCHAR(50),
    purpose VARCHAR(50),
    pop_end_date DATE,
    apr_number VARCHAR(50),
    kind_of_action VARCHAR(50),
    modification VARCHAR(50),
    extent_competed VARCHAR(100),
    contract_specialist VARCHAR(50),
    estimated_action_value int,
    type_of_contract VARCHAR(100),
    fund_type VARCHAR(50),
    technical_poc VARCHAR(100),
    spend_plan_id VARCHAR(50),
    org_type VARCHAR(50),
    pop_start_date DATE,
    contracting_officer VARCHAR(50)
    )
  "; 

  db_query($maketemp) or die ("Sql error : ".db_error());
  
$i=0;
$z=18;

$result = db_query("SELECT * from milestones_table where milestone_id=1");
$milestone_columns = array();
while($row = db_fetch_assoc($result)) {   
        foreach ($row as $col => $val) {
            $milestone_columns[] = $col;
            
        }
    }
    $milestone_columns = array_slice($milestone_columns, 2, -2);
    $num_columns = count($milestone_columns);
foreach($milestone_columns as $key => &$line){
$columnName = db_query("SELECT * FROM milestones_name_map_table where milestone_name = '$line'");
while($r = db_fetch_assoc($columnName)){
$milestoneName = $r['milestone_display_name'];
}
$next = current($milestone_columns);
$finishDate = $_POST[$next."_date"];
$actualDate = $_POST[$line."_date"];
$templateStartDate = $_POST["tempDate".$i];
if($next==''){
	$finishDate = $actualDate;
	$templateFinishDate = $templateStartDate;
} else {
	$templateFinishDate = $_POST["tempDate".($i+1)];
}
  $inserttemp = "
    INSERT INTO temp_table_1
      (name, duration, startDate, finishDate, template_start_date, template_duration, template_finish_date, predecessors, contraint_type, task_mode, contract_number, cor, purpose, pop_end_date, apr_number, kind_of_action, modification, extent_competed, contract_specialist, estimated_action_value, type_of_contract, fund_type, technical_poc, spend_plan_id, org_type, pop_start_date, contracting_officer)VALUES('$milestoneName',
      '".$_POST[$line]."', '$actualDate', 
      '".$finishDate."', '".$templateStartDate."', ".$_POST["hithere".$i].", '".$templateFinishDate."',
    $i, 'As Late As Possible', 'Auto Scheduled', '".$_POST['contract_number']."', '".$_POST['cor']."', '".$_POST['purpose']."', '".$_POST['pop_date']."', '".$_POST['apr_number']."', '".$_POST['kind_of_action']."', '".$_POST['modification']."', '".$_POST['extent_competed']."', '".$_POST['contract_specialist']."', ".$_POST['est_action_value'].", '".$_POST['contract_type']."', '".$_POST['fund_type']."', '".$_POST['tech_poc']."', '".$_POST['spend_plan_id']."', '".$_POST['dia_org']."', '".$_POST['the_date']."', '".$_POST['contracting_officer']."')
  ";
  db_query($inserttemp) or die ("Sql error : ".db_error());
  $i++;
  $z++;
  }
  
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=palt_input.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Milestone Name', 'Milestone Duration', 'Milestone Start', 'Milestone Finish', 'Template Start', 'Template Duration', 'Template Finish', 'Predecessors', 'Constraint Type', 'Task Mode', 'Solicitation/Contract Number', 'COR', 'Purpose', 'PoP End Date', 'APR Number', 'Kind of Action', 'Modification', 'Extent Competed', 'Contract Specialist', 'Estimated Action Value ($)', 'Type of Contract', 'Fund Type', 'Technical POC', 'Spend Plan ID', 'DIA Directorate/Division', 'PoP Start Date', 'Contracting Officer'));


// fetch the data

$rows = db_query("SELECT * FROM temp_table_1"); 
// loop over the rows, outputting them
while ($row = db_fetch_assoc($rows)) 
{ 
	fputcsv($output, $row);
	}
?>
