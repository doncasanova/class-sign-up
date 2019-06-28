<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */


  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM students
    WHERE completed = 0
	AND class LIKE 'mill' ";

    $completed = $_POST['completed'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':completed', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
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

			<?php include "templates/header.php"; ?>

		<div class="row d-flex justify-content-center">
			<div class="jumbotron test">

			<?php
			if (isset($_POST['submit'])) {
			  if ($result && $statement->rowCount() > 0) { ?>
				<div class="content">
					<div class="row d-flex justify-content-center">
						<h2>List of current students</h2>
					</div>
					<div class="row d-flex justify-content-center">
						<table class="table ml-3">
							<thead>
								<tr>
									<th scope="col-3">Name</th>
									<th scope="col-3">Email Address</th>
									<th scope="col-3">Company</th>
									<th scope="col-3">Class</th>
									<th scope="col-3">Class Start</th>
								</tr>
							</thead>
							<tbody>
									<?php foreach ($result as $row) { ?>
								<tr>
									<td><?php echo escape($row["firstname"]); ?> <?php ?>   <?php echo escape($row["lastname"]); ?></td>
									<td><?php echo escape($row["email"]); ?></td>
									<td><?php echo escape($row["company"]); ?></td>
									<td><?php echo escape($row["class"]); ?></td>
									<td><?php echo escape($row["classstart"]); ?> </td>
								</tr>
									<?php } ?>
							</tbody>
						</table>
					</div>


						  <?php } else { ?>
								<div class="row d-flex justify-content-center">
									<h3>No results found for Mill</h3> <?php echo escape($_POST['location']); ?>.
								</div>
						  <?php }
						} ?>


						<div class="row d-flex justify-content-center">
							<form method="post">
							<button type="submit" class="btn btn-dark m-1" name="submit" value="Show List">Show List</button>
							</form>
						</div>
						<div class="row d-flex justify-content-center">
							<a href="index.php"><button class="btn btn-dark m-1">Back to home</button></a>
						</div>
				</div>
					<?php require "templates/footer.php"; ?>
	</body>
</html>