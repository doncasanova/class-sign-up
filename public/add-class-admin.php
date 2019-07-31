<?php
session_start();

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
      "classname" => $_POST['classname'],
      "classsize"  => $_POST['classsize'],
      "classyear"       => $_POST['classyear'],
	  "quarter"       => $_POST['quarter'],
	  "completed" => 0,
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"classes",
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
	<?php include "templates/header.php"; ?>
	
		<div class="row d-flex justify-content-center">
			<h3>
			<?php if (isset($_POST['submit']) && $statement) { ?>
			New <?php echo $_POST['classname']; ?> has been added for  <?php echo $_POST['quarter']; ?> <?php echo $_POST['classyear']; ?>.
			<?php } ?>
			</h3>
		</div>
		<div class="row d-flex justify-content-center">
			<div class="jumbotron signUpCSS">
				<div class="row d-flex justify-content-center ml-3">
					<form method="post">
					  <div class="form-group">
						<label for="formGroupExampleInput">Class Size</label>
						<input type="value" class="form-control" name="classsize" id="classsize" placeholder="Class Size" required>
					  </div>
					  <div class="form-group">
						<label for="formGroupExampleInput2">Year</label> 
						<input type="date" class="form-control" name="classyear" id="classyear" placeholder="Year" required>
					  </div>
					  <div class="form-group">
						<p class="p3">
							<input type="radio" name="classname" value="Basic Lathe" required/>
							Lathe
							<input type="radio" name="classname" value="Basic Mill" required/>
							Mill
							<input type="radio" name="classname" value="Advanced Mill" required/>
							Advanved Mill
							<input type="radio" name="classname" value="Macro" required/>
							Macro
						</p>
					  </div>
					   <div class="form-group">
						<p class="p3">
							<input type="radio" name="quarter" value="Spring" required/>
							Spring 
							<input type="radio" name="quarter" value="Summer" required/>
							Summer
							<input type="radio" name="quarter" value="Fall"required />
							Fall
							<input type="radio" name="quarter" value="Fall/Winter" required/>
							Fall/Winter
						</p>
					  </div>
					  <a href="index.php"><button type="submit" class="btn btn-dark" name="submit" value="Submit">Submit</button></a>
					</form>
				</div>
			</div>
		</div>
	</body>
		<div class="row d-flex justify-content-center">
			<?php require "templates/footer.php"; ?>
		</div>

 </html>