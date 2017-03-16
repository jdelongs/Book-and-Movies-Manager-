<?php ob_start();
require_once('auth.php');

//set up the title
$page_title = 'Book Details';
// embed the header
require_once('header.php');

    // check the url for a book_id parameter and store the value in a variable if we find one
    if (empty($_GET['book_id']) == false) {
        $book_id = $_GET['book_id'];

        try {
            // connect
            require_once('db.php');

            // write the sql query
            $sql = "SELECT * FROM books WHERE book_id = :book_id";

            // execute the query and store the results
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);
            $cmd->execute();
            $books = $cmd->fetchAll();

            // populate the fields for the selected book from the query result
            foreach ($books as $currentbook) {
                $title = $currentbook['title'];
                $Author = $currentbook['author'];
                $year = $currentbook['year'];

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
        <h1>Book Form</h1>
        <form method="post" action="book-save.php">
            <fieldset class="form-group">
                <label for="title" class="col-sm-2">Title:</label>
                <input name="title" id="title" required value="<?php echo $title; ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="author" class="col-sm-2">Author:</label>
                <input name="author" id="author" required="you must have an author" value="<?php echo $author; ?>"/>
            </fieldset>
            <fieldset class="form-group">
                <label for="year" class="col-sm-2">Year:</label>
                <input name="year" id="year" type="number" required="you must have a year" min="1990" max="2017" value="<?php echo $year; ?>"/>
            </fieldset>
            <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" />

            <button type="submit" class="col-sm-offset-2 btn btn-success">Submit</button>
        </form>
    </div>
<?php
require_once('footer.php');
ob_flush();?>