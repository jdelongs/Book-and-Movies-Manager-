<?php ob_start();
    //access existing session
    session_start();

    //remove all session varibles
    session_unset();

    //destroy user session
    session_destroy();

    //redirect to login screen
    header('location:login.php');
ob_flush();?>