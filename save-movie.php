<?php ob_start();
require_once('auth.php');

$page_title = 'Saving your movie...';
require_once('header.php');
// store the movie_id if we are editing.  if we are adding, this value will be empty (which is ok)
$movie_id = $_POST['movie_id'];
$title = $_POST['title'];
$year = $_POST['year'];
$length = $_POST['length'];
$url = $_POST['url'];

$ok = true;

if (empty($title)) {
    echo 'Title is required<br />';

    $ok = false;
}

if (empty($year)) {

    echo 'Year is required<br />';

    $ok = false;
}
elseif (is_numeric($year) == false) {
    echo 'Year is invalid<br />';
    $ok = false;
}

if (empty($length)) {

    echo 'Title is required<br />';

    $ok = false;
}
elseif (is_numeric($length) == false) {
    echo 'Length is invalid<br />';
    $ok = false;
}

if (empty($url)) {

    echo 'URL is required<br />';

    $ok = false;
}



if ($ok == true) {
    // connect to the database
    try {
        require_once('db.php');
        // set up the SQL INSERT command
        if (empty($movie_id)) {
            // set up the SQL INSERT command
            $sql = "INSERT INTO movies (title, year, length, url) VALUES (:title, :year, :length, :url)";
        } else {
            // set up the SQL UPDATE command to modify the existing movie
            $sql = "UPDATE movies SET title = :title, year = :year, length = :length, url = :url WHERE movie_id = :movie_id";
        }
        // create a command object and fill the parameters with the form values
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
        $cmd->bindParam(':year', $year, PDO::PARAM_STR, 50);
        $cmd->bindParam(':length', $length, PDO::PARAM_INT);
        $cmd->bindParam(':url', $url, PDO::PARAM_STR, 100);
        // fill the movie_id if we have one
        if (!empty($movie_id)) {
            $cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
        }
        $cmd->execute();
        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
    header('location:movie-get.php');
    echo "movie has been saved";


}

require_once('footer.php');
ob_flush();?>
