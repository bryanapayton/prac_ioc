<!DOCTYPE html>
<html>
<head>

<script type="text/javascript" src="scripts/1.10.2-jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery-1.10.2.js"></script>

<style>
table {
    width: 50%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>

</head>
<body>

<?php

include('../dbconnect.php');

$q = $_GET['q'];


$result = db_query("SELECT * FROM milestones_table WHERE template_name = '".$q."' ");
$milestone_id = db_query("SELECT milestone_id FROM milestones_table WHERE template_name = '".$q."' ");
echo "<div id=\"status\"></div>";
echo "<table>
";


while($rowId=db_fetch_row($milestone_id)){
$id = $rowId;
}
while($row = db_fetch_assoc($result)) {
$newrow=array_slice($row, 2, -2);
echo "<tr><th>Milestone Name</th><td class=\"editor\" id=\"".$row['milestone_id']."\" contenteditable=\"false\" >".$row['template_name']."</td></tr>";
foreach($newrow as $col => $key) {
$columnName = db_query("SELECT * FROM milestones_name_map_table where milestone_name = '$col'");
while($r = db_fetch_assoc($columnName)){
$newcol = $r['milestone_display_name'];
}	
    echo "<tr><th>".$newcol."</th><td class=\"editor\" id=\"".$id[0]."\" name=\"".$col."\" contenteditable=\"true\" onClick=\"showEdit(this);\">". $key ."</td></tr>";
}
}
echo "</table>";
echo "<input type=\"submit\" value=\" Save \" onclick=\"saveMe();\"/><span>&nbsp</span>";
echo "<a href=\"index.php\"><input type=\"button\" value=\" Cancel \"/></a>";
?>

 </script>
</body>
</html>
  
        
        

