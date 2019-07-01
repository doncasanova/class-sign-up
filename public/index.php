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
    <link rel="stylesheet" href="/css/style.css" />
  </head>

  <body class="indexBackGround">

	<?php include "templates/header.php"; ?>

	<div class="row d-flex justify-content-center">
		<div class="jumbotron indexCSS">
			<div class="row d-flex justify-content-center">
				<ul class="">
					<li class=""><a href="create.php"><button class="btn btn-dark mb-2">Sign Up</button></a></li>
					<li class=""><a href="read.php"><button class="btn btn-dark mb-2 mt-2">Class List</button></a></li>
					<li class=""><a href="current-students.php"><button class="btn btn-dark mb-2 mt-2">Update Student Info</button></a></li>
					<li class=""><a href="delete.php"><button class="btn btn-dark mt-2 ">Remove Student from Class list</button></a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php include "templates/footer.php"; ?>
  </body>
</html>
