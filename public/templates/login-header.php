<?php
 session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Class Sign Up</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  

  <body class="">

	<div class="content"> 
		<div class="row d-flex justify-content-center mt-4" style="height: 100px;">
			<h1>Welcome to our Class Sign Up Area</h1>
		</div>
		<div class="row d-flex justify-content-center">
			<h1><?php echo $_SESSION['name'];?></h1>
			<h1><?php echo $_SESSION['admin'];?></h1>
		</div>
		<div class="row d-flex justify-content-center">
			<div>
				<img src="/images/midwest-logo.png" alt="Midwest CAM Log">
			</div>
		</div>
	</div>
  </body>

</html>