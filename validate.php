<?php ob_start();

//starts the session
session_start();

    // store the inputs & hash the password
    $username = $_POST['username'];
    $password = hash('sha512', $_POST['password']);



    try {
        // connect to the database
        require_once('db.php');

        // write the query
        $sql = "SELECT user_id FROM users WHERE username = :username AND password = :password";

        // create the command, run the query and store the result
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
        $cmd->bindParam(':password', $password, PDO::PARAM_STR, 128);
        $cmd->execute();
        $users = $cmd->fetchAll();

        // if count is 1, we found a matching username and password in the database
        if (count($users) >= 1) {
            echo 'Logged in Successfully.';

            foreach ($users as $user) {
                //acceess the current users session
                session_start();

                //store the user identifier in a session varible
                $_SESSION['user_id'] = $user['user_id'];

                //redirect to the subscribers
                header('location:menu.php');
            }
        }else{
            echo 'Invalid Login';
        }

        $conn = null;
    }catch(Exception $e){
        header('location:error.php');
        mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
    }

ob_flush()?>

