<?php ob_start();

require_once('auth.php');

//set up the title
$page_title = 'Movie Details';
// embed the header
require_once('header.php');

if (empty($_GET['movie_id']) == false) {
$movie_id = $_GET['movie_id'];

// connect
try {
    require_once('db.php');

// write the sql query
    $sql = "SELECT * FROM movies WHERE movie_id = :movie_id";

// execute the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
    $cmd->execute();
    $movies = $cmd->fetchAll();

// populate the fields for the selected movie from the query result
    foreach ($movies as $movie) {
        $title = $movie['title'];
        $length = $movie['length'];
        $year = $movie['year'];
        $url = $movie['url'];
    }

// disconnect
    $conn = null;
}catch(Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
}
?>
<div class="container">
    <h1>Movie Details</h1>
    <form method="post" action="save-movie.php">
        <fieldset class="form-group">
            <label for="title" class="col-sm-2">Title:</label>
            <input name="title" id="title" required value="<?php echo $title; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="year" class="col-sm-2">Year:</label>
            <input name="year" id="year" required type="number" min="1990" max="2018" value="<?php echo $year; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="length" class="col-sm-2">Length:</label>
            <input name="length" id="length" required type="number" min="1" max="10" value="<?php echo $length; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="url" class="col-sm-2">URL:</label>
            <input name="url" id="url" required type="url" value="<?php echo $url; ?>" />
        </fieldset
        <fieldset>
        <input name="movie_id" type="hidden" value="<?php echo $movie_id; ?>" />
        </fieldset>
        <button type="submit" class="col-sm-offset-2 btn btn-success">Submit</button>
    </form>
</div>
<?php
require_once('footer.php');
ob_flush();?>
