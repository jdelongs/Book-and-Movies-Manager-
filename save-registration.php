<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    <title>Saving Registration</title>
    </head>
    <body>
    <?php
        //1. store form inputs in variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm'];

        $ok = true;
        //2. validate the inputs - no blanks, matching password
        if(empty($username)){
            echo 'A username is required <br />';
            $ok = false;
        }
        //3. if inputs are ok connect
        if (empty($password)){
            echo 'password is required <br />';
            $ok = false;
        }
        if (empty($confirm)){
            echo 'Confirming your password is required <br />';
            $ok = false;
        }
        if ($password != $confirm){
            echo 'passwords must match <br />';
            $ok = false;
        }

        //3. if inputs are ok connect
        if($ok) {


            try {
                require_once('db.php');

                //4. set up the sql command
                $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

                //5. hash the password for added security
                $hashed_password = hash('sha512', $password);

                //6. excute the save
                $cmd = $conn->prepare($sql);

                $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
                $cmd->bindParam(':password', $hashed_password, PDO::PARAM_STR, 128);

                $cmd->execute();

                //7. disconnect
                $conn = null;
            //catch error
            }catch(Exception $e){
                header('location:error.php');
                mail('johnboy.jd51@gmail.com', 'COMP1006 Web App Error', $e, 'From:errors@comp1006webapp.com');
            }
            //8. show a confirmation message to the user
            echo 'registration has been submitted';
        }
    ?>
    </body>
</html>