<?php include('server.php'); ?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$user_id=$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

?>
<h1>Friends</h1>
<?php

$sql = "SELECT * FROM friends WHERE user_id1='$user_id' OR user_id2='$user_id' " ;
$result = mysqli_query($db, $sql);

 echo "<br /><br /><br /><br />";

while ($row = mysqli_fetch_assoc($result)) { 
$user_id1=$row["user_id1"];
$user_id2=$row["user_id2"]; 
if($user_id1==$user_id)
	$user=$user_id2;
	
else 
	$user=$user_id1;

$sql1 = "SELECT * FROM users WHERE user_id='$user' " ;
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$prof_pic=$row1["profile_pic"]; 
if(empty($row1["nickname"])){
	$fname=$row1["fname"];
$lname=$row1["lname"];
$name=''.$fname.' '.$lname.'' ;
}
else 
	$name=$row1["nickname"];
$id=$row1["user_id"];
 echo "
	         <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			
			
	 
	 "; ?> 
	 <?php
	 if (isset($_POST[$id])) {   
	$id_user=@$_POST[$id]; echo $id;
	$_SESSION['id']=$id;
	header('location: user_profile.php');
}
else{
	
}

	?> 
	<form action="friends.php" method="POST">
<input type="submit" name=" <?php echo $id; ?>"  value="<?php echo $name; ?>" style="background-color:	#FAF0E6; border: 0px; color : #6E004A; font-size:18px;" >
</form>
	
	<?php
	echo "<br /><br /><br /><br />";



}

?>