<?php
    require("boot.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<?php
if(isset($_GET["msg"])) {
    $msglist = [
        "Otillåten filtyp. filen måste vara JPG, JPEG, PNG eller GIF",
        "",
        ""
    ]
?>
    <div class="modal" id="m2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" onclick="document.getElementById('m2').style.display = 'none';document.getElementById('m1').style.display = 'block'">&times;</button>
                <h3 class="modal-title"><?php 
                echo $msglist[$_GET["msg"]];
                 ?></h3>
            </div>
        </div>    
    </div>
<?php
}
?>

    <!-- Navigation -->
    <nav class="navbar navbar-light navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">Ljud- och Ljus kontakten</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#">Welcome</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li>
                        <a href="#">Posts</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>


    <!-- Upload Form in a Modal -->
    <div class="container">
      <?php
        if(isset($_SESSION["user"])) {
                    ?>
                    <!-- Button that open upp a modal with the Upload-Form -->
                    <button type="button" onclick="document.getElementById('m1').style.display = 'block'">Click</button>
                    <!-- Modal -->
                    <div class="modal " id="m1" role="dialog">
                    <!-- Modal-content -->
                        <div class="modal-dialog">
                            <div class="modal-content">
                                    <!-- Close Modal button -->
                                    <div class="modal-header">
                                        <button type="button" class="close" onclick="document.getElementById('m1').style.display = 'none'">&times;</button>
                                        <h3 class="modal-title">Nytt inlägg</h3>
                                    </div>
                                    <div class="modal-body"> 

                                <form action="fileupload.php" method="POST" enctype="multipart/form-data" onsubmit="blogpost();">
                                <fieldset>
                                        <label>
                                        <?php
                                        if(isset($_SESSION["fileuploaddata"])) {
                                            $title = $_SESSION["fileuploaddata"]["title"];
                                            $message = $_SESSION["fileuploaddata"]["message"];
                                        } else {
                                            $title = "";
                                            $message = "";
                                        }
                                        unset($_SESSION["fileuploaddata"]);
                                        ?>
                                            <input class="modal-inputs" type="text" name="title" placeholder="Insert title here..." value="<?php echo $title; ?>">
                                        </lable>
                                        <label>
                                            <textarea class="modal-inputs" rows="10" cols="50" name="message" placeholder="Posts text.."><?php echo $message; ?></textarea>
                                        </label>
                                        <div>
                                            <input class="modal-inputs" type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <div>
                                        <input type="submit" value="Lägg upp">
                                        </div>
                                </fieldset>        
                                </form>
                                    </div>
                            </div>
                        </div><!--/modal-dialog-->
                 </div>

                    <?php
                    }
                    ?>

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- Blogg post system -->
<?php
$sql = new sql();
$list = $sql->get("SELECT * FROM posts ORDER BY datum DESC");
foreach ($list as $row) {
    $date = date("y-m-d H:i", strtotime($row["datum"]));
    echo <<<OUT
                <h2>
                    {$row["title"]}
                </h2>
                <p class="lead">
                    by Start Bootstrap
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted {$date}</p>
                <hr>
                <img class="img-responsive" src="{$row["img"]}" alt="bild">
                <hr>
                <p>{$row["post"]}</p>
OUT;
}
?>
                <!-- First Blog Post -->
                <hr>

                <!-- Page changer -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column --> 
            <div class="col-md-4">

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

        <hr>

    </div><!-- /.container -->
            
        <!-- Footer -->
        <footer class="footer-color">
            <div>
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2017</p>
                    <!-- Login and logout link -->
                    <?php
                    if(isset($_SESSION["user"])) {
                    ?>
                    <a href="login_script.php?a=logout">Sign out</a>
                    <?php
                    } else {
                    ?>
                    <a href="login_script.php">Admin</a>
                    <?php    
                    }
                    ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AJAX jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <!-- Form.js -->
    <script src="js/forms.js"></script>
</body>

</html>
