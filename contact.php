<!DOCTYPE html>
<html>
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
</head>
<body>
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
                <a class="navbar-brand" href="#">Ljud- och ljus kontakten</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="profile.php">Welcome</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Formulär -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="row">
                    <h1>Kontakta mig</h1> 
                </div>
                <div>
                    <h6>Email*</h6>
                    <form>
                        <input type="email" name="email" placeholder="example@email.com">
                        
                    </form><br>
                    <h6>Namn*</h6>
                    <form>
                        <input type="text" name="name" placeholder="Ditt namn">
                    </form><br>
                    <h6>Medelande*</h6>
                    <textarea rows="10" cols="50" name="messege" form="usrform"></textarea><br>
                    <form>
                        <input type="submit" name="submit">
                    </form><hr><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <!--Sidoblock -->
            <div class="col-sm-4" style="background-color: #e5e5e5;">
                <h1>Kontakta mig här!</h1>
                <br>
                <h4>Gmail</h4>
                <p><a>TheAudioGuy@gmail.com</a></p>
                <hr>
                <h4>Social medier</h4>
                <p>Facebook:</p>
                <p>Instagram:</p>
                <p>Twitter:</p>
                <hr>
                <h4>Övrigt</h4>
                <p>Linkedin:</p>
                <br>
            </div>
        </div>
    </div>