<?php include("./inc/header.inc.php");?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$user_id=$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$fname=$row["fname"];
$lname=$row["lname"];
$prof_pic=$row["profile_pic"];
if(!empty($row['nickname']))
	$username= $row['nickname'];
else
$username=''.$fname.' '.$lname.'' ;

$_SESSION['username']=$username;
			
			
?>
 <div class="homeside" style="margin-top:40px; margin-left: 30px;	" >
 <?php

			echo " <div style='float: left;'>
            <img src='$prof_pic' height='30'>
            </div>
<div class='user' style='margin-top: 10px;'>
			<a href='profile.php' style='font-size:18px; margin-left: 10px; '>$username </a> 
			</div>";
			echo "<div class='user' style=' margin-top: 15px;'>
			<a href='friends.php' style='font-size:19px;  margin-left: 30px; '>Friend List </a> 
			</div><br/>";
			
 
 ?>
</div>

<div class="postForm"style="margin-top:-30px;">
<form method="post" action="profile.php" enctype="multipart/form-data" style="margin-top:0px;">
<textarea id="posthome" name="posthome" ></textarea>
<input type="submit" name="send"  value="post" ><br />

<input type="file" name="postimage" style="background-color:	#FAF0E6; float: left; margin-top:10px;margin-right:30px; width:80px;height:20px;"/><br />
<select name="ispublic"  style="background-color:#F6F2F8;margin-top:12px;margin-right:30px; color : #6E004A;font-size:17px;">
  <option value="public">Public</option>
  <option value="private">Private</option>
  
</select>

</div>


<div class="ProfilePosts" >
<?php
$sql1 = "SELECT * FROM friends WHERE user_id1='$user_id' OR user_id2='$user_id' " ;
$result1 = mysqli_query($db, $sql1); 
if(mysqli_num_rows($result1) ==0){
	$sql = "SELECT * FROM post WHERE poster_id='$user_id' ORDER BY posted_time DESC " ;
	$result = mysqli_query($db, $sql);  
	if (mysqli_num_rows($result) > 0) { 

while ($row = mysqli_fetch_assoc($result)) {
	$poster_name=$row["poster_name"];
	$posted_time=$row["posted_time"];
	$caption=$row["caption"];
	$image=$row["image"];
	$ispublic=$row["is_public"];
	if(empty($image)){
	 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='30'>
            </div>
			<div class='posted_by' style='font-size:12px;'>
			<a href='profile.php' style='font-size:16px;'>$poster_name </a> on $posted_time  </div>
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
}
else{

$sql = "SELECT * FROM post  WHERE poster_id='$user_id' UNION SELECT * FROM post  WHERE poster_id=ANY (SELECT user_id2 FROM friends WHERE user_id1='$user_id') UNION SELECT * FROM post  WHERE poster_id=ANY (SELECT user_id1 FROM friends WHERE user_id2='$user_id') ORDER BY posted_time DESC  " ;
 
 $result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {  
while ($row = mysqli_fetch_assoc($result)) {
	$id=$row["poster_id"];
	$sql2 = "SELECT * FROM users WHERE user_id='$id' " ;
$result2 = mysqli_query($db, $sql2);
$row2 = mysqli_fetch_assoc($result2);
	$poster_name=$row["poster_name"];
	$posted_time=$row["posted_time"];
	$poster_id=$row["poster_id"];
	$caption=$row["caption"];
	$image=$row["image"];
	$prof_pic=$row2["profile_pic"];
	if(empty($image)){
	 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='30'>
            </div>
			<div class='posted_by' style='font-size:12px;'>
			<a href='user_profile.php?id=$id' style='font-size:16px;'>$poster_name </a> on $posted_time</div>
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
		
	} echo "<br /><br />";
} 
}
} 

?>
</div>