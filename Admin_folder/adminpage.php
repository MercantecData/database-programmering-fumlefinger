<?php
	include("../Header.php"); 
	include("../sqlconn.php");

	$userArray = array();

	if($_SESSION['level'] != "Admin" and $_SESSION['level'] != "SAdmin")
	{
		header("Location: ../main.php");
	}


	if (isset($_POST['search'])) {
		$sql = "SELECT * FROM users WHERE user_Brugernavn LIKE '%".$_POST['search']."%'";
	}
	else {
		$sql = "SELECT * FROM users";
	}

	$result = mysqli_query($conn, $sql);
	

	while($row = mysqli_fetch_assoc($result))
	{
		$userArray[] = $row;
	}
	

	
	function filterTable($query)
	{	
		global $conn;
		$filter_Result = mysqli_query($conn, $query);
		return $filter_Result;
	}
	
?>

		<h4>Admin Page</h4>

		<div class="adminsearch"> 
		<form id ="catchange" method="post">
		<input type ="submit" name="catadd" value="Tilføj Kattegori" onclick="document.getElementById('catchange').action='catadd.php';">
		<input type ="submit" name="catedd" value="Ret/Slet Kattegori" onclick="document.getElementById('catchange').action='catchange.php';">
		</form>
		</div><br>

		<div class="adminsearch">
		<form action="adminpage.php" method="post">
		<input type="text" name= "search" placeholder="Searchfornames">
		<input type="submit" name="submit" value="Filter"></div><br>
		</form>
		<div class="wrapper">
			<div class="adminbox">
			<table id="KanJegIkkeHuske">
				<tr>
					<th>Navn</th>
					<th>Email</th>
					<th>Brugernavn</th>
					<th>Opratelse dag</th>
					<th>Retigheds level</th>
					<th>Skift til</th>
				</tr>
		
				<?php
					for ($i=0; $i < count($userArray); $i++) 
					{ 
						echo 
						"
						<tr>
						<td data-th='Navn'>" .$userArray[$i]['user_name']. "</td>
						<td data-th='Email'>" .$userArray[$i]['user_email']. "</td>
						<td data-th='Brugernavn'>" .$userArray[$i]['user_Brugernavn']. "</td>
						<td data-th='Opratelse dag'>" .$userArray[$i]['user_date']. "</td>
						<td data-th='Retigheds level'>" .$userArray[$i]['user_level']."</td>
						<td>
						<form action='' method='post'>";
						
						if($_SESSION['level'] == "SAdmin" and $userArray[$i]['user_level'] != "SAdmin" ) {
							echo "
							<button name ='user' value='".$userArray[$i]['user_id']."'>User</button>
							<button name ='ope' value='".$userArray[$i]['user_id']."'>Operater</button>
							<button name ='admin' value='".$userArray[$i]['user_id']."'>Admin</button>
							</form></td>
							</tr>
							";	
						}
						else if ($userArray[$i]['user_level'] != "Admin" and $userArray[$i]['user_level'] != "SAdmin") {
							echo "
							<button name ='user' value='".$userArray[$i]['user_id']."'>User</button>
							<button name ='ope' value='".$userArray[$i]['user_id']."'>Operater</button>
							</form></td>
							</tr>
							";		
							}				
						
					}	
					
		
					
			
		
					 if(isset($_POST['user']))
						{
							print('User');
							$changeuser = "UPDATE users SET user_level='user' WHERE user_id=".$_POST['user'];
							if (mysqli_query($conn, $changeuser)){
								echo ": Record updated successfully";
							} else{
								echo ": Error updating record";
							}
							
						}
					
					if(isset($_POST['ope']))
						{
							print('Operater');
							$changeuser = "UPDATE users SET user_level='Operater' WHERE user_id=".$_POST['ope'];
							if (mysqli_query($conn, $changeuser)){
								echo ": Record updated successfully";
							} else{
								echo ": Error updating record";
							}
						}

					if(isset($_POST['admin']))
						{
							print('Operater');
							$changeuser = "UPDATE users SET user_level='Admin' WHERE user_id=".$_POST['admin'];
							if (mysqli_query($conn, $changeuser)){
								echo ": Record updated successfully";
							} else{
								echo ": Error updating record";
							}
						}
				?>
				
					
		
			</table>
			</div>
		</div>

		<?php
			include("../Footer.php"); 
		?>
	</body>
</html>