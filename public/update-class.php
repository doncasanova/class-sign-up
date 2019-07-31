<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "../config.php";
require "../common.php";
$class = $_GET['id'];


if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "classname" => $_POST['classname'],
      "classsize"  => $_POST['classsize'],
	  "classyear"   => $_POST['classyear'],
      "quarter"     => $_POST['quarter'],
	  "completed" => $_POST['completed']
    ];

    $sql = "UPDATE classes
            SET id = $class,
              classname = :classname,
              classsize = :classsize,
              classyear = :classyear,
              quarter = :quarter,
			  completed = :completed
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM classes WHERE id = $class";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
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
				<div class="jumbotron updateList">
					<div class="row d-flex justify-content-center">
						<h2>Update Class Info</h2>
					</div>
					<div class="row d-flex justify-content-center">
						<?php if (isset($_POST['submit']) && $statement) : ?>
						<h3><?php echo escape($_POST['firstname']); ?> successfully updated.</h3>
						<?php endif; ?>
					</div>

					<div class="row d-flex justify-content-center">

						<form method="post">
							<button type="submit" class="btn btn-dark ml-3" name="submit" value="Update">Update</button>
								<?php foreach ($user as $key => $value) : ?>
			
										<ul class= "col-12 col-sm-6 list-group-flush">
											<li class="list-group-item upDateLabel">
												<label class= "m-0" for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
												<input class= "m-0" type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
											</li>
										</ul>
			
								<?php endforeach; ?>	
						</form>

					</div>
					</div>

			</div>


		</body>
		<div class="row d-flex justify-content-center">
			<?php require "templates/footer.php"; ?>
		</div>
</html>