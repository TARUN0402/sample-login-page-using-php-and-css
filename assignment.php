<?php

	$e1 = "";
	$e2 = "";
	$e3 = "";
	$e4 = "";
	$e5 = "";
	$db_c = "";
	$db_s = "";
	$t_c = "";
	$r_i = "";
	$con = "";
	$in_p = "";
	$rep = 0;
	//$row = array();
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		$va = True;
		$va2 = False;
		$u = $_POST['u'];
		$v = $_POST['v'];
		$w = $_POST['w'];
		$x = $_POST['x'];
		$y = $_POST['y'];

		if($u == ""){
			$va = False;
			$e1 = "Mandatory";
		}
		if($v == ""){
			$va = False;
			$e2 = "Mandatory";
		}
		if($w == ""){
			$va = False;
			$e3 = "Mandatory";
		}
		if($x == ""){
			$va = False;
			$e4 = "Mandatory";
		}
		if($y == ""){
			$va = False;
			$e5 = "Mandatory";
		}
		if($v == $w){
			$va2 = True;
		}
		if(!$va2){
			$in_p = "Both Password and Confirm Password are not same!";
		}
		if($va == True and $va2 == True){
			
			// Connecting to the Database
			$servername = "localhost";
			$username = "root";
			$password = "";

			// Create a connection
			$conn = mysqli_connect($servername, $username, $password);
			if ($conn){
				
				$con = "Connection to the datbase server is successful";
				
				//CREATEING DATABASE;
				
				$sql = "CREATE DATABASE db_vit_19bce7451";
				if($rep == 0){
					$result = mysqli_query($conn, $sql);
					$result = true;}

				// Check for the database creation success
				if($result){
					if($rep == 0){
						$db_c = "The db is  successfully created!";}
					
					$sql = "USE db_vit_19bce7451";
					$db_s = mysqli_query($conn,$sql);
					
					if($db_s){
						
						$db_s = "data base is selected";
					
						// Create a table in the db
						$sql = "CREATE TABLE 19bce7451_users
						( 
							user_name VARCHAR(12) NOT NULL,
							password VARCHAR(30) NOT NULL, 
							confirm_password VARCHAR(30) NOT NULL, 
							email VARCHAR(30) NOT NULL, 
							date_of_birth DATE NOT NULL,
							PRIMARY KEY (user_name)
						)";

						if($rep == 0){
						$result = mysqli_query($conn, $sql);}

						// Check for the table creation success
						if($result){
							if($rep == 0){
							$t_C = "The table got created successfully!";}

							// Variables to be inserted into the table

							// Sql query to be executed
							$sql = "INSERT INTO 19bce7451_users(user_name,password,confirm_password,email,date_of_birth) VALUES ('$u', '$v','$w','$x','$y')";

							$result = mysqli_query($conn, $sql);

							if($result){
								$r_i = "The record has been inserted successfully!";
								$rep = $rep+1;
							}
							else{
								$r_i = "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
								$rep = $rep+1;
							}

						}
						else{
							$t_c = "The table was not created successfully because of this error ---> ". mysqli_error($conn);
						}
					}
					
				}
				else{
					$db_c = "The db creation failed because of this error ---> ". mysqli_error($conn);
				}
				
			}
			else{
				
				die("Sorry we failed to connect:". mysqli_connect_error());
			}
			
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Assignment-8</title>
	<link rel="stylesheet" href="19bce7451.css">
</head>
<body>

	<div class="box">
		<form method="post" action="assignment.php">

			<label> User Name: </label><input type="text" name="u"><span>*<?php echo $e1; ?></span><br><br>
			<label> Password: </label><input type="text" name="v"><span>*<?php echo $e2; ?></span><br><br>
			<label> Confirm Password: </label><input type="text" name="w"><span>*<?php echo $e3; ?></span><br><br>
			<label> Email Id: </label><input type="email" name="x"><span>*<?php echo $e4; ?></span><br><br>
			<label> Date of Birth: </label><input type="date" name="y"><span>*<?php echo $e5; ?></span><br><br>
			<center>
			<input type="submit" id="btn" value="Sign-up"><br>
			</center>
			
		</form>
	</div>
	<?php echo $con; ?><br>
	<?php echo $db_c; ?><br>
	<?php echo $db_s; ?><br>
	<?php echo $t_c; ?><br>
	<?php echo $r_i; ?><br>
	<span><?php echo $in_p; ?></span>
	
</body>
</html>