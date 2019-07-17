<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
	<body class="indexBackGround">
		<?php
			require('db.php');
			// If form submitted, insert values into the database.
			if (isset($_REQUEST['lastname'])){
					// removes backslashes
				$firstname = stripslashes($_REQUEST['firstname']);
				$lastname = stripslashes($_REQUEST['lastname']);
				$companyname = stripslashes($_REQUEST['company']);
					//escapes special characters in a string
				$lastname = mysqli_real_escape_string($con,$lastname); 
				$email = stripslashes($_REQUEST['email']);
				$email = mysqli_real_escape_string($con,$email);
				$password = stripslashes($_REQUEST['password']);
				$password = mysqli_real_escape_string($con,$password);
				$trn_date = date("Y-m-d H:i:s");
					$query = "INSERT into `users` (firstname, lastname, email, company, password, admin, trn_date)
			VALUES ('$firstname', '$lastname', '$email', '$companyname', '".md5($password)."', 0, '$trn_date')";
					$result = mysqli_query($con,$query);
					if($result){
						echo "<div class='form'>
			<h3>You are registered successfully.</h3>
			<br/>Click here to <a href='login.php'>Login</a></div>";
					}
				}else{
			?>


			<?php require "templates/header.php"; ?>

			<div class="row d-flex justify-content-center logIn">
			<div class="form">
				<h1>Registration</h1>
				<form name="registration" action="" method="post">
					<input type="text" name="firstname" placeholder="First Name" required />
					<input type="text" name="lastname" placeholder="Last Name" required />
					<input type="email" name="email" placeholder="Email" required />
					<input type="text" name="company" placeholder="Company Name" required />
					<input type="password" name="password" placeholder="Password" required />
					<input type="submit" name="submit" value="Register" />
				</form>
			</div>
		<?php } ?>
	</body>
</html>