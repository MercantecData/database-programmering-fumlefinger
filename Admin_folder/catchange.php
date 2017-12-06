<?php 
include("../Header.php");

if($_SESSION['level'] != "Admin" and $_SESSION['level'] != "SAdmin")
{
	header("Location: ../main.php");
}

$count = 0;
$line = "";
$sql="SELECT * FROM Kategorier";
$kanin = mysqli_query($conn, $sql);
if ($kanin->num_rows > 0) {
	while($rows = $kanin->fetch_assoc()) {
		$count ++;
		$line.="<br><br><input type='text' name= 'main".$rows['id']."' value='".$rows['maincat']."' class='addeddit'>";
        $line.="<input type='text' name='sub".$rows['id']."' value='".$rows['subcat']."' class='addeddit'>";
		$line.="<input type='submit' name='submity' value='Slet' style='height:5vh; width: 5vw;' onclick='document.getElementById(\"change\").action=\"savechanges.php?del=".$rows['id']."&count=".$kanin->num_rows."\"'>";
	}
}

?>

<div style="margin-left: 28vw; margin-top: 5vh;">
	<form id="change" method="post">
		<?php echo $line;?><br>
        <input type="submit" name="submit" value="Tilføj" style="height:5vh; width: 5vw;" onclick="document.getElementById('change').action='savechanges.php?edd=<?php echo $count;?>';"></div><br>
	</form>
</div>




<?php
include("../Footer.php");
?>