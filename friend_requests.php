<?php include('server.php'); ?>
<h1>Friend Requests</h1>
<?php
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$user_id=$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM friend_requests WHERE user_to='$user_id' " ;
$result2 = mysqli_query($db, $sql2);


if (mysqli_num_rows($result2) > 0) { 
while ($row2 = mysqli_fetch_assoc($result2)) { 
$user_from=$row2['user_from'];  
$sql3 = "SELECT * FROM users WHERE user_id='$user_from' " ;
$result3 = mysqli_query($db, $sql3);
$row3 = mysqli_fetch_assoc($result3);
$from= $row3['nickname'];
$prof_pic= $row3['profile_pic'];
$from_name=$row3["nickname"];
$_SESSION['id']=$user_from;
	 echo "
	         <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			<div class='user' style='margin-top: 10px;'>
			<a href='user_profile.php' style='font-size:18px; margin-left: 10px; '>$from </a> sent you a friend request </div>
	 
	 "; ?> 
	 <?php
	 if (isset($_POST['acceptreques'.$user_from])) {   
	 $query ="INSERT INTO friends (user_id1,user_id2) VALUES('$user_from', '$user_id')"; 
			mysqli_query($db, $query);	
 $delete_request = mysqli_query($db,"DELETE FROM friend_requests WHERE user_to='$user_id' AND user_from='$user_from'");
 

	
}


if (isset($_POST['ignorerequest'.$user_from])) {
	$delete_request = mysqli_query($db,"DELETE FROM friend_requests WHERE user_to='$user_id' AND user_from='$user_from'");
}
	?> 
	<form action="friend_requests.php" method="POST">
<input type="submit" name="acceptreques<?php echo $user_from; ?>" id="acceptreques<?php echo $user_from; ?>" value="Accept Request">
<input type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Ignore Request">
</form>
	
	<?php
	echo  "<hr /><br /><br />";
	
}  

}
else{
			echo"No friend requests";
		}

?>