<?php include('server.php'); ?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');

$id_from= $_SESSION['user_id'];
$sql1 = "SELECT * FROM users WHERE user_id='$id_from' " ;
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_assoc($result1);

		//$user_from= $_SESSION['nickname'];
		$id_from= $_SESSION['user_id'];
			
if(isset($_GET['id']))
$_SESSION['id'] = $_GET['id'];
$id_to=$_SESSION['id'];
$sql = "SELECT * FROM users WHERE user_id='$id_to' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

	$fname=$row["fname"];
$lname=$row["lname"];		
		if(empty($row["nickname"])){

$user_to=''.$fname.' '.$lname.'' ;
}
else 
	$user_to=$row["nickname"];
		$id_to= $row['user_id'];
		$prof_pic = $row['profile_pic'];
		$aboutme=$row['aboutme'];

$_SESSION['id']=$id_to;
$_SESSION['user_id']=$id_from;	
$email=$row["email"];
$town=$row["hometown"];
$bday=$row["birthdate"];
$status=$row["marital_status"];

$s1 = "SELECT * FROM friends WHERE user_id1='$id_from' AND user_id2='$id_to'" ;
$r1 = mysqli_query($db, $s1);
$row1 = mysqli_fetch_assoc($r1);

$s2 = "SELECT * FROM friends WHERE user_id1='$id_to' AND user_id2='$id_from'" ;
$r2 = mysqli_query($db, $s2);
$row2 = mysqli_fetch_assoc($r2); 
if(mysqli_num_rows($r1)==0 AND mysqli_num_rows($r2)==0){
	$friends=0;
}
else{
	$friends=1;
}

?>

		



<div class="ProfilePosts"  style='margin-top:150px;'>

<?php
if($friends==0)
	$sql = "SELECT * FROM post WHERE poster_id='$id_to' AND is_public='public' ORDER BY posted_time DESC " ;
else
$sql = "SELECT * FROM post WHERE poster_id='$id_to' ORDER BY posted_time DESC " ;
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) {
	$poster_name=$row["poster_name"];
	$posted_time=$row["posted_time"];
	$caption=$row["caption"];
	$image=$row["image"];
	if(empty($image)){
	 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='30'>
            </div>
			<div class='posted_by' style='font-size:12px;'>
			<a href='profile.php' style='font-size:16px;'>$poster_name </a> on $posted_time</div>
	         <br />
			 <div  style='max-width: 650px; font-size:16px;'>
              $caption<br /><p /><p />
              </div>
               <hr />
	 
	 
	 
	";}
	else{
		 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='30'>
            </div>
			<div class='posted_by' style='font-size:12px;'>
			<a href='profile.php' style='font-size:16px;'>$poster_name </a> on $posted_time</div>
	         <br />
			 <div  style='max-width: 650px; font-size:16px;'>
              $caption<br />
              </div>
			  <div style='margin-left: 50px;'>
            <img src='$image' height='300'>
            </div><hr /><br /><br /><p />
              
               
	 
	 
	 
	";
		
	}
}
} 


?>
</div>
 <div class="pic">
 <img src="<?php echo $prof_pic  ?>"/>
 <br />
 <?php if($friends==0){ ?>
<form action="user_profile.php" method="POST">
<input type="submit" name="addfriend" value="Add Friend" style='text-align: center; margin-left: 35px;'>
<?php
}?>
</div>
<div class="textheader" style="color : #6E004A;font-size:19px;"><?php echo $user_to ?>'s profile </div>
<div class="information" style="font-size:17px;color : #6E004A;" >
Name: <?php echo ''.$fname.' '.$lname.'' ; ?><br/>
Email:<?php echo $email; ?><br/>
<?php 
if($friends==1) 
 echo'Born on '.$bday. '<br/>';

?>

<?php
if(!empty($town)) 
 echo'From '.$town.'<br/>';
 if(!empty($status) ){   
echo $status.'<br/>';}
?>
</div>
<?php if($friends==1){ ?>
<div class="Profilesidecontent"style="color : #6E004A;font-size:17px;">
<?php
echo $aboutme ?>
</div>
<?php }?>
<br/>
