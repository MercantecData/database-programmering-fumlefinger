<?php 
    include("Header.php");
    $line = "";
    $scat = "";
    $cat = "";
    $subcat = "";
    $line2 ="";
    $title2="";

	

    if(isset($_GET['cat'])) $cat = $_GET['cat'];
    if(isset($_GET['scat'])) $scat = $_GET['scat'];
    //threadbox3 hedder nu under-cat-box (Giver lidt bedre mening)

    if($scat != "") {
        $title = $scat;
        $title2 = $scat;
    } 
    else if ($cat != "") {
        $title = $cat;
    }
    else {
        $title = "Nyeste posts";
    }


    if ($title == "Nyeste posts") {
        $sql = "SELECT * FROM post order by post_date desc limit 3";
    }
    else if ($title2 != "") {
        $sql = "SELECT * FROM post WHERE post_subcat = '".$title."' order by post_date desc";
    }
    else {
        $sql = "SELECT * FROM post WHERE post_cat = '".$title."' order by post_date desc limit 3";
    }
	$kanin = $conn->query($sql); 
	if ($kanin->num_rows > 0) {
        while($row = $kanin->fetch_assoc()) {
            $line2.="<a href='Showpost.php?id=".$row['post_id']."'><div class='post'><h5>".$row['post_title']."</h5><div class='post'><br>".$row['post_by'].$row['post_date']."</div></a>";
        }
    }

    


    //slutter op til database
    $sql = "SELECT subcat FROM Kategorier where maincat = '".$cat."'";
    $result = $conn->query($sql);
    if ($result->num_rows >= 0) {
        while($row = $result->fetch_assoc()) {
           $subcat = explode(',' , $row['subcat']);
        }
    }

    if ($subcat != "") {

        $line.="<form class='under-cat-box'>";
        $line.="<b><u>".$cat."</u></b><br><br>";
        $line.="<ul>";

        foreach($subcat as $value) {
            $line.="<li><a href='Show.php?cat=".$cat."&scat=".$value."'>".$value."</a></li>";
        }

        $line.="</ul>";
        $line.="</form>";
    }
?>



</body>


<section>
        
		<div class="index-category">
			
            <div class="wrapper">
            
				<h4><?php echo $title;?></h4>

					
						<?php echo $line; ?>
				

                <?php echo $line2; ?>
  
            </div>
		</div>
	</section>


<?php
    include("Footer.php");
?>