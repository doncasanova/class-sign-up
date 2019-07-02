<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);


    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
	  "company"     => $_POST['company'],
      "class"       => $_POST['class'],
	  "completed" => 0,
      "classStart"  => $_POST['classStart']
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"students",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<!DOCTYPE html>
<html lang="en">
	  <head>
		<meta charset="utf-8" />
		<meta http-equiv="x-ua-compatible" content="ie=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title>Welcome</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/style.css" />
	  </head>

	<body class="indexBackGround">

		<?php require "templates/header.php"; ?>
		<div class="row d-flex justify-content-center">
			<h3>
			<?php if (isset($_POST['submit']) && $statement) { ?>
			<?php echo $_POST['firstname']; ?>, Thank you for Joining our <?php echo $_POST['classStart']; ?> <?php echo $_POST['class']; ?> Class.
			<?php } ?>
			</h3>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="jumbotron signUpCSS">
				<div class="row d-flex justify-content-center ml-3">
					<form method="post">
					  <div class="form-group">
						<label for="formGroupExampleInput">First Name</label>
						<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required>
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput2">Last Name</label> 
						<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput2">Email Address</label>
						<input type="text" class="form-control" name="email" id="email" placeholder="Email Address" required>
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput2">Company</label>
						<input type="text" class="form-control" name="company" id="company" placeholder="Company" required>
					  </div>
					  <div class="form-group">
						<p class="p3">
							<input type="radio" name="class" value="Basic Lathe" />
							Lathe
							<input type="radio" name="class" value="Basic Mill" />
							Mill
							<input type="radio" name="class" value="Advanced Mill" />
							Advanved Mill
						</p>
					  </div>
					   <div class="form-group">
						<p class="p3">
							<input type="radio" name="classStart" value="Spring 2019" />
							Spring 2019
							<input type="radio" name="classStart" value="Summer 2019" />
							Summer 2019
							<input type="radio" name="classStart" value="Fall 2019" />
							Fall 2019
							<input type="radio" name="classStart" value="Fall/Winter 2019-20" />
							Fall/Winter 2019-20
						</p>
					  </div>
					  <a href="index.php"><button type="submit" class="btn btn-dark" name="submit" value="Submit">Submit</button></a>
					</form>
				</div>
			</div>
		</div>
		
			<?php require "templates/footer.php"; ?>

	</body>
 </html>