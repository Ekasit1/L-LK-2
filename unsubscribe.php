<?php  
if(isset($_POST["email"])) { // kollar om man vill avsluta sin prenumerera, om man vill det körs koden nedan
	require("sql.php");
    $sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
    $list = $sql->get("SELECT * FROM maillista WHERE email = \"".$_POST["email"]."\";"); // rad 5-7 kollar om du finns i listan och om du gör det så tas du bort från listan
    if(count($list) !== 0) {
    	$ok = $sql->set("DELETE FROM maillista WHERE email = \"".$_POST["email"]."\";");
	    if($ok == false) {
	    	header("Location: index.php?msg=4");
	    } else {
	    	header("Location: index.php?msg=3");
	    }
    } else {
    	header("Location: index.php?msg=4");
    }  
} else {
?>
    <form action="unsubscribe.php" method="POST">
        <input type="email" name="email" placeholder="Email adress">
        <button type="submit">Unsubscribe</button> 
    </form>
<?php
}
?>