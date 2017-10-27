<!DOCTYPE html>
<html>
<?php 
	require_once 'database.php'; 
	session_start();
	
	$first_name ="" ;
	$last_name = "";
	$user_name = "";
	$phone = "";
	$email = "";
	$password ="" ; 
	$confirm_password ="" ; 
	
	if( $_SERVER["REQUEST_METHOD"] == "POST" )
		{
					if($_POST["first_name"]) {
						$first_name = mysql_real_escape_string( trim( $_POST["first_name"] ));
					}
					if($_POST["last_name"]) {
						$last_name = mysql_real_escape_string( trim( $_POST["last_name"] ));
					}
					if($_POST["user_name"]) {
						$user_name = mysql_real_escape_string( trim( $_POST["user_name"] ));
					}if($_POST["phone"]) {
						$phone = mysql_real_escape_string( trim( $_POST["phone"] ));
					}if($_POST["email"]) {
						$email = mysql_real_escape_string( trim( $_POST["email"] ));
					}if($_POST["password"]) {
						$password = mysql_real_escape_string( trim( $_POST["password"] ));
					}if($_POST["confirm_password"]) {
						$confirm_password = mysql_real_escape_string( trim( $_POST["confirm_password"] ));
					}
				
				$isValid = true;
	
				if( $first_name != "" && $last_name != "" && $user_name !="" && $email != "" && $phone != ""  && $password != "" && $confirm_password != "" ) 
				{
						echo 'Your username is ' . $user_name
					. ' and password is ' . $password . '<br>';
					
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
							echo 'Invalid EMAIL<br>';
							$isValid = false;
						}
					
						if($password != $confirm_password) {
							echo 'The password did not matched!!!<br>';
							$isValid = false;
						}
						
						$password = $confirm_password;
				} 
				else
					{
						echo 'Please fill up all fields...';
						$isValid = false;
				    }
				
				if( $isValid ) 
					{
						$query = "INSERT INTO faculty(first_name,last_name,user_name,email,phone,password ) VALUES ('$first_name','$last_name','$user_name','$email','$phone','$password')";
                        $result = @mysql_query($query) or die("Could not process". mysql_error() );
						echo "$result";
                
                        if(!$result) 
						{
							echo "Failed !";
						}
				        else 
				       {
							echo "Successfully added !";
							header("Location: register.php");
				       }
	               }
		}
	   
	   
?>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<h1> <center>SIGN UP</center></h1>
		<form method="POST" action="signup.php">
		
		First name:
			<br>
				<input type="text" name="first_name" >
			<br>
			<br>
		Last name:
			<br>
				<input type="text" name="last_name">
			<br>
			<br>
		User name:
			<br>
				<input type="text" name="user_name" >
			<br>
			<br>
		Phone:
			<br>
				<input type="text" name="phone"><br>
			<br>
		Email:
			<br>
				<input type="text" name="email"><br>
			<br>
		Password:
			<br>
				<input type="password" name="password">
			<br>
			<br>
		Confirm Password:
		    <br>
				<input type="password" name="confirm_password">
			<br>
			<br>
				<!--<input type="submit" value="Sign me up">-->
				<input type="submit" value="Sign Me Up">
			<br>
 </body>
</html>

</body>