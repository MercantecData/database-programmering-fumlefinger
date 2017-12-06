<?php
include("Header.php");

$desc = htmlspecialchars($_POST['Beskrivelse'], ENT_QUOTES);
if(isset($_GET['id'])) $id = $_GET['id'];
$by = $_SESSION['Brugernavn'];
$edit = "false";
$error = "no";
if(isset($_GET['rid'])) $rid = $_GET['rid'];

if(isset($_GET['edit'])) $edit = $_GET['edit'];

if ($edit == "false") {
    if ($by != "") {
        if (!empty($desc)) {
            $sql = "INSERT INTO reply (reply_content, reply_by, reply_toid) VALUES ('".$desc."','".$by."','".$id."')";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            $error = "yes";
        }
        
    }        
}

if ($edit == "true") {
    if ($by != "") {
        if (!empty($desc)) {
            $sql = "UPDATE reply SET reply_content = '$desc' WHERE reply_id = '$rid'";
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            $error = "yes";
        }
    }
}
header('Location: '."Showpost.php?id=".$id."&fe=".$error);

?>