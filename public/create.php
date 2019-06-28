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
		<link rel="stylesheet" href="../public/css/style.css" />
	  </head>

	<body class="indexBackGround">

		<?php require "templates/header.php"; ?>
		<div class="row d-flex justify-content-center">
			<div class="jumbotron mt-4">
				<div class="row d-flex justify-content-center">
					<h3>
					<?php if (isset($_POST['submit']) && $statement) { ?>
					<?php echo $_POST['firstname']; ?>Thank you for Joining our <?php echo $_POST['class']; ?> Class.
					<?php } ?>
					</h3>
				</div>
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
						<label for="formGroupExampleInput2">Class</label>
						<input type="text" class="form-control" name="class" id="class" placeholder="Class" required>
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput2">Class Start Date</label>
						<input type="Date" class="form-control" name="classStart" id="classStart" placeholder="Class Start Date" required>
					  </div>
					  <a href="index.php"><button type="submit" class="btn btn-dark" name="submit" value="Submit">Submit</button></a>
					</form>
				</div>
				<div class="row d-flex justify-content-start mt-3">
					<a href="index.php"><button class="btn btn-dark">Back to home</button></a>
				</div>
			</div>
		</div>
		
			<?php require "templates/footer.php"; ?>

	</body>
 </html>