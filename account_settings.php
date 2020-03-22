<?php include('server.php'); ?>
<?php
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$user_id=$_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['user_id']=$user_id;
$profile_pic=$row['profile_pic'];
?> 
<?php
  $senddata = @$_POST['senddata'];
  
  //Password variables
  $old_password = strip_tags(@$_POST['oldpassword']);
  $new_password = strip_tags(@$_POST['newpassword']);
  $repeat_password = strip_tags(@$_POST['newpassword2']);
  
  if ($senddata) {
	  $db_password =$row['password'];
	  $old_password_md5 = md5($old_password);
	   if ($old_password_md5 == $db_password) {
		   if ($new_password == $repeat_password) {
			    $new_password_md5 = md5($new_password);
				$password_update_query = mysqli_query($db,"UPDATE users SET password='{$new_password_md5}' WHERE user_id='$user_id'");
           echo "Success! Your password has been updated!";
		   }
		    else
            echo "Your two new passwords don't match!";
         
        }
        else
           echo "The old password is incorrect!";
        
	   }
	  
  
   else
  {
   echo "";
  }
  
  $updateinfo = @$_POST['updateinfo'];
  
   if ($updateinfo) {
   $fname = strip_tags(@$_POST['fname']);
   $lname = strip_tags(@$_POST['lname']);
   $nickname = strip_tags(@$_POST['nickname']);
   $phone_1 = strip_tags(@$_POST['phone_1']);
   $phone_2 = strip_tags(@$_POST['phone_2']);
   $hometown=strip_tags(@$_POST['hometown']);
   $birthdate=strip_tags(@$_POST['birthdate']);
   $marital_status=strip_tags(@$_POST['marital_status']);
   $aboutme= @$_POST['aboutme'];
   if(empty($nickname)){
	   $username=''.$fname.' '.$lname.'' ;
   }
   else 
	   $username=$nickname;
   //Submit the form to the database
   $info_update_query = mysqli_query($db,"UPDATE users SET fname='{$fname}', lname='{$lname}',nickname='{$nickname}',birthdate='{$birthdate}',marital_status='{$marital_status}', aboutme='{$aboutme}',phone_1='{$phone_1}', phone_2='{$phone_2}',hometown='{$hometown}' WHERE user_id='$user_id'");
   $info_update_query = mysqli_query($db,"UPDATE post SET poster_name='{$username}' WHERE poster_id='$user_id'");
    echo "Your profile info has been updated!";
   }
    else
  {
   echo "";
  }
   
   //Profile Image upload script
   if (isset($_FILES['profilepic'])) {
	    if (((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/png") || (@$_FILES["profilepic"]["type"]=="image/gif"))) //1 Megabyte
  {
	  $sql = "SELECT * FROM users WHERE user_id='$user_id' " ; 
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
  if(empty($row['nickname'])){
	  $fname=$row['fname'] ;
$lname=$row['lname'] ;
$username=''.$fname.' '.$lname.'' ; 
  }
  else{
	  $username=$row['nickname'];
  }
    $profile_pic_name = @$_FILES["profilepic"]["name"];
	$caption=''.$username.' changed profile picture';
	$nickname=$row['nickname'];
    $profile_pic_query = mysqli_query($db,"UPDATE users SET profile_pic='userdata/profile_pics/$profile_pic_name' WHERE user_id='$user_id'");
	
	$query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,image) 
			VALUES('$caption', '$username', '$user_id', NOW(),'userdata/profile_pics/$profile_pic_name')";
	mysqli_query($db, $query);
    header("Location: account_settings.php");
    
   }
  
  else
  {
      echo "Invailid File! Your image must be no larger than 1MB and it must be either a .jpg, .jpeg, .png or .gif";
  }
	   
  }
else
  {
   echo "";
  }  
   
   
   if (isset($_POST['closeaccount'])) {
	   header('location: profile.php');
	   $_SESSION['user_id']=$user_id;
   }
  ?>


<h1>Edit your Account Settings below</h1>
<hr />

<form action="" method="POST" enctype="multipart/form-data" style="font-size:18px; color:#4B0082">
UPLOAD YOUR PROFILE PHOTO: <br />
<img src=" <?php echo $profile_pic; ?> " width="80" height="80"/><br />
<input type="file" name="profilepic" /><br />
<input type="submit" name="uploadpic" value="Upload Image">
</form>
<hr />

<form action="account_settings.php" method="post" style="font-size:18px; color:#4B0082" >
CHANGE YOUR PASSWORD: <br />
Your Old Password: <input type="password" name="oldpassword" id="oldpassword" size="40"><br />
Your New Password: <input type="password" name="newpassword" id="newpassword" size="40"><br />
Repeat Password  : <input type="password" name="newpassword2" id="newpassword2" size="40"><br />
<input type="submit" name="senddata" id="senddata" value="Update Information">
</form>
<hr />

<form action="account_settings.php" method="post" style="font-size:18px; color:#4B0082" >
UPDATE YOUR PROFILE INFO: <br />
First Name: <input type="text" name="fname" id="fname" size="40" value="<?php echo $row['fname'] ; ?>"><br />
Last Name: <input type="text" name="lname" id="lname" size="40" value="<?php echo $row['lname'] ; ?>"><br />
Nickame:   <input type="text" name="nickname" id="nickname" size="40" value="<?php echo $row['nickname']; ?>"><br />
Phone 1: <input type="text" name="phone_1" id="phone_1" size="40" value="<?php echo $row['phone_1'] ; ?>"><br />
Phone 2: <input type="text" name="phone_2" id="phone_2" size="40" value="<?php echo $row['phone_2'] ; ?>"><br />
Hometown: <input type="text" name="hometown" id="hometown" size="40" value="<?php echo $row['hometown'] ; ?>"><br />
Birthday(DD-MM-YYY): <input type="text" name="birthdate" id="birthdate" size="40" value="<?php echo $row['birthdate'] ; ?>"><br />
Marital Status (Single, Engaged, Married): <input type="text" name="marital_status" id="marital_status" size="40" value="<?php echo $row['marital_status'] ; ?> "><br />
About You: <textarea name="aboutme" id="aboutme" rows="7"  cols="40"><?php echo $row['aboutme'] ; ?></textarea><br />
<input type="submit" name="updateinfo" id="updateinfo" value="Update Information">
</form>
<hr />



<form action="account_settings.php" method="post" style="font-size:18px; color:#4B0082" >
CLOSE ACCOUNT: <br />
<input type="submit" name="closeaccount" id="closeaccount" value="Back To Profile">
</form>
<hr />
<br />
<br />