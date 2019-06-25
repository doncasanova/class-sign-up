<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);


    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
	  "company"     => $_POST['company'],
      "class"       => $_POST['class'],
	  "completed" => 0,
      "classStart"  => $_POST['classStart']
    );

    $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"students",
implode(", ", array_keys($new_user)),
":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_user);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>


<div class="content">
<div class="row d-flex justify-content-center">
<h2>Add a student</h2>
</div>
<div class="row d-flex justify-content-center">
<h3>
<?php if (isset($_POST['submit']) && $statement) { ?>
<?php echo $_POST['firstname']; ?> ,Thank you for Joining our <?php echo $_POST['class']; ?> Class.
<?php } ?>
</h3>
</div>
<div class="row d-flex justify-content-start ml-3">
<form method="post">
  <div class="form-group">
    <label for="formGroupExampleInput">First Name</label>
    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Last Name</label>
    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Email Address</label>
    <input type="text" class="form-control" name="email" id="email" placeholder="Email Address">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Company</label>
    <input type="text" class="form-control" name="company" id="company" placeholder="Company">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Class</label>
    <input type="text" class="form-control" name="class" id="class" placeholder="Class">
  </div>
  <div class="form-group">
    <label for="formGroupExampleInput2">Class Start Date</label>
    <input type="Date" class="form-control" name="classStart" id="classStart" placeholder="Class Start Date">
  </div>
  <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
</form>
</div>
</div>
<div class="row d-flex justify-content-start ml-3 mt-3">
<a href="index.php"><button class="btn btn-primary">Back to home</button></a>
</div>




<?php require "templates/footer.php"; ?>