<?php ob_start();

require_once('auth.php');
    
    // capture the selected movie_id from the url and store it in a variable with the same name
$movie_id = $_GET['movie_id'];
try {
    require_once('db.php');

// set up the SQL command
    $sql = "DELETE FROM movies WHERE movie_id = :movie_id";

// create a command object so we can populate the movie_id value, the run the deletion
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
    $cmd->execute();

//disconnect
    $conn = null;
}catch(Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}
    //redirect the user back to movie-get.php
    header('location:movie-get.php');

    require_once('footer.php');
ob_flush();?>
