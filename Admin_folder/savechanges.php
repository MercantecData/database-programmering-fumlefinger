<?php
	include("../Header.php"); 

	if($_SESSION['level'] != "Admin" and $_SESSION['level'] != "SAdmin")
	{
		header("Location: ../main.php");
	}

    $main = "test";
    $sub = "test2";
    
    if(isset($_GET['add'])) {
        $id = $_GET['id'] +1;
        $main = $_POST['main'];
        $sub = $_POST['sub'];
        $sql = "INSERT INTO Kategorier (id,maincat,subcat) VALUES ('$id', '$main', '$sub')";
        if ($result = mysqli_query($conn, $sql)) {
            header("Location: ../Admin_folder/adminpage.php");
        }
    }
    
    else if(isset($_GET['edd'])) {
        $count = $_GET['edd'];


        for ($i = 1; $i < $count+1; $i++) {
            
            $main = $_POST['main'.$i];
            $sub = $_POST['sub'.$i];
            $sql = "UPDATE Kategorier SET maincat = '".$main."', subcat = '".$sub."' WHERE id = $i";
            if($result = mysqli_query($conn, $sql)) {
            
            }
            
            
        }
       header("Location: ../Admin_folder/adminpage.php");
    }

    else if(isset($_GET['del'])) {
        $id = $_GET['del'];
        $count = $_GET['count'];

        $sql = "DELETE FROM Kategorier WHERE id = $id";
        mysqli_query($conn, $sql);
        
        for ($i = $id; $i < $count + 1; $i++) {
            $sql = "UPDATE Kategorier SET id = '".$i."' WHERE id = $i+1";
            mysqli_query($conn, $sql);
        }
        header("Location: ../Admin_folder/adminpage.php");
    }
?>  

    