<?php  
session_name("blog");
session_start();
if(isset($_POST["email"])) {
	require("sql.php");
    $sql = new sql();
    $ok = $sql->set("INSERT INTO maillista (email) VALUES (\"".$_POST["email"]."\");");
    header("Location: index.php?msg=4");
}
?>