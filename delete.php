<?php
include("Header.php");

$main = "no";

if(isset($_GET['id'])) $toid = $_GET['id'];

if(isset($_GET['pid'])) $id  = $_GET['pid'];

if(isset($_GET['main'])) $main = "yes";

$scheck = $_SESSION['level'];

if($scheck == "" or $scheck == "user") {

    header('Location: '."main.php");
}

if ($main == "yes") {
    $sql = "DELETE FROM post WHERE post_id = $toid";
    $sql2 = "DELETE FROM reply WHERE reply_toid = $toid";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: '."main.php");
}

if ($main == "no") {
    $sql = "DELETE FROM reply WHERE reply_id =$toid";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: '."Showpost.php?id=".$id);
}



?>