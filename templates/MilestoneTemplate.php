
<?php
require_once ('../dbconnect.php');
$mstone.='
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
            <tbody id="milestone">';
 
$q = $_POST['contract_type'];

$result = db_query("SELECT * from milestones_name_map_table");
$milestone_columns = array();
while($row = db_fetch_assoc($result)) {   
            $milestone_columns[] = $row['milestone_name'];
    }
    
    $num_columns = count($milestone_columns);
    //column names stored in $milestone_columns
    
$milestones = db_query("SELECT template_name from milestones_table ORDER BY milestone_id");
$template_names = array();
while($row = db_fetch_row($milestones)){
foreach($row as $val){
$template_names[] = $val;
}
}
$contract_type_query = db_query("SELECT contract_type from contract_type_table ORDER BY contract_type_id");
$contract_types = array();
while($row = db_fetch_row($contract_type_query)){
foreach($row as $val){
$contract_types[] = $val;
}}
$number_of_contracts = count($contract_types);

for($i=0; $i<$number_of_contracts; $i++){
if($q === $contract_types[$i]) {
	$tname = $template_names[$i];
	}
	}


$query = db_query("select * from milestones_table where template_name = '".$tname."' ");


while ($row = db_fetch_row($query)) {
$dura = array();
foreach($row as $val) $dura[] = $val;
}
$dura = array_slice($dura, 2);
$dura = array_slice($dura, 0, -2);

$i=18;
foreach($milestone_columns as $line => $key) {
$columnName = db_query("SELECT * FROM milestones_name_map_table where milestone_name = '$key'");
while($r = db_fetch_assoc($columnName)){
$newcol = $r['milestone_display_name'];
}
	$mstone .= '<tr><td><label class="inner-format" for="milestones"><span>'.$key.'</span></label></td>';
  $mstone.= '<td><input type="text" class="table-size" id="templateDate'.$line.'" name="tempDate'.$line.'" readonly/></td>';
$mstone.=   '<td><input type="text" class="table-size" id="templateDuration'.$line.'" name="hithere'.$line.'" value="'.$dura[$line].'" readonly/></td>';
  $mstone.= '<td><input type="text" class="table-size" id="actualDate'.$line.'" name="'.str_replace(' ', '_',strtolower($key)).'_date" readonly/></td>';
 $mstone.=  '<td><input type="text" class="table-size" id="actualDuration'.$line.'" name="'.str_replace(' ', '_',strtolower($key)).'"  /></td></tr>';
$i--;
}
//$i++;
$mstone.='<tr><td><label class="inner-format" for="totals"><span>Totals</span></label></td>';
  $mstone.= '<td></td>';
  $mstone.=   '<td><input type="text" class="table-size" name="tempDateTotal" value="'.array_sum($dura).'" readonly/></td>';
  $mstone.= '<td></td>';
  $mstone.=   '<td><input type="text" class="table-size" id="totalActualDuration" name="totalActualDuration" value="'.array_sum($dura).'" readonly/></td></tr>';

$mstone.=' </tbody>
    </table>
    </div>
<input class="button" type="submit" name="action" onclick="saveMe();" value="Export to PDF"/>
<input class="button" type="submit" name="action" onclick="saveMe();" value="Export to CSV"/>
<input class="button" type="button" onclick="saveMe();" name="action" value="Submit"/>
<a href="index.php"><input class="button" type="button" value=" Cancel "/></a>
</fieldset>

 </div>';

$newF = [];

 foreach($milestone_columns as $line=> $key){
 $newF[] = array("value" => $dura[$line], "name" => "hithere".$line);
 
 }
 
 echo json_encode($newF);
?>




