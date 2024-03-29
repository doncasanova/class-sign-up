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
	AND class LIKE 'basic lathe' ";

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
    <link rel="stylesheet" href="/css/style.css" />
  </head>

	<body class="indexBackGround">

			<?php include "templates/header.php"; ?>

		<div class="row d-flex justify-content-center">
			<div class="jumbotron classList">

			<?php
			if (isset($_POST)) {
			  if ($result && $statement->rowCount() > 0) { ?>
				<div class="content">
					<div class="row d-flex justify-content-center">
						<h2>List of current Lathe students</h2>
					</div>
					<div class="row d-flex justify-content-center">
						<table class=" col-12 table mill">
							<thead>
								<tr>
									<th scope="">Name</th>
									<th scope="">Email Address</th>
									<th scope="">Company</th>
									<th scope="">Class</th>
									<th scope="">Class Start</th>
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
						<?php } else { ?>
								<div class="row d-flex justify-content-center">
									<h3>No results found for Lathe</h3> <?php echo escape($_POST['location']); ?>.
								</div>
						  <?php }
						} ?>
					</div>  
				</div>
					<?php require "templates/footer.php"; ?>
	</body>
</html>