<?php
	include_once("../sqlconn.php");
	$brugernavn = $_POST['Brugernavn'];
	$username = $_POST['Navn'];
	$password = $_POST['kodeord'];
	$email = $_POST['email'];
	$level = 'user';
	$new_password = md5($password);

if($password != "" && $username != "" && $brugernavn != "" && $email != "") {


	$brugertest = strtoupper($brugernavn);

	$sql = "SELECT * FROM users where UCASE(user_Brugernavn) = '$brugertest'";
	$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			header("location: ../SignUp_folder/SignUp.php?uerr=yes");
		}
		else {

	$emailtest = strtoupper($email);

	$sql = "SELECT * FROM users where UCASE(user_email) = '$emailtest'";
		$results = $conn->query($sql);
		if ($results->num_rows > 0) {
			header("location: ../SignUp_folder/SignUp.php?eerr=yes");
		}
		else {
		

	$sql = "INSERT INTO users (user_name,user_password,user_email,user_Brugernavn,user_level) VALUES ('$username','$new_password','$email','$brugernavn','$level')";
	if ($conn->query($sql) === TRUE) {
   		echo "New record created successfully";
	} 
	else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
	header('location: ../Login_folder/login.php');
		}
}
}

else	
header("location: ../SignUp_folder/SignUp.php?err=yes");
?>