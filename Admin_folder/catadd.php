<?php 


include("../Header.php");


if($_SESSION['level'] != "Admin" and $_SESSION['level'] != "SAdmin")
{
	header("Location: ../main.php");
}


$sql="SELECT * FROM Kategorier";
$kanin = mysqli_query($conn, $sql);
$id = $kanin->num_rows;

?>
<br>
<br>
<div style="margin-left: 28vw; margin-top: 5vh;">
	<form action="savechanges.php?add=yes&id=<?php echo $id;?>" method="post">
		<input type="text" name= "main" placeholder="Indsæt overkategori" class="addeddit">
		<input type="text" name= "sub" placeholder="Indsæt underkategorier, seperer med komma" class="addeddit">
        <input type="submit" name="submit" value="Tilføj" style="height:5vh; width: 5vw;" ></div><br>
	</form>
</div>




<?php
include("../Footer.php");
?>