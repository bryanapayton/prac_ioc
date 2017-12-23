<?php
include('dbconnect.php');

$decoded = json_decode($_POST['params'],true);

//Get the contract number to see if it exists in database
foreach ($decoded as $value) {
	if($value['name']=="palt_id"){
   	$palt_id = $value['value'];
   	}
   if($value['name']=="contract_number"){
   		$contract_number = $value['value'];
   		}
   		if($value['name']=="action"){
   	$action = $value['value'];
   	}
   	$name = str_replace(' ', '_', $value['name']);
   	$updates[] = "$name = '". $value['value']."'";
}




if($action=="save") {
	
	
				$result = db_query("SELECT * from palt_table order by palt_id");
				while($row = db_fetch_assoc($result)){
					$last_id = $row['palt_id'];
				}

				$new_palt_id = $last_id + 1;
				$date = date("Y/m/d h:m:s");

				$json = $_POST['params'];

				$array = json_decode($json, true);
				array_pop($array);
				$columns = [];
				$values = [];
						foreach($array as $key){
							foreach($key as $a => $b){
									 $c = $_POST['contract_number'];
										 if($a=="name"){
 												$b = str_replace(' ', '_', $b);
												 $columns[]= $b;
											 }else{
												 $values[] = $b;
											 }
										}		
									}
					$header = array_slice($updates, 0, -39);
					$columns = implode(", ", $columns);
					$values = implode("', '", $values);
  					$check = db_query("Select palt_id from palt_table where ".implode(' AND ', $header));
  					while($row = db_fetch_assoc($check)){
  					$existingPaltId = $row['palt_id'];
  					}
  					array_pop($updates);
					if (db_num_rows($check) == 0) { 
    						  $sql="INSERT INTO palt_table(palt_id, user_dn, last_update, $columns)values('$new_palt_id', 'no dn provided', '$date', '$values')";
							if (!db_query($sql))
								{
 									 $response_array['status'] = 'error';
								}
								$response_array['status'] = 'success'; 
					}else {
							$sql="UPDATE palt_table set ".implode(", ",$updates).", last_update='$date' where palt_id = $existingPaltId";
							if (!db_query($sql))
								{
 									 $response_array['status'] = 'error';
								}
								$response_array['status'] = 'update'; 
						}
			
					header('Content-type: application/json');
   					 echo json_encode($response_array);
   					 
}elseif($action=="edit"){
   		
   
   				array_pop($updates);
   				array_pop($updates);
				$result = db_query("SELECT * from palt_table");

				$date = date("Y/m/d h:m:s");

 				 $check = db_query("Select * from palt_table where palt_id = '$palt_id'");
				
    					  $sql="UPDATE palt_table set ".implode(", ",$updates).", last_update='$date' where palt_id = '$palt_id'";
							if (!db_query($sql))
							{
							  $response_array['status'] = 'error';
							}
						$response_array['status'] = 'success'; 
					
					

						header('Content-type: application/json');
  		 			 echo json_encode($response_array);
				
    		
		}elseif($action=="delete"){
   		
   
				
    					  $sql="DELETE FROM palt_table where palt_id = '$palt_id'";
							if (!db_query($sql))
							{
							  $response_array['status'] = 'error';
							}
						$response_array['status'] = 'delete'; 
					
					

						header('Content-type: application/json');
  		 			 echo json_encode($response_array);
  		 			 }
?>