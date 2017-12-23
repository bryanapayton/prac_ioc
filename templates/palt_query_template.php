<?php
include('../dbconnect.php');
unset($sql);




$contract_number = $_POST['contract_number'];
$apr_number = $_POST['apr_number'];
$tech_poc = $_POST['tech_poc'];
$cor = $_POST['cor'];
$contract_specialist = $_POST['contract_specialist'];


if ($contract_number) {
    $sql[] = " LOWER(contract_number) like LOWER('%$contract_number%') ";
}
if ($apr_number) {
    $sql[] = " LOWER(apr_number) like LOWER('%$apr_number%') ";
}
if ($tech_poc) {
    $sql[] = " LOWER(tech_poc) like LOWER('%$tech_poc%') ";
}
if ($cor) {
    $sql[] = " LOWER(cor) like LOWER('%$cor%') ";
}
if ($contract_specialist) {
    $sql[] = " LOWER(contract_specialist) like LOWER('%$contract_specialist%') ";
}

if (!empty($sql)) {
    $query .= 'SELECT * FROM palt_table WHERE ' . implode(' AND ', $sql).';';
    $row_count = db_num_rows(db_query($query));
    echo "Row count: ".$row_count;
}else {
	echo "Query is invalid. Please enter criteria to search on";
	}

$col_header = "select * from palt_table limit 1";

$html .= "<div class=\"search-table-outter wrapper\">
	<table class=\"search-table\">";
		$column=db_query($col_header);
		$html.="<thead class=\"query\"><tr>";
		while($row = db_fetch_assoc($column)) {
		$row=array_slice($row, 2);
		foreach($row as $col => $val){
		$html.="<th class=\"query\">". $col."</th>";
		}
		$html.="</tr></thead>";
	}
		$query1=db_query($query);
		
		$html.="<tbody class=\"query\">";
		while($row = db_fetch_assoc($query1)) {
		$palt_id = $row['palt_id'];
		$row=array_slice($row, 2);
		$html.="<tr>";
		foreach($row as $col => $val){
		
		if($col =="contract_number"){
		$html.="<td class=\"query\" id=\"".$col."_".$palt_id."\" name=\"$col\"><a href=\"javascript:;\"><div class=\"btnEditAction\" name=\"$col\" id=\"$palt_id\">".$row[$col]."</div></a></td>";
		}else{
		$html.="<td class=\"query\" id=\"".$col."_".$palt_id."\" name=\"$col\">". $row[$col]."</td>";
		}
		}
		$html.="</tr>";
	}
	
	$html .="</tbody></table></div>";
	echo $html;

?>
