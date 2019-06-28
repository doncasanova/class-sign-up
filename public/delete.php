<?php

/**
  * Update student to no (1)
  */

require "../config.php";
require "../common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id = $_GET["id"];

    $sql = "UPDATE FROM students WHERE id = :id";
	$sql = "UPDATE students
            SET id = :id,
			 completed = 1
            WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "<div class='row d-flex justify-content-center'><h2>Student successfully removed</h2></div>";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM students WHERE completed = 0";
	
  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php if ($success) echo $success; ?>

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
				  <?php foreach ($result as $row) : ?>
					<tr>
						<td><?php echo escape($row["firstname"]); ?><?php?> <?php ?> <?php echo escape($row["lastname"]); ?></td>
						<td><?php echo escape($row["email"]); ?></td>
						<td><?php echo escape($row["company"]); ?></td>
						<td><?php echo escape($row["class"]); ?></td>
						<td><?php echo escape($row["classstart"]); ?> </td>
						<td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
					</tr>
				  <?php endforeach; ?>
				  </tbody>
			</table>

				<div class="row d-flex justify-content-start mt-3">
					<a href="index.php"><button class="btn btn-dark">Back to home</button></a>
				</div>
		</div>
		</div>
		<?php require "templates/footer.php"; ?>

	</body>
</html>