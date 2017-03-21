<!-- Login system -->
<?php 
require("boot.php");
	if (isset($_POST["username"])) { // Kollar om username finns.
		$ok = true;
		if ($_POST["username"] !="admin") {
			$ok = false;
		}
		if ($_POST["password"] !="123") {
			$ok = false;
		}
		if ($ok) { // Kollar om användarnamnent eller lösenordet är korrekt. 
			$_SESSION["user"] = true;
			header("Location: index.php");
		}
	} elseif (isset($_GET["a"])) { //om vi är inloggade så kollar den om du vill logga ut.
		if ($_GET["a"] == "logout") {
			unset($_SESSION["user"]);
			session_destroy();
			header("Location: index.php");
		}
	}
	if (!isset($_SESSION["user"])) { // isset; Kolla om variablen finns. _ ; en databas variable som redan finns. SESSION; via kan nu anväda SESSION_start.
?>
<!-- Login form -->
 <form action="login_script.php" method="POST"> <!-- Formulär för inlogning -->
	<input type="text" name="username" placeholder="Username">
	<input type="password" name="password" placeholder="Password">
	<input type="submit" value="Sign in">
</form>
<?php
	}
 ?>
