<?php
	//table.php
	
	//getting our config
	require_once("../../config.php");
	
	//create connection
	$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_nicole");
	
	//if there is ?DELETE=ROW_ID in the URL
	if(isset($_GET["deleted"])){
		
		echo "Deleting row with id:".$_GET["deleted"];
		
		//NOW - current day time
		$stmt = $mysql->prepare("UPDATE messages_sample SET deleted=NOW() WHERE id = ?");
		
		echo $mysql->error;
		
		//replace the ?
		$stmt->bind_param("i", $_GET["deleted"]);
		
		if($stmt->execute()){
			echo "deleted successfully";
		}else{
			echo $stmt->error;
			
		}
		//closes the statement,so others can use connection
		$stmt->close();

	}
	
	
	//SQL sentence
	$stmt = $mysql->prepare("SELECT id, recipient, message, created FROM messages_sample WHERE deleted is NULL ORDER BY created DESC LIMIT 10");
	
	//WHERE deleted is NULL show only those what is not deleted
	
	//if error in sintence
	echo $mysql->error;
	
	//variables for data for each row we will get
	$stmt->bind_result($id, $recipient, $message, $created);

	//quiery
	$stmt->execute();
	
	$table_html = "";
	
	//add sth to string .=
	$table_html .= "<table>"; //start new table
		$table_html .= "<tr>"; 
			$table_html .= "<th>ID</th>";
			$table_html .= "<th>Recipient</th>";
			$table_html .= "<th>Message</th>";
			$table_html .= "<th>Created</th>";
			$table_html .= "<th>Delete</th>";
			$table_html .= "<th>Edit</th>";
		$table_html .= "</th>"; 
	
	
		//GET RESULT
		//we have multiple rows
		while($stmt->fetch()){
		
		//DO SOMETHING FOR EACH ROW
		//echo $id." ".$message."<br>";
		
		$table_html .= "<tr>"; //add columns
			$table_html .= "<td>".$id."</td>";
			$table_html .= "<td>".$recipient."</td>";
			$table_html .= "<td>".$message."</td>";
			$table_html .= "<td>".$created."</td>";
			$table_html .= "<td><a href='?deleted=".$id."'>X</a></td>";
			$table_html .= "<td><a href='edit.php?edit=".$id."'>V</a></td>";
			
		$table_html .= "</th>"; //end row
		}	
	$table_html .= "</table>"; //end table
	
	echo $table_html;

	
?>

<a href="app.php">app</a>	

