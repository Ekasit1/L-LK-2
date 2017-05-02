<?php  
session_name("blog");
session_start();
if(isset($_POST["email"])) {
	require("sql.php");
    $sql = new sql();
    $list = $sql->get("SELECT * FROM maillista WHERE email = \"".$_POST["email"]."\";");
    if(count($list) === 0) {
    	$ok = $sql->set("INSERT INTO maillista (email) VALUES (\"".$_POST["email"]."\");");
	    if($ok == false) {
	    	header("Location: index.php?msg=4");
	    } else {
	    	header("Location: index.php?msg=1");
	    }
    } else {
    	header("Location: index.php?msg=4");
    }  
}
?>