<?php

/**
  * List all users with a link to edit
  */

try {
  require "../config.php";
  require "../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT *
    FROM students
    WHERE completed = 0";

  $statement = $connection->prepare($sql);
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

	<?php require "templates/header.php"; ?>

	<div class="content">
		<div class="row d-flex justify-content-center">	
			<h2>List of current students</h2>
		</div>
		<div class="row d-flex justify-content-center">
			<table class="table ml-3">
				<thead class="borderless">
					<tr>
					<th scope="col-3">Name</th>
					<th scope="col-3">Email Address</th>
					<th scope="col-3">Company</th>
					<th scope="col-3">Class</th>
					<th scope="col-3">Class Start</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($result as $row) : ?>
					<tr>
						<td><?php echo escape($row["firstname"]); ?> <?php ?> <?php echo escape($row["lastname"]); ?></td>
						<td><?php echo escape($row["email"]); ?></td>
						<td><?php echo escape($row["company"]); ?></td>
						<td><?php echo escape($row["class"]); ?></td>
						<td><?php echo escape($row["classstart"]); ?> </td>
						<td><a href="update-single.php?id=<?php echo escape($row["id"]);?>< button class="btn btn-dark" >Edit</a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
		<div class="row d-flex justify-content-start ml-3">
		<a href="all-students.php"><button class="btn btn-dark m-1">List All Students</button></a>
	</div>

</body>
