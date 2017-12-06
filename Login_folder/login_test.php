<?php
	include("../sqlconn.php"); //Establishing connection with our database
	include("../ldap.php"); // Connection info of Active directory
	
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["Brugernavn"]))
	{
		
		if(empty($_POST["Brugernavn"]) || empty($_POST["Kodeord"]))
		{
			$error = "Der skal skrives noget i begge felter";
		}
		else
		{
			// Define $username and $password
			$Brugernavn=$_POST['Brugernavn'];
			$password=$_POST['Kodeord'];
			 
			// To protect from MySQL injection and set up for active directory
			$adbruger = $Brugernavn;
			$adbruger .= $domain;
			$adpassword = $password;

			$Brugernavn = stripslashes($Brugernavn);
			$password = stripslashes($password);
			$Brugernavn = mysqli_real_escape_string($conn, $Brugernavn);
			$password = mysqli_real_escape_string($conn, $password);
			$password = md5($password);
			 
			//Check username and password from database
			//$sql="SELECT user_id FROM users WHERE user_Brugernavn='".$Brugernavn."' AND user_password='".$password."'";
			$sql="SELECT user_level FROM users WHERE user_Brugernavn='".$Brugernavn."' AND user_password='".$password."'";
			$gullerod=mysqli_query($conn,$sql);
			//$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
			 
			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			
			if($gullerod->num_rows > 0)
			{
				
				$row = $gullerod->fetch_assoc();
				$_SESSION['Brugernavn'] = $Brugernavn; // Initializing Session
				$_SESSION['level'] = $row['user_level'];
				header("location: /main.php"); // Redirecting To Other Page
			}

			//else if ($gullerod->num_rows == 0) {
			//	$link = ldap_connect("dc01.plato.local") or die("Could not connect to SHIT");
			//	if(! $link) {
			//		$error ="kunne ikke oprette";
			//	}
			
				//ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3);
				//ldap_bind($link, $adbruger, $adpassword)
				//elseif (! ldap_bind($link, $adbruger, $adpassword)) {
					//$error = "Forkert Brugernavn eller kodeord!";
				//}


			//}

			else
			{
				$error = "Forkert brugernavn eller kodeord";
				
			}
		
		}
	}
?>
