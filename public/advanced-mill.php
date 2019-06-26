<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */


  try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM students
    WHERE completed = 0";
		

    $completed = $_POST['completed'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':completed', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
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
  <?php foreach ($result as $row) { ?>
      <tr>
			<td><?php echo escape($row["firstname"]); ?> <?php ?>   <?php echo escape($row["lastname"]); ?></td>
			<td><?php echo escape($row["email"]); ?></td>
			<td><?php echo escape($row["company"]); ?></td>
			<td><?php echo escape($row["class"]); ?></td>
			<td><?php echo escape($row["classstart"]); ?> </td>
      </tr>
    <?php } ?>
      </tbody>
  </table>

</div>


  <?php } else { ?>
    > No results found for <?php echo escape($_POST['location']); ?>.
  <?php }
} ?>


<div class="row d-flex justify-content-center">
<form method="post">
<button type="submit" class="btn btn-primary m-1" name="submit" value="Show List">Show List</button>
</form>
</div>
<div class="row d-flex justify-content-center">
<a href="index.php"><button class="btn btn-primary m-1">Back to home</button></a>
</div>
</div>
<?php require "templates/footer.php"; ?>