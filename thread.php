<?php
	
	$error = "";
    if(isset($_GET['err'])) $error = "Der skal skrives noget i alle felter og vælges en kategori";
	include("Header.php");
	$line = "";

	if ($_SESSION['Brugernavn'] == '')
	{
		header("Location: ../Login_folder/login.php");
	}
	
	
	$sql = "SELECT maincat FROM Kategorier";
    $kanin = $conn->query($sql);
    if ($kanin->num_rows > 0) {
        while($row = $kanin->fetch_assoc()) {
           $line.="<Optgroup label='".$row['maincat']."'>".$row['maincat']."</option>";
		   $sql2 = "SELECT subcat FROM Kategorier WHERE maincat = '".$row['maincat']."'";
		   $gullerod = $conn->query($sql2);
		   if ($gullerod->num_rows > 0) {
			   while($row2 = $gullerod->fetch_assoc()) {
				   $subcat = explode(',' , $row2['subcat']);
			   }
		   }
		   foreach($subcat as $value) {
			   $line.="<option value='".$row['maincat']."/".$value."'>".$value."</option>";
		   }
		   $line.="</optgroup>";
        }
    }
	

			
		
?>
		
	<section>
		<div class="threadCreation">

			<div class="wrapper">
				<form class="threadbox2">
					<b><u>Hvordan stiller man et spørgsmål?</u></b><br></br>
					&bull; Tjek om dit spøgersmål ikke er blevet stillet før.<br></br>
					&bull; Skriv en titel der kort beskriver dit spøgersmål<br></br>
					&bull; Læse dit spøgersmål igemmen. Gør det tydeligt hvad du mener<br></br>
					&bull; Husk at vælge hvad kategori dit spøgersmål høre ind under<br></br>
					&bull; Du kan vlæge om du vil har sendt en mail vis nogen svar
				</form>
	
				<form class="threadbox" method="post" action="Thread_test.php" >
					<input type="text" placeholder="Skriv titlen på dit spørgsmål her." name="Title" class="textbox">
					
					<textarea placeholder="Beskriv dit spørgsmål her." rows="4" cols="50" name="Beskrivelse" class="textarea-box"></textarea>
					
					<select name="vælge_en_kategori" class="PickACategorie">
						<?php echo $line;?>
					</select>
				
					<div class="CheckBox">
						<input type="checkbox" name="Email" value="Emailornot"/>
						<label>Send en email hvis der kommer svar.</label>
					</div>
					
					<input type="submit" name="button" value="Submit" class="button" />		
					<b><p3 class="error"><?php echo $error;?></p3></b>
				</form>
			</div>
		</div>
	</section>
		
	<?php 
		include("Footer.php"); 
	?>