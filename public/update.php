<?php

/**
  * List all users with a link to edit
  */

try {
  require "../config.php";
  require "../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM students";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

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
		<td><?php echo escape($row["firstname"]); ?> <?php ?> <?php echo escape($row["lastname"]); ?></td>
		<td><?php echo escape($row["email"]); ?></td>
		<td><?php echo escape($row["company"]); ?></td>
		<td><?php echo escape($row["class"]); ?></td>
		<td><?php echo escape($row["classstart"]); ?> </td>
		<td><a href="update-single.php?id=<?php echo escape($row["id"]);?>< button class="btn btn-primary" >Edit</a></td>
	</tr>
  <?php endforeach; ?>
  </tbody>
</table>
</div>
</div>

<a href="index.php"><button class="btn btn-primary m-1">Back to home</button></a>


