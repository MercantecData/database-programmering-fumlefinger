<?php
include("Header.php");

	$line = "";
    $line2 = "";
    $error = "giv et svar";
    $id = "0";
    if(isset($_GET['id'])) $id = $_GET['id'];
    if(isset($_GET['fe']) && $_GET['fe'] == "yes") $error = "venligst indtast noget inden du submitter";


	$sql = "SELECT * FROM post WHERE post_id = '".$id."' order by post_date desc";
	$kanin = $conn->query($sql); 
	if ($kanin->num_rows > 0) {
        while($row = $kanin->fetch_assoc()) {
			$post_title = $row['post_title'];
			$post_content = $row['post_content'];
			$post_by = $row['post_by'];
			$post_date = $row['post_date'];
        }
	}

    $sql = "SELECT * FROM reply WHERE reply_toid = $id";
    $gullerod = $conn->query($sql);
    if ($gullerod->num_rows > 0) {
        while($row = $gullerod->fetch_assoc()) {
            $line.='<div class="post"><p2>'. $row['reply_content'].'</p2><br><br><p2>'. $row['reply_by'].' '.$row['reply_date'].'</p2></h5>';
            if ($_SESSION['level'] == "Admin" or $_SESSION['level'] == "SAdmin" or $_SESSION['level'] == "Operater" or $_SESSION['Brugernavn'] == $row['reply_by']) { 
                $line.="<div style='text-align:right;'><input value='RET' type='button' style='width: 50px; height: 20px' onclick='window.top.location.href=\"edit.php?id=".$row['reply_id']."&pid=".$id."\"'>";
                $line.="<input type='button'  text='add' value='SLET' style='color:black; width: 50px; height: 20px' onclick='window.top.location.href=\"delete.php?id=".$row['reply_id']."&pid=".$id."\"' ></div></div>";
            }
            else{
                $line.="</div>";
            }
        }
    }

    $show = "none";
    if ($_SESSION['Brugernavn'] != "") {
        $show = "block";
    }


    $line2.="<div class='post'><h5>".$post_content."<br></br><p2>".$post_by.$post_date."</p2></h5>";

    if ($_SESSION['level'] == "Admin" or $_SESSION['level'] == "SAdmin" or $_SESSION['level'] == "Operater" or $_SESSION['Brugernavn'] == $post_by) { 
        $line2.="<div style='text-align:right;'><input value='RET' type='button' style='width: 50px; height: 20px' onclick='window.top.location.href=\"edit2.php?id=".$id."\"'>";
        $line2.="<input type='button'  text='add' value='SLET' style='color:black; width: 50px; height: 20px' onclick='window.top.location.href=\"delete.php?id=".$id."&main=yes\"'></div></div>";
    }
    else{
    $line2.="</div>";
    }


?>






 <div class="index-category">
		<div class="wrapper">
			<h4><?php echo $post_title;?></h4>
            <?php echo $line2; ?>

            <?php echo $line; ?>
			
            <br><br>
            <form class="replyBox" action="insertpost.php?id=<?php echo $id;?>" method="post" style="display:<?php echo $show;?>">
            <textarea placeholder="<?php echo $error; ?>" rows="4" cols="50" name="Beskrivelse" class="textarea-box"></textarea>
            <input type="submit" name="button" value="Submit" class="button" />	
            </form>
            
            </div>
            </div>

<?php
include("Footer.php");
?>
