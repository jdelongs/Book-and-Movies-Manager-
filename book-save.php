<?php ob_start();

require_once('auth.php');

$page_title = 'Saving your Book...';

require_once('header.php');

// store the book_id if we are editing.  if we are adding, this value will be empty (which is ok)
$book_id = $_POST['book_id'];
$title = $_POST['title'];
$author = $_POST['author'];
$year = $_POST['year'];


$ok = true;


if (empty($title)) {

    echo 'Title is required<br />';

    $ok = false;
}
if (empty($author)) {

    echo 'Author is required<br />';

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


if ($ok == true) {
    try {
        //connect to the database
        require_once('db.php');
        if (empty($book_id)) {
            // set up the SQL INSERT command
            $sql = "INSERT INTO books (title, author, year) VALUES (:title, :author, :year)";
        } else {
            // set up the SQL UPDATE command to modify the existing book
            $sql = "UPDATE books SET title = :title, author = :author, year = :year WHERE book_id = :book_id";
        }

        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':title', $title, PDO::PARAM_INT, 50);
        $cmd->bindParam(':author', $author, PDO::PARAM_INT);
        $cmd->bindParam(':year', $year, PDO::PARAM_INT);
        // fill the book_id if we have one
        if (!empty($book_id)) {
            $cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);
        }


        $cmd->execute();
        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }
    header('location:book-get.php');
}
require_once('footer.php');
ob_flush();?>