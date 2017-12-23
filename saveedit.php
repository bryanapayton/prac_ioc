<?php
include('dbconnect.php');



$result = db_query("UPDATE milestones_table set " . $_POST["column"] . " = '".$_POST["editval"]."' WHERE  milestone_id=".$_POST["id"]);;
?>