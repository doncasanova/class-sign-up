<?php
@ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="indexBackGround">
	<?php
	require('db.php');
	// If form submitted, insert values into the database.
	if (isset($_POST['email'])){
			// removes backslashes
		$username = stripslashes($_REQUEST['email']);
			//escapes special characters in a string
		$username = mysqli_real_escape_string($con,$username);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		//Checking is user existing in the database or not
			$query = "SELECT * FROM `users` WHERE email='$username'
	and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$query2 = "SELECT id, firstname, lastname, email, company, admin FROM `users` WHERE email='$username'";
	$result2 = mysqli_query($con,$query2) or die(mysql_error());
		 
		//$admin = 1; 
		if ($result2->num_rows > 0) {
    // output data of each row
		while($row = $result2->fetch_assoc()) {
       $admin = $row["admin"];
			$_SESSION['firstname'] = $row["firstname"];
			$_SESSION['lastname'] = $row["lastname"];
			$_SESSION['email'] = $row["email"];
			$_SESSION['company'] = $row["company"];
			$_SESSION['stundentid'] = $row["id"];
			}
}		else {
			echo "0 results";
}
		$rows = mysqli_num_rows($result);
		
			if($rows==1 && $admin == 1){
			$_SESSION['username'] = $username;
			 $_SESSION['header'] = "templates/header.php";
				// Redirect user to index.php
			header("Location: index.php");
			 }elseif($rows==1 && $admin == 0){ 
			 $_SESSION['username'] = $username;
			 $_SESSION['header'] = "templates/header.php";
			header("Location: student-sign-up.php");
			 
			 }else{
		echo "<div class='form'>
	<h3>Username/password is incorrect.</h3>
	<br/>Click here to <a href='login.php'>Login</a></div>";
		}
		}else{
	?>
	
	<?php require "templates/login-header.php"; ?>

	<div class="row d-flex justify-content-center logIn">
		<div class="form">
			<h1>Log In</h1>
			<form action="" method="post" name="login">
			<input type="email" name="email" placeholder="email" required />
			<input type="password" name="password" placeholder="Password" required />
			<input name="submit" type="submit" value="Login" />
			</form>
			<p>Not registered yet? <a href='registration.php'>Register Here</a></p>
		</div>
	</div>
	<?php } ?>
</body>
</html>