<?php 
	//includere database connection(regner med du selv har sådan en fil)
    include 'sqlconn.php';
	
	//Forbinder til tablet
    $sql = "SELECT * FROM kategorier";
	//Får outputten af din query
    $result = mysqli_query($conn, $sql);
	
	//Laver 2 variabler, som dataen ligger i.
    $response = array();
    $posts = array();
    
	//Køre et if statement, for at tjekke om din query overhovedet gav resultat.
    if (mysqli_num_rows($result) > 0) {
		//Køre et whileloop, for hvert row du har.
        while($row = mysqli_fetch_assoc($result)) {
			
			//Her tilføjer du en variable for HVER af dine collonder i dit table, eller bare alt du vil have med
            $id=$row["id"];
            $usern=$row['maincat']; 
            $passw=$row['subcat']; 
            
			//Skriver dine variabler ind i et array
            $posts[] = array('id'=> $id, 'maincat'=> $usern, 'subcat'=> $passw);
        }
    } else {
        echo "0 results";
    }
	//Skriver dit array ind i et nyt array
    $response['posts'] = $posts;
    
	//åbner/opretter en fil, og så overskiver filen, med det nye info.
    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($response));
    fclose($fp);

    mysqli_close($conn);
?>