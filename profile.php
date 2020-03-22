<?php include('server.php'); ?>
<?php



$user_id= $_SESSION['user_id'];
$sql1 = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_assoc($result1);

if (!empty($row1['nickname']) ) {
		$username= $row1['nickname'];	
		$fname=$row1['fname'] ;
$lname=$row1['lname'] ;
			
	}
else{
	$fname=$row1['fname'] ;
$lname=$row1['lname'] ;
	$username=''.$fname.' '.$lname.'' ;
	$user_id= $_SESSION['user_id'];	
	$fname=$_SESSION['fname'] ;
$lname=$_SESSION['lname'] ;
}

$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);


$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$prof_pic = $row['profile_pic'];
//$username= $row['nickname'];
$_SESSION['username']=$username;
$_SESSION['user_id']=$user_id;  
$email=$row["email"];
$town=$row["hometown"];
$bday=$row["birthdate"];
$status=$row["marital_status"];
?>
		
<div class="postForm">
<form method="post" action="profile.php" enctype="multipart/form-data">
<textarea id="post" name="post" ></textarea>
<input type="submit" name="send"  value="post" ><br />
<input type="file" name="postimage" style="background-color:	#FAF0E6; float: left; margin-top:10px;margin-right:30px; width:80px;height:20px;"/>

<select name="ispublic"  style="background-color:#F6F2F8;margin-top:12px;margin-right:30px;color : #6E004A;font-size:17px;">
  <option value="public">Public</option>
  <option value="private">Private</option>
  
</select>
</div>



<div class="ProfilePosts">
<?php
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


?>
</div>
 <div class="pic">
 <img src="<?php echo $prof_pic  ?>"/>
 <br />
</div>

<div class="textheader" style="color : #6E004A;font-size:19px;"><?php echo $username ?> </div>
<div class="information" style="font-size:17px;color : #6E004A;" >
Name: <?php echo ''.$fname.' '.$lname.'' ; ?><br/>
Email:<?php echo $email; ?><br/>
Born on <?php echo $bday; ?><br/>
<?php if(!empty($status)) 
 echo'Status:'. $status.'<br/>';
if(!empty($town)) 
 echo'From '.$town.'<br/>';

?>
</div>
<div class="Profilesidecontent"style="color : #6E004A;font-size:17px;"><?php echo $row['aboutme']; ?></div>

<br/>


