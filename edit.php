<?php
include("Header.php");

if(isset($_GET['id'])) $id = $_GET['id'];

if(isset($_GET['pid'])) $toid = $_GET['pid'];

$sql = "SELECT * FROM reply WHERE reply_id = $id";
$gullerod = $conn->query($sql);
if ($gullerod->num_rows > 0) {
    while($row = $gullerod->fetch_assoc()) {
        $content = $row['reply_content'];
    }
}


?>
<div class="index-category">
<div class="wrapper" style="padding:5vh 0 0 0">
<form class="replyBox" action="insertpost.php?id=<?php echo $toid;?>&edit=true&rid=<?php echo $id;?>" method="post" style="display:block">
<textarea rows="4" cols="50" name="Beskrivelse" class="textarea-box"><?php echo $content; ?></textarea>
<input type="submit" name="button" value="Submit" class="button" />	
</form></div></div>

