<?php
@ob_start();
session_start();



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
		<?php include "templates/student-header.php"; ?>
		<div class="row d-flex justify-content-center">
			<h3>
			
			<?php echo $_SESSION['firstname']; ?>, Thank you for Joining our <?php echo $_SESSION['classname']; ?> Class.
			
			</h3>
			
		</div>
		
	</body>
	<div class="row d-flex justify-content-center">
		<?php require "templates/footer.php"; ?>
	</div>
 </html>