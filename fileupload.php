<?php
session_name("Blog");
session_start();
if(isset($_FILES["fileToUpload"])) {
    $_SESSION["fileuploaddata"] = $_POST;
    $target_dir = "uploads/";
    $filename = date("YMdHis");
    $target_file = $target_dir . $filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_dir . basename($_FILES["fileToUpload"]["name"]), PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["title"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            header("Location: index.php?msg=1");
            break;
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        header("Location: index.php?msg=2");
        break;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        header("Location: index.php?msg=1");
        break;
        $uploadOk = 0;
    }
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        require("sql.php");
        $sql = new sql();
        $ok = $sql->set("INSERT INTO posts (title, post, img) VALUES (\"".$_POST["title"]."\", \"".$_POST["message"]."\", \"".$target_dir.$filename."\");");
        unset($_SESSION["fileuploaddata"]);
        header("Location: index.php?msg=0");
        break;
    } else {
        echo "Sorry, there was an error uploading your file.";
        header("Location: index.php?msg=3");
        break;
    }
}
?>