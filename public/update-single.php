<?php
/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "../config.php";
require "../common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
	  "company"   => $_POST['company'],
      "class"     => $_POST['class']
    ];

    $sql = "UPDATE students
            SET id = :id,
              firstname = :firstname,
              lastname = :lastname,
              email = :email,
              company = :company,
              class = :class
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
    $sql = "SELECT * FROM students WHERE id = :id";
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

<?php require "templates/header.php"; ?>


 

<div class="row d-flex justify-content-center">
<h2>Update Student Info</h2>
</div>

<div class="row d-flex justify-content-center">
<?php if (isset($_POST['submit']) && $statement) : ?>
<h3><?php echo escape($_POST['firstname']); ?> successfully updated.</h3>
<?php endif; ?>
</div>
<form method="post">
	<div class="row d-flex justify-content-start">
		<?php foreach ($user as $key => $value) : ?>
			<div class="form-group row d-flex justify-content-center">
				<div class= "col-3">
				<label class= "m-0" for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
				
				<input class= "m-0" type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
				</div>
			</div>
		<?php endforeach; ?>
			
	</div>
	<button type="submit" class="btn btn-primary ml-3" name="submit" value="Update">Primary</button>
	<a class= "ml-3" href="index.php">Back to home</a>
</form>



<?php require "templates/footer.php"; ?>

