<?php
session_name("Blog");
session_start();
if(isset($_SESSION["user"])) {
    if(isset($_GET["id"])) {
    	require("sql.php");
        $sql = new sql();
        $list = $sql->set("DELETE FROM posts WHERE id = \"".$_GET["id"]."\";");
    } 
    header("Location: index.php?msg=2");
} else {
    echo "hello";
}
?>