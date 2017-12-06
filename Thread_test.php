<?php
		include("Header.php");
		$edit = "no";
		if(isset($_GET['edit'])) $edit = "yes";
		if(isset($_GET['id'])) $id = $_GET['id'];
		$error = "";
		$text = HTMLSPECIALCHARS($_POST["Beskrivelse"], ENT_QUOTES);
		$title = HTMLSPECIALCHARS($_POST["Title"], ENT_QUOTES);
		$submit = $_POST["button"];
		$mysqltime = date ("Y-m-d H:i:s");
		$kate = $_POST["vælge_en_kategori"];

		$kate = explode("/",$kate);
		$maincat = $kate[0];
		$subcat = $kate[1];

		
if(isset($_POST["button"]))
{
	if(empty($_POST["Beskrivelse"]) || empty($_POST["Title"]) || empty($_POST["vælge_en_kategori"]))
	{
		$error = "Der skal skrives noget i alle felter og vælges en kategori";
		header("location: /thread.php?err=yes");
	}
	else
	{
		if($edit == "yes") {
			$sql = "UPDATE post SET post_content = '$text', post_title = '$title', post_cat = '$maincat', post_subcat = '$subcat' WHERE post_id = '$id'";
		}
		else {
			$sql = "INSERT INTO post (post_content, post_title, post_date, post_subcat, post_by, post_cat) VALUES ('".$text."','".$title."','".$mysqltime."','".$subcat."','".$_SESSION['Brugernavn']."','".$maincat."')";
		}
		echo "<pre>".$sql."</pre>";
		//$db->set_charset("utf8"); DON'T DO THIS!!!
		
			if (mysqli_query($conn, $sql))
			{			
				echo "Data has been sent";
				header("location: /main.php");
			}
	
			else 
			{
				echo $conn->error;
			}
	}
}
	


?>