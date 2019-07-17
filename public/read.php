

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
				<div class="jumbotron readCSS">
					<div class="row d-flex justify-content-center">
						<ul class="">
							<li class=""><a href="lathe.php"><button class="btn btn-dark m-1">Lathe</button></a></li>
							<li class=""><a href="mill.php"><button class="btn btn-dark m-1">Mill</button></a></li>
							<li class=""><a href="advanced-mill.php"><button class="btn btn-dark m-1">Advanced Mill</button></a></a></li>
							<li class=""><a href="macro.php"><button class="btn btn-dark m-1">Macro</button></a></a></li>
						</ul>
					</div>
				</div>
			</div>
	 </body>
	 <div class="row d-flex justify-content-center">
		<?php require "templates/footer.php"; ?>
	</div>
 </html>




