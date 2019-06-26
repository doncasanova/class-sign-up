<?php
require('db.php');
include("auth.php");
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Welcome</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
  </head>

  <body>

	<?php include "templates/header.php"; ?>
		<div class="row d-flex justify-content-center">
			<ul class="list-group-flush">
				<li class="list-group-item"><a href="create.php"><button class="btn btn-primary mb-2"><strong>Sign Up</strong></button></a></li>
				<li class="list-group-item"><a href="read.php"><button class="btn btn-primary mb-2 mt-2"><strong>Class List</strong></button></a></li>
				<li class="list-group-item"><a href="update.php"><button class="btn btn-primary mb-2 mt-2"><strong>Update Student Info</strong></button></a></li>
				<li class="list-group-item"><a href="delete.php"><button class="btn btn-primary mt-2 "><strong>Remove Student from Class list</strong></button></a></li>
			</ul>
		</div>
	<?php include "templates/footer.php"; ?>
  </body>
</html>
