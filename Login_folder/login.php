<?php

include("../Header.php"); 
include('login_test.php'); // Include Login Script
if (isset($_SESSION['Brugernavn']) and $_SESSION['Brugernavn'] != "")
{
	header('Location: /main.php');
}
?>	

		<h6>Log på din Mercantec forum konto her</h6>
		
		<div id="error">
	     
		</div>
			
		<div class="loginbox">
		
		
		<?php
		
		if(!empty($_GET['Brugernavn']))
		{
			echo $_GET['Brugernavn'];
		}
		
		?>
		
		<form action="login.php" method="post">		
			<input type="text" placeholder="Brugernavn" name="Brugernavn" id="Brugernavn" class="textbox"><br>
			</br>
			<input type="password" placeholder="Kodeord" name="Kodeord" id="Kodeord" class="textbox"><br>
			</br>
			<input type="Submit" value="Log ind" name="Submit" id="Submit" class="button">
			<b><p3 class="error"><?php echo $error;?></p3></b><br>
			</br>
			<p>Har du ikke en bruger? <a href="../SignUp_folder/SignUp.php">Lav en her</a></p>
			
		</form>
	</div>
	<?php 
        include("../Footer.php"); 
    ?>