<?php ob_start();

require_once('auth.php');

$page_title = 'Books';
//embed the header
require_once('header.php');
try {
//connect to the database
    require_once('db.php');
//set up the sql query
    $sql = "SELECT * FROM books";

//run the query and store the results
    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $arabook = $cmd->fetchAll();
//start out grid
    echo '<table class="table table-striped"><thead><th>title</th><th>author</th><th>year</th><th>Edit</th><th>Delete</th></thead><tbody>';
//create a loop that goes through the query results and dispay
    foreach ($arabook as $currentbook) {
        echo '<tr><td>' . $currentbook['title'] . '</td>
				<td>' . $currentbook['author'] . '</td>
				<td>' . $currentbook['year'] . '</td>
				<td><a href="book.php?book_id=' . $currentbook['book_id'] . '">Edit</a>
				<td><a onclick="return confirm(\'Are you sure you want to delete this book ? \');" href="delete-book.php?book_id=' . $currentbook['book_id'] . '">Delete</a></td></tr>';
    }
//close the grid
    echo '</tbody></table>';
//each record on our page
    $conn = null;
}catch(Exception $e){
    header('location:error.php');
    mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
}
require_once("footer.php");
ob_flush();
?>