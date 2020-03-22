<?php include("./inc/header.inc.php");?>
<?php

if (!isset($_SESSION["fname"])) {
    echo "";
}

?>
<?php
//session_start();
$fname = "";
$lname = ""; 
$nickname = ""; 
$email = ""; 
$password = ""; 
$birthdate = "";
$errors = array();
$gender = "";  
$phone_1="";
$phone_2="";
$hometown="";
$_SESSION['success'] = "";


$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
// SIGNUP USER
if (isset($_POST['reg_user'])) {
	
	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$nickname = mysqli_real_escape_string($db, $_POST['nickname']);
	$birthdate= mysqli_real_escape_string($db, $_POST['birthdate']);
	$gender= mysqli_real_escape_string($db, $_POST['gender']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$phone_1 = mysqli_real_escape_string($db, $_POST['phone_1']);
	$phone_2 = mysqli_real_escape_string($db, $_POST['phone_2']);
	$hometown = mysqli_real_escape_string($db, $_POST['hometown']);
	
	if (empty($fname)) { array_push($errors, "First name is required"); }
	if (empty($lname)) { array_push($errors, "Last name is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($gender)) { array_push($errors, "Gender is required"); }
	if (empty($birthdate)) { array_push($errors, "Birthdate is required"); }
	$query2 = "SELECT * FROM users WHERE email='$email'";
	$results2 = mysqli_query($db, $query2);
		if (mysqli_num_rows($results2) > 0) {array_push($errors, "Email not avalabile");}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}
		
		if (count($errors) == 0) {
			$password = md5($password_1);
			if($gender == "female"){
			$query = "INSERT INTO users (fname, lname, nickname, birthdate, gender, email, password, phone_1, phone_2, hometown, profile_pic) 
			VALUES('$fname', '$lname', '$nickname', '$birthdate', '$gender', '$email', '$password', '$phone_1', '$phone_2', '$hometown','img/default_pic_female.png')";}
			if($gender == "male"){
			$query = "INSERT INTO users (fname, lname, nickname, birthdate, gender, email, password, phone_1, phone_2, hometown, profile_pic) 
			VALUES('$fname', '$lname', '$nickname', '$birthdate', '$gender', '$email', '$password', '$phone_1', '$phone_2', '$hometown','img/default_pic_male.png')";}
			mysqli_query($db, $query);
            $query2 = "SELECT * FROM users WHERE email='$email'";
			$results = mysqli_query($db, $query2);
            $row=mysqli_fetch_assoc($results); 
			if(empty($nickname)){
				$_SESSION['fname'] = $fname;
			   $_SESSION['lname']=$lname ;
			   $_SESSION['user_id']=$row['user_id'] ;
			   $_SESSION['profile_pic']=$row['profile_pic'] ;
			}
			else{
				$_SESSION['nickname'] = $nickname;
				 $_SESSION['user_id']=$row['user_id'] ;
				  $_SESSION['profile_pic']=$row['profile_pic'] ;
			}
			
			$_SESSION['success'] = "Welcome to findFriends";
			header('location: home.php');
		}
	
}

// LOGIN USER
	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		

	
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		if (empty($email)) {
			array_push($errors, "Email is required");
		}		

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);
            $row=mysqli_fetch_assoc($results); 
                         			
			if (mysqli_num_rows($results) == 1) {
				 $_SESSION['fname']  = $row['fname'];
			  $_SESSION['lname'] =$row['lname'] ;
				if($row['nickname']==NULL){
			   
			    $_SESSION['user_id']=$row['user_id'] ;
			}
			else{
				
				$_SESSION['nickname'] = $row['nickname'];
				 $_SESSION['user_id']=$row['user_id'] ;
			}header('location: home.php');
			}
               else {
				array_push($errors, "Wrong password/email combination");
			}
		}
	}
	
	
	// POST
	if (isset($_POST['post'])) {
		$caption = mysqli_real_escape_string($db, $_POST['post']);
		if(isset($_POST['ispublic']))
		$status=mysqli_real_escape_string($db, $_POST['ispublic']); 
		if (isset($_FILES['postimage'])) { 
	    if ((($_FILES["postimage"]["type"]=="image/jpeg") || ($_FILES["postimage"]["type"]=="image/png") || ($_FILES["postimage"]["type"]=="image/gif"))) 
  	 
    $image = $_FILES["postimage"]["name"];  
       
		}
   else
	   $image=NULL;
	if (empty($caption) AND empty($image)) {
			array_push($errors, "No post");
		}
		
	 else{
		 $nickname=$_SESSION['username'];
		 $user_id=$_SESSION['user_id'];
		 $_SESSION['status']=$status;
		 if(!empty($image)){
			 if(!empty($caption))
		 $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,image,is_public) 
		 VALUES('$caption', '$nickname', '$user_id', NOW(),'userdata/profile_pics/$image','$status')";
		 else{ $caption=$nickname.' uploaded a photo';
			  $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,image,is_public) 
		 VALUES('$caption', '$nickname', '$user_id', NOW(),'userdata/profile_pics/$image','$status')";}
		 }
         else			
			 $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,is_public) 
			VALUES('$caption', '$nickname', '$user_id', NOW(),'$status')";
			mysqli_query($db, $query);			
			$_SESSION['nickname']=$nickname;
			$_SESSION['user_id']=$user_id;
		 header('location: profile.php');
	 }
		
		
	}
	
	//post on home
	if (isset($_POST['posthome'])) {
		$caption = mysqli_real_escape_string($db, $_POST['posthome']);
		if(isset($_POST['ispublic']))
		$status=mysqli_real_escape_string($db, $_POST['ispublic']); 
		if (isset($_FILES['postimage'])) { 
	    if ((($_FILES["postimage"]["type"]=="image/jpeg") || ($_FILES["postimage"]["type"]=="image/png") || ($_FILES["postimage"]["type"]=="image/gif"))) 
  	 
    $image = $_FILES["postimage"]["name"];  
       
		}
   else
	   $image=NULL;
	if (empty($caption) AND empty($image)) {
			array_push($errors, "No post");
		}
				
	 else{
		 $nickname=$_SESSION['username'];
		 $user_id=$_SESSION['user_id'];
		 if(!empty($image)){
			 if(!empty($caption))
		 $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,image,is_public) 
		 VALUES('$caption', '$nickname', '$user_id', NOW(),'userdata/profile_pics/$image','$status')";
		 else{ $caption=$nickname.' uploaded a photo';
			  $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,image,is_public) 
		 VALUES('$caption', '$nickname', '$user_id', NOW(),'userdata/profile_pics/$image','$status')";}
		 }
         else			
			 $query ="INSERT INTO post (caption,poster_name, poster_id, posted_time,is_public) 
			VALUES('$caption', '$nickname', '$user_id', NOW(),'$status')";
			mysqli_query($db, $query);			
			$_SESSION['nickname']=$nickname;
			$_SESSION['user_id']=$user_id;
		 header('location: home.php');
	 }
		
		
	}
	
	
//SEND FRIEND REQUEST	
if (isset($_POST['addfriend'])) {
$friend_request = $_POST['addfriend'];
$user_id=$_SESSION['user_id'];
$user_to=$_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM friend_requests WHERE user_to='$user_to' AND user_from='$user_id' " ;
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
if(mysqli_num_rows($result) > 0){
	 echo  "Friend request sent<br />";
}

else if ($user_to == $user_id) {
       echo  "You can't send a friend request to yourself<br />";
     }
     else
     {
		 $query ="INSERT INTO friend_requests (user_to,user_from) 
			VALUES('$user_to', '$user_id')"; 
	  echo  "Friend request sent<br />";
     mysqli_query($db, $query);     
	 	  $_SESSION['id']=$user_to;
	  $_SESSION['user_id']=$user_id;
	  $_SESSION['nickname']=$row['nickname'];
	   header('location: user_profile.php');
     }


}
	
	
	
	
	
	