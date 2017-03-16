<?php ob_start();
require_once('auth.php');
    //set the page title
    $page_title = 'Main Menu';
    //embed header
    require_once('header.php');
?>

<main class="container">
    <h1>Comp 1006 Application</h1>
    <ul class="list-group">
        <li class="list-group-item"><a href="movie-get.php" title="Movie">Movie</a></li>
        <li class="list-group-item"><a href="book-get.php" title="Book">Book</a></li>
    </ul>
</main>
<?php
require_once('footer.php');
ob_flush();?>

