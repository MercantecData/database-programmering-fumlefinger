<?php 
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
$line = "";
session_start();
include_once("sqlconn.php");
if (!isset($_SESSION['level'])) $_SESSION['level'] = "";
if (!isset($_SESSION['Brugernavn'])) $_SESSION['Brugernavn'] = "";

$sql2 = "SELECT maincat FROM Kategorier";
$result2 = $conn->query($sql2);
if ($result2->num_rows >= 0) {
	while($row2 = $result2->fetch_assoc()) {
		$line.="<li><a href='/Show.php?cat=".$row2['maincat']."'>".$row2['maincat']."</a></li>";
	}
}

?>

<html>
    <head>
        <meta charset="utf-8">
	    <title>Mercantec Hotskp forum</title>
	    <link rel="stylesheet" type="text/css" href="/CSS/style.css">
	    <link rel="icon" href="/image/forumlogo.png">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	    <!--<script src="/Java-script/handlebars-v4.0.5.js"></script>-->
    </head>

    <body>
        <header>
            <div class="wrapper">
		    	<a href="http://forum.hotskp.dk">
		    		<img src="/image/Mercantechvidtext.png" alt="Mercantec logo">
		    	</a>
		    </div>

            <div class="nav">
                <ul>
                    <li><a href="http://www.hotskp.dk">HOTSKP</a></li>
                    <li><a href="http://forum.hotskp.dk">Forum</a></li>
				    <li><a href="/thread.php">Ny post</a></li>
                    <li><a href="#">Kategorier</a>
						<ul>
							<?php echo $line; ?>
						</ul>
					</li>


                    <?php
                        if (isset($_SESSION['Brugernavn']) and $_SESSION['Brugernavn'] != "") {
					    	echo "<form action='/Login_folder/logout.php'>
					    		  <button>Log Out</button>
					    		  </form>";
					    }
					    else {
					    	echo "<form action='/Login_folder/login.php'>
					    		  <button>Log in</button>
					    		  </form> 
                              
					    		  <form action='/SignUp_folder/SignUp.php'>
					    		  <button>Sign up</button>
					    		  </form>";
					    }
                    
					    if 	($_SESSION['level'] == "Admin" or $_SESSION['level'] == "SAdmin")  {
					    	echo "<form action='/Admin_folder/adminpage.php'>
					    		  <button>Admin</button>
					    		  </form>";
                              
					    }
                    ?>

                    <form class="SearchBar" method="post" action="../search.php">
				    	<input type="text" name="search" maxlength="120" placeholder="Ude af drift">
				    </form>
                </ul>
            </div>
        </header>