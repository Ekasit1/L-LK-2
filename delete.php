<?php
session_name("Blog");
session_start();
if(isset($_SESSION["user"])) { // gör så att om vi är inloggade kan vi ta bort inlägg
    if(isset($_GET["id"])) { // kollar om vi har gått in på länken på rätt sätt och tar då bort det inlägget som vi ville ta bort
    	require("sql.php");
        $sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
        $list = $sql->set("DELETE FROM posts WHERE id = \"".$_GET["id"]."\";");
    } 
    header("Location: index.php?msg=2");
} else {
    echo "hello";
}
?>