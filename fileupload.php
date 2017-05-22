<?php
session_name("Blog");
session_start();
if(isset($_POST["title"])) { // gör så att man kan lägga upp en bild om man har en titel
    if($_FILES["fileToUpload"]["name"] != "") { // rad 5-9 ändrar namnet på filen vi laddar upp till tiden då vi laddade upp den sen kör den resten av koden    
        $_SESSION["fileuploaddata"] = $_POST;
        $target_dir = "uploads/";
        $filename = date("YMdHis");
        $target_file = $target_dir . $filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($target_dir . basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION); // hämtar information om vilken filtyp det är
        // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                header("Location: index.php?msg=5");
                break;
                $uploadOk = 0;
            }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $uploadOk = 0;
            header("Location: index.php?msg=6");
            break;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            header("Location: index.php?msg=5");
            break;
            $uploadOk = 0;
        }
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { // kollar om det går att flytta filen och om det går så flyttas den
            require("sql.php");
            $sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
            $ok = $sql->set("INSERT INTO posts (title, post, img) VALUES (\"".$_POST["title"]."\", \"".$_POST["message"]."\", \"".$target_dir.$filename."\");");
            unset($_SESSION["fileuploaddata"]);
            header("Location: index.php?msg=0");
            break;
        } else {
            header("Location: index.php?msg=6");
            break;
        }
    } else { // gör att om vi inte har laggt uppe n bild så läggs inlägget upp utan bild
        require("sql.php");
        $sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
        $ok = $sql->set("INSERT INTO posts (title, post) VALUES (\"".$_POST["title"]."\", \"".$_POST["message"]."\");");
        unset($_SESSION["fileuploaddata"]);
        header("Location: index.php?msg=0");
        break;
    }
}
?>