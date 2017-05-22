<?php  
session_name("blog");
session_start();
if(isset($_POST["email"])) { // kollar om man vill prenumerera, om man vill det körs koden nedan
	require("sql.php");
    $sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
    $list = $sql->get("SELECT * FROM maillista WHERE email = \"".$_POST["email"]."\";"); // rad 7-9 kollar om du finns i listan och i så fall lägger den till dig i listan
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