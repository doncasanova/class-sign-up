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
<?php require "templates/header.php"; ?>

<?php if ($success) echo $success; ?>

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
</div>
</div>

<a href="index.php"><button class="btn btn-primary m-1">Back to home</button></a>

<?php require "templates/footer.php"; ?>