<?php
 session_start();
   $_SESSION['sorry-redo-password'] = "Sorry your passwords don't match please try again.";
						header("Location: registration.php");
?>