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
	try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM classes
    WHERE completed = 0 
	AND classsize > 0";

    $completed = $_POST['completed'];
	
    $statement = $connection->prepare($sql);
    $statement->bindParam(':completed', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();			
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
  //-------------------------------------------------------------------------------------------------
  // login
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
		<div class="row d-flex justify-content-center">
			<div class="jumbotron classList">
			
				<div class="row">
						<table class=" col-12 table ">
							<thead>
								<tr>
									<th scope="col-4">Name</th>
									<th scope="col-4">Quarter</th>
									<th scope="col-4">Start Date</th>
									<th scope="col-4">Seats Available</th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($result as $row) { ?>
								<tr>
										<td><?php echo escape($row["classname"]); ?> <?php ?>   <?php echo escape($row["lastname"]); ?></td>
										<td><?php echo escape($row["quarter"]); ?></td>
										<td><?php echo escape($row["classyear"]); ?></td>
										<td class="row d-flex justify-content-center"><?php echo escape($row["classsize"]); ?></td>
										<td><a type="submit" href="more-info.php?id=<?php echo escape($row['id']);?>"< button class="btn btn-dark" >More Info</a></td>
						
								</tr>
							
									<?php } $_SESSION['total'] = escape($row["classsize"]); ?>
									
							</tbody>
						</table>
				</div>
			</div>
		</div>



	<?php } ?>
</body>
</html>