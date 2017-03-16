<!DOCTYPE html>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type" />
        <title><?php echo $page_title; ?></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
    </head>
    <body>

        <nav class="navbar">
            <a href="menu.php" title="COMP1006 Web Application" class="navbar-brand">COMP1006 APP</a>
            <ul class="nav navbar-nav">
                <?php if(!empty($_SESSION['user_id'])) { ?>
                    <li>
                        <a href="movie-get.php" title="Movies">Movies</a>
                    </li>
                    <li>
                        <a href="book-get.php" title="books">Books</a>
                    </li>
                    <li>
                        <a href="logout.php" title="logout">Log Out</a>
                    </li>
                    <?php
                }
                else{ ?>
                    <li>
                        <a href="register.php" title="register">Register</a>
                    </li>
                    <li>
                        <a href="login.php" title="Login">Login</a>
                    </li>
                <?php }?>
            </ul>
        </nav>
<!-- page content starts here -->