<?php ob_start();

require_once('auth.php');

$page_title = 'Movies';
//embed the header
require_once('header.php');

//connect to the database
try {
    require_once('db.php');
//set up the sql query
    $sql = "SELECT * FROM Movies";

//run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $aramovie = $cmd->fetchAll();
    echo '<a href="movie.php" title="Add a New Movie">Add a new movie</a>';
//start out grid
    echo '<table class="table table-striped"><thead><th>title</th><th>year</th><th>length</th><th>URL</th><th>Edit</th><th>Delete</th></thead><tbody>';
//create a loop that goes through the query results and dispay
    foreach ($aramovie as $movie) {
        echo '<tr><td>' . $movie['title'] . '</td>
				<td>' . $movie['year'] . '</td>
				<td>' . $movie['length'] . '</td>
				<td>' . $movie['url'] . '</td>
				<td><a href="movie.php?movie_id=' . $movie['movie_id'] . '">Edit</a>
				<td><a onclick="return confirm(\'Are you sure you want to delete this movie ? \');" href="delete-movie.php?movie_id=' . $movie['movie_id'] . '">Delete</a></td></tr>';
    }
//close the grid
    echo '</tbody></table>';
//each record on our page
    $conn = null;
}catch (Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}

require_once("footer.php");
ob_flush();
?>


