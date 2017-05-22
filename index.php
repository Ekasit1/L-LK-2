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
    <link href="css/newsletter.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
if(isset($_GET["msg"])) { // om ett meddelande att visa så kommer det att välja ett från listan
    $msglist = [
        "Det funkade",
        "Du får nu vårt nyhetsbrev",
        "Inlägget har tagits bort",
        "Du får inte vårt nyhetsbrev längre",
        "Error",
        "Otillåten filtyp. filen måste vara JPG, JPEG, PNG eller GIF",
        "file is to big"
    ];
    $onclickcode = "document.getElementById('m2').style.display = 'none';document.getElementById('m1').style.display = 'block'"; // rad 48-50 gör så att om det kommer upp ett felmeddelande som har med inlägget att göra så tar det dig tillbaka till modal en med inlägg. Om det är en annat typ av meddelande så tar det dig inte tillbaka till modalen.
    if($_GET["msg"] < 5) {
        $onclickcode = "document.getElementById('m2').style.display = 'none';";
    }
?>
    <div class="modal" id="m2">
        <div class="modal-content">
            <div class="modal-header modalcolor">
                <button type="button" class="close" onclick="<?php echo $onclickcode; ?>">&times;</button>
                <h4 class="modal-title"><?php
                echo $msglist[$_GET["msg"]];
                 ?></h4>
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
                <a class="navbar-brand theLogo" href="#">Ljud- och Ljus Kontakten</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Upload Form in a Modal -->
    <div class="container">
      <?php
        if(isset($_SESSION["user"])) { // gör så att man kan lägga upp inlägg när man är inloggad 
                    ?>
                    <!-- Button that open up a modal with the Upload-Form -->
                    <button type="button" onclick="document.getElementById('m1').style.display = 'block'">Lägg upp inlägg!</button>
                    <!-- Modal -->
                    <div class="modal " id="m1" role="dialog">
                    <!-- Modal-content -->
                        <div class="modal-dialog">
                            <div class="modal-content modalcolor">
                                    <!-- Close Modal button -->
                                    <div class="modal-header">
                                        <button type="button" class="close" onclick="document.getElementById('m1').style.display = 'none'">&times;</button>
                                        <h4 class="modal-title">Nytt inlägg</h4>
                                    </div>
                                    <div class="modal-body">
                                      <!-- Fileupload button -->
                                <form action="fileupload.php" method="POST" enctype="multipart/form-data" onsubmit="blogpost();">
                                <fieldset>
                                        <label>
                                        <?php
                                        if(isset($_SESSION["fileuploaddata"])) { // gör så att om det kommer ett felmeddelande så sparas vad du skrivit i din titel och textruta så att du inte behöver skriva om det och efter att det funkat att lägga upp så försvinner det som sparades innan.
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
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <div>
                                        <input class="inputs2" type="submit" value="Lägg upp">
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
                <h2 class="page-header">
                    Inlägg
                </h2>
                <!-- Blogg post system -->
<?php
$sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
$page = 1;
if(isset($_GET["page"])) { // rad 149 -153 gör så att vi hämtar rätt data från databasen och att vad som visas och hämtas förändras beroende på vilken sida vi är på
    $page = $_GET["page"];
}
$limiter = floor($page*5)-5;
$list = $sql->get("SELECT * FROM posts ORDER BY datum DESC LIMIT {$limiter}, 5");
foreach ($list as $row) { // gör så att allt i listan skrivs ut i rader
    $date = date("y-m-d H:i", strtotime($row["datum"])); // skriver ut datum när inlägget blev upplagt
    echo <<<OUT
                <h3>
                    {$row["title"]}
                </h3>
                <p class="lead2">
                    av Mattias Andersson
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Postad {$date}</p>
OUT;
    if($row["img"] != "") { // om ingen bild finns så vissas ingen bild 
        echo <<<OUT
<img class="img-responsive" src="{$row["img"]}" alt="bild">
OUT;
    }
    echo <<<OUT
                <br>
                <p>{$row["post"]}</p>

OUT;
    if (isset($_SESSION["user"])) { // gör så att om du är inloggad så sysn knappen för att ta bort inlägg
        echo <<<OUT
                <a href="delete.php?id={$row["id"]}"><button type="button">Ta bort inlägg</button></a>

OUT;
    }
    echo "<hr>";
}
?>


                <!-- Page changer -->

                <!--<button type="button" class="readMore"><a herf="#"><span class="glyphicon glyphicon-chevron-down randomAlign"></span></a></button>
-->



              <ul class="pager">
<?php
$count = $sql->get("SELECT COUNT(*) AS c FROM posts"); // räknar ut antalet sidor vi har 
$antal = $count[0]["c"]/5;
$lastpage = ceil($antal);
                if($page > 1) {
?>
                    <li class="previous">
                        <a href="index.php?page=<?php echo $page-1; ?>">Newer &rarr;</a>
                    </li>
<?php
}
                if($page < $lastpage) {
?>
                    <li class="next">
                        <a href="index.php?page=<?php echo $page+1; ?>">&larr; Older</a>
                    </li>
<?php
}
?>
                </ul>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Om Mig</h4>
                    <div class="row">
                        <div class="col-lg-4">
                          <img src="me.jpg" width="120%" height="120%">
                          <p></p>

                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-8">
                          <p>"Jag heter Mattias. Jag är ägaren för L&LK (Ljud och Ljus Kontakten).
                            Jag har jobbat med ljud och ljus i 5+ år
                            <br><br>
                            Kontakta mig via (insert num) eller (@)"</p>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- Side Widget Well -->
                <div class="well">
                    <section>
                            <div>
                              <h4>Subscribe</h4>
                              <p>Subscribe to our newsletter to get the latest scoop right to your inbox.<p>
                            </div>
                            <form action="mail.php" method="POST">
                              <input class="inputs3" type="email" name="email" placeholder="Email address">
                              <button type="submit">Subscribe</button>
                            </form>
                    </section>
                </div>
                <div class="well">
                    <section>
                            <div>
                              <h4>Följ oss på Sociala medier</h4>
                            </div>
                            <div class="fb-follow" data-href="https://www.facebook.com/LjudLjusKontakten" data-layout="button_count" data-size="small" data-show-faces="true"></div>
                            <br>
                            <br>
                            <div class="g-follow" data-href="https://plus.google.com/u/0/113858997105593337196" data-rel="{relationshipType}"></div>
                    </section>
                </div>
<?php
if(isset($_SESSION["user"])) { // om du är inloggad kan du klicka på en knapp för att se en lista med alla emails som finns i maillistan 
$sql = new sql(); // skapar ett nytt objekt som gör att vi kan använda sql
$list = $sql->get("SELECT email FROM maillista");
?>
                <div class="well">
                <input class="inputs2" type="button" onclick="document.getElementById('maillista').style.display = 'block';" value="Visa maillista">
                <div id="maillista" style="display: none;">
<?php
                 foreach ($list as $row) {
                    echo $row["email"].";";
}
?>
                </div>
                </div>

<?php
}
?>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container -->
        <!-- Footer -->
        <footer class="footer-color">
            <div>
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2017</p>
                    <!-- Login and logout link -->
                    <?php
                    if(isset($_SESSION["user"])) { // gör att knappen för att logga in sysn när man är utloggad och att knappen för att logga ut syns när man är inloggad
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
