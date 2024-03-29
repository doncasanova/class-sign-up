<?php
	session_start();
	$_SESSION['classname'] = 'Basic Lathe';

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
				<div class="content" method="post">
					<div class="row d-flex justify-content-center">
						<h2>List of available classes</h2>
					</div>
					<div class="row d-flex justify-content-center">
						<table class=" col-12 table">
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
								<tr><a href="update-class.php">
									<td><?php echo escape($row["classname"]); ?> <?php ?>   <?php echo escape($row["lastname"]); ?></td>
									<td><?php echo escape($row["quarter"]); ?></td>
									<td><?php echo escape($row["classyear"]); ?></td>
									<td class="row d-flex justify-content-center"><?php echo escape($row["classsize"]); ?></td>
									<td><a type="submit" href="show-class-admin.php?id=<?php echo escape($row['id']);?>"< button class="btn btn-dark" >Show Class</a></td>
									<td><a type="submit" href="update-class.php?id=<?php echo escape($row['id']);?>&total=<?php echo escape($row['classsize']);?>"< button class="btn btn-dark" >Update Class</a></td>
								</a></tr>
							
									<?php }  
									
									?>
									
							</tbody>
						</table>
						 <?php } else { ?>
								<div class="row d-flex justify-content-center">
									<h6>No classes available at this time please check back often and or call 763-560-6567</h6>.
								</div>
						  <?php }
						} ?>
					</div>
				</div>
	</body>
		<div class="row d-flex justify-content-center">
			<?php require "templates/footer.php"; ?>
		</div>


</html>