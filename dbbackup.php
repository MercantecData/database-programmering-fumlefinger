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
    $fp = fopen('kategorier.json', 'w');
    fwrite($fp, json_encode($response));
    fclose($fp);





    $sql = "SELECT * FROM post";
    $result = mysqli_query($conn, $sql);
    $response2 = array();
    $posts2 = array();
    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result)) {
            $id=$row['post_id'];
            $content=$row['post_content'];
            $title=$row['post_title'];
            $date=$row['post_date'];
            $subcat=$row['post_subcat'];
            $by=$row['post_by'];
            $cat=$row['post_cat'];

            $posts2[] = array('id'=>$id,'content'=>$content, 'title'=>$title,'date'=>$date,'subcat'=>$subcat,'by'=>$by,'cat'=>$cat);
        }
    
    }
    $response2['posts2'] = $posts2;
    $fp = fopen('posts.json', 'w');
    fwrite($fp, json_encode($response2));
    fclose($fp);


    $sql = "SELECT * FROM reply";
    $result = mysqli_query($conn, $sql);
    $response3 = array();
    $posts3 = array();
    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result)) {
            $id=$row['reply_id'];
            $content=$row['reply_content'];
            $date=$row['reply_date'];
            $by=$row['reply_by'];
            $to=$row['reply_toid'];

            $posts3[] = array('id'=>$id,'content'=>$content, 'date'=>$date,'by'=>$by,'to'=>$to);
        }
    }
    $response3['posts3'] = $posts3;
    $fp = fopen('replys.json', 'w');
    fwrite($fp, json_encode($response3));
    fclose($fp);



    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    $response4 = array();
    $posts4 = array();
    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result)) {
            $id=$row['user_id'];
            $name=$row['user_name'];
            $password=$row['user_password'];
            $email=$row['user_email'];
            $brugernavn=$row['user_Brugernavn'];
            $created=$row['user_date'];
            $level=$row['user_level'];
        }
            $posts4[] = array('id'=>$id,'name'=>$name, 'password'=>$password,'email'=>$email,'brugernavn'=>$brugernavn,'created'=>$created,'level'=>$level);
        }

        $response4['posts4'] = $posts4;
        $fp = fopen('users.json', 'w');
        fwrite($fp, json_encode($response4));
        fclose($fp);


    
?>