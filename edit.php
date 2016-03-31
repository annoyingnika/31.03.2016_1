<?php
	//require another php file
	// ../../../ means > 3 folders back
	require_once("../../config.php");
	
	//if the variable doesn't exist in the urldecode
	if(!isset ($_GET["edit"])){
		
			//redirect user_error
			echo "Redirect";
			
			
			header("Location: table.php");
			exit(); //don't execute futher
	}else{
			echo "User wants to edit row:".$_GET["edit"];
			
			//ask for latest data for single row
			$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_nicole");
			
			$stmt = $mysql->prepare ("SELECT recipient, message, sender FROM messages_sample WHERE id=?")
			echo $mysql->error;
			
			// replace the ? mark
			$stmt->bind_param("i",$_GET["edit"]);
			
	}
?>

<?php
			$dataExists = false;
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
			$name = $_POST["name"];
			$Login_id = $_POST["Login_id"];
			$date = $_POST["date"];
			$genre = $_POST["genre"];
			$description = $_POST["description"];
				if($name && $Login_id && $date && $genre)
					{
			$dataExists = true;
					}
				}
?>
<a href="table.php">table</a>
<h2> First application </h2>

<form method="get">

	<label for="name">To:<label><br>
	<input type="text" name="name"><br>
	
	<label for="from">From:<label><br>
	<input type="text" name="from"><br>
	
	<label for="message">Message:<label><br>
	<input type="text" name="message"><br>
	
	
	<input type="submit" value="Save to DB">
	
	
<form>	