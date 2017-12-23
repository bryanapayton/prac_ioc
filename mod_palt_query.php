<?php
require_once ('dbconnect.php');

if($_POST['action']=='Export to PDF'){


include('templates/pdf_template.php');


   

   
}elseif ($_POST['action'] == 'Export to CSV'){

require_once('templates/csv_template.php');	



} else  {


db_close($connection);

}
?>

