<?php
session_start();
    if(session_destroy())
    {
        header("Location: logout_page.php");
    }
?>