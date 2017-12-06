 <?php
include("../Header.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
$error = "";
if(isset($_GET['err'])) $error = "Der skal skrives noget i alle felter";
if(isset($_GET['uerr'])) $error = "Brugernavnet findes allerede";
if(isset($_GET['eerr'])) $error = "Email er allerede brugt";


?>	
		<h6>Opret din Mercantec Forum konto</h6>
		
		<form method="POST" action="new_user.php">
			<div class="Signupbox"> 
				<input type="text" placeholder="Brugernavn" name="Brugernavn" class="textbox"><br>
				</br>
				<input type="text" placeholder="Navn" name="Navn" class="textbox"><br>
				</br>
				<input type="email" placeholder="E-mail" name="email" class="textbox"><br>
				</br>
				<input type="password" placeholder="Kodeord" name="kodeord" class="textbox"><br>
				</br>
				<input type="Submit" value="Sign Up" class="button"><br>
				</br>
				<p>Har du allerede en konto? <a href="/Login_folder/login.php">Log på</a></p><br>
				</br>
				<b><p3 class="error"><?php echo $error;?></p3></b>
			</div>
		</form>
		
	<?php 
		include("../Footer.php"); 
	?>
	</body>
</html>