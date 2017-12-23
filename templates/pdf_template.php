<?php
$contractType = str_replace("$", "&#36;", $_POST['contract_type']);
$html .= '<html><body><div><div class="form-style-2-heading">PALT Information</div>
<form  class="validate" action="mod_palt_query.php" method="post">

<div class="form-style-2">
<div class="sub-entry" style="width:40%; padding-right: 50px; padding-left:50px;">
<label for="contract_number"><span>Solicitation/Contract Number</span><input size="75" id="contract_number" type="text" required pattern=".*\b*" class="input-field" name="contract_number" value='.$_POST['contract_number'].' /></label>

<label for="apr_number"><span>APR Number</span><input size="75" type="text" class="input-field" name="apr_number" value='.$_POST['apr_number'].' required/></label></br>
</br></br>
<label for="pop"><span>PoP Start Date<span></br></span></br></span><input size="75" type="text" id="pop" class="input-field" name="pop" value="'.$_POST['the_date'].'" readonly required/></label></br></br></br>
<label for="pop"><span>PoP End Date<span></br></span></br></span><input size="75" type="text" id="pop" class="input-field" name="pop_date" value="'.$_POST['pop_date'].'" readonly required/></label>
<label for="kind_of_action"><span>Kind of Action<span></br></span></br></span><input size="75" type="text" class="input-field" name="kind_of_action" value="'.$_POST['kind_of_action'].'" required /></label>
<label for="modification"><span>Modification</span><input size="75" type="text" class="input-field" name="modification" value="'.$_POST['modification'].'" required /></label>
<label for="purpose"><span>Purpose<span></br></span></br></span><input size="75" type="text" class="input-field" name="purpose" value="'.$_POST['purpose'].'" required/></label>
<label for="contract_type"><span>Type of Contract</span><textarea cols="40">'.$contractType.'</textarea></label>
</div>
<div class="sub-entry" style="width:30%; padding-left: 30px;">
<label for="ext_competed"><span>Extent Competed<span></br></span></br></span><input size="50" type="text" id="pop" class="input-field" name="extent_competed" value="'.$_POST['extent_competed'].'" readonly required/></label>
<label for="spend_plan"><span>Spend Plan ID</span><input size="60" type="text" class="input-field" name="spend_plan" value='.$_POST['spend_plan_id'].' required /></label>
<label for="ext_competed"><span>Fund Type<span></br></span></br></span><input size="60" type="text" id="pop" class="input-field" name="fund_type" value="'.$_POST['fund_type'].'" readonly required/></label>
<label for="action_value"><span>Estimated Action Value ($)</span><input size="60" type="text" class="input-field" name="est_action_value" value='.$_POST['est_action_value'].' required/></label>
<label for="contractOfficer"><span>Contracting Officer</span><input size="45" type="text" class="input-field" name="contractOfficer" value="'.$_POST['contracting_officer'].'" required/></label>
<label for="contract_specialist"><span>Contract Specialist</span><input size="60" type="text" class="input-field" name="contract_specialist" value="'.$_POST['contract_specialist'].'" required /></label>
<label for="cor"><span>COR/Requisitioner<span></br></span></br></span><input size="60" type="text" class="input-field" name="cor" value="'.$_POST['cor'].'" required /></label>
<label for="diaOrg"><span>DIA Directorate/Division</span><input type="text" size="100" class="input-field" name="diaOrg" value="'.$_POST['dia_org'].'" required /></label>
<label for="tech_poc"><span>Technical POC</span><input size="60" type="text" class="input-field" name="tech_poc" value="'.$_POST['tech_poc'].'" required/></label>
</div>
</div>

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
            <tbody>';
            
$result = db_query("SELECT * from milestones_table where milestone_id=1");
$milestone_columns = array();
while($row = db_fetch_assoc($result)) {   
        foreach ($row as $col => $val) {
            $milestone_columns[] = $col;
            $temp_val[]=$val;
        }
    }
    $temp_val=array_slice($temp_val, 2,-1);
    $milestone_columns = array_slice($milestone_columns, 2, -2);
    $num_columns = count($milestone_columns);
    //column names stored in $milestone_columns
    
            
            foreach($milestone_columns as $line => $key) {
$columnName = db_query("SELECT * FROM milestones_name_map_table where milestone_name = '$key'");
while($r = db_fetch_assoc($columnName)){
$milestoneName = $r['milestone_display_name'];
}
            $html .= '
 <tr><td><label class="inner-format" for="milestones"><span>'.$milestoneName.'</span></label></td>
<td><input type="text" class="table-size" id="templateDate'.$line.'" name="templateDate'.$line.'" value="'.$_POST['tempDate'.$line].'" readonly/></td>
<td><input type="text" class="table-size" id="templateDuration'.$line.'" name="templateDuration'.$line.'" value="'.$_POST['hithere'.$line].'" readonly/></td>
<td><input type="text" class="table-size" id="actualDate'.$line.'" name="'.$key.'" value="'.$_POST[$key.'_date'].'" readonly/></td>
<td><input type="text" class="table-size" id="actualDuration'.$line.'" name="'.$key.'" value="'.$_POST[$key].'" /></td></tr>

  
  '; }
  $html .= '
  <tr><td><label class="inner-format" for="totals"><span>Totals</span></label></td>
  <td></td>
  <td><input type="text" class="table-size" value="'.$_POST['tempDateTotal'].'" readonly/></td>
  <td></td>
  <td><input type="text" class="table-size" id="totalActualDuration" name="totalActualDuration" value="'.$_POST['totalActualDuration'].'" readonly/></td></tr>

  </tbody>
    </table>
    
</div>

</fieldset>
</div>

</form>';  


$html_signature .= '<p><br/><br/><br/><br/><br/><br/></p><p class ="signature">  Technical POC Name  </p>';
$html_signature .= '<br><br><br><br><p class ="signature">  Contracting Officer\'s Representative Name (COR)  </p>';
$html_signature .= '<br><br><br><br><p class ="signature">  Contract Specialist\'s Name  </p>';
$html_signature .= '<br><br><br><br><p class ="signature">  Contracting Officer\'s Name  </p></div></body></html>';
include('mpdf/mpdf.php');
$mpdf=new mPDF();
$path = 'reading.txt';
$file = fopen($path, 'r');
$data = fread($file, filesize($path));
fclose($file);

$lines =  explode(PHP_EOL,$data);
$contract_number = $_POST['contract_number'];

$stylesheet = file_get_contents('css/palt.css'); // external css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->WriteHtml($html_signature);
$mpdf->Output("palt_input.pdf", "D");
?>
