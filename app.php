<?php
	//require another php file
	// ../../../ means > 3 folders back
	require_once("../../config.php");
	
	$everything_was_okay = true;

	
	//*************************************
	//check if there is variable in the URL
	//*************************************
	
	
	if(isset($_GET["name"])) {
		
		//only if there is name in the URL
		//echo "there is name ";
		
		//if it's empty
		if(empty($_GET["name"])){
			echo "Please, enter the name of the recipient!"."<br>"; //it is empty
			$everything_was_okay = false;
		}else{
			echo "Name: ".$_GET["name"]."<br>"; //its not empty
		}
	}else{
		echo "There is no such thing as name";
		$everything_was_okay = false;
		
	}
	if(isset($_GET["from"])) {
		
		//only if there is from in the URL
		//echo "there is from ";
		
		//if it's empty
		if(empty($_GET["from"])){
			echo "Please, enter your name!"."<br>";	//it is empty
		}else{
			echo "From: ".$_GET["from"]."<br>"; //its not empty
		}
	}else{
		//echo "there is no such thing as from";
		
	}
	if(isset($_GET["message"])){
		
		//only if there is message in the URL
		//echo "there is message ";
		
		//if it's empty
		if(empty($_GET["message"])){
			echo "Please, enter the message!"."<br>"; //it is empty
		}else{
			echo "Message: ".$_GET["message"]."<br>"; //its not empty
		}
	}else{
		//echo "there is no such thing as message";
		
	}
	
	//Getting the message from address
	// if there is ?name= .. then $_GET["name"]
	
	//$my_message = $_GET["message"];
	//$name = $_GET["name"];
	//$from = $_GET["from"];

	
	
	
	//echo $from." says \"".$my_message."\" to ".$name;



// ? was everthing okay
	if($everything_was_okay == true){
		
		echo "Saving to database ...";
		
		//connection with the username and password
		//access username from config
		
		//echo $db_username;
		
		
		
		//1 servername
		//2 username
		//3 password
		//4 database
		$mysql = new mysqli("localhost", $db_username, $db_password, "webpr2016_nicole");
		
		$stmt = $mysql->prepare("INSERT INTO messages_sample(recipient, message, sender) VALUES(?,?,?)");
		
		//echo error
		echo $mysql->error;
		
		// we are replacing question marks with values
		// s -string, date or smth that is based on characters and numbers.
		// i - integer, number
		// d - decimal, floatval
		
		// for each question mark its type with one letter
		$stmt->bind_param("sss", $_GET["name"], $_GET["message"], $_GET["from"]);
		
		//save
		if($stmt->execute()){
			echo "saved sucessfully";
		}else{
			echo $stmt->error;
		}
		
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