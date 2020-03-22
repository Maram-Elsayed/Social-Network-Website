<?php include('server.php'); ?>
<h1>Search By:</h1>
<form action="search.php" method="post" style="font-size:18px; color:#4B0082" >
Email: <input type="text" name="email" id="email" >
<input type="submit" name="searchemail" id="searchemail" value="Search" style='margin-left: 5px;'>
</form>
<form action="search.php" method="post" style="font-size:18px; color:#4B0082">
Name: <input type="text" name="name" id="name" > 
<input type="submit" name="searchname" id="searchname" value="Search" style='margin-left: 5px;'>
</form>
<form action="search.php" method="post" style="font-size:18px; color:#4B0082">
Post: <input type="text" name="caption" id="caption" size="40">
<input type="submit" name="searchpost" id="searchpost" value="Search" style='margin-left: 5px;'>
</form>
<form action="search.php" method="post" style="font-size:18px; color:#4B0082">
Hometown: <input type="text" name="hometown" id="hometown" size="40">
<input type="submit" name="searchhometown" id="searchhometown" value="Search" style='margin-left: 5px;'>
</form>

<?php 
echo "<br /><br /><br />";
?>
<h2>Search Results</h2>
<?php 
echo "<br /><br />";
$db = mysqli_connect('localhost', 'root', '', 'socialnetwork');
$user_id= $_SESSION['user_id'];  

$sql = "SELECT * FROM users WHERE user_id='$user_id' " ;
$result2 = mysqli_query($db, $sql);
$row2 = mysqli_fetch_assoc($result2);

$searchpost = @$_POST['searchpost'];

if ($searchpost){  
	$search=strip_tags(@$_POST['caption']);
	if (!empty($search)) { 
	  $sql = "SELECT * FROM post WHERE poster_id='$user_id' AND caption LIKE'%$search%'  ORDER BY posted_time DESC" ;
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) { 
$prof_pic= $row2['profile_pic'];
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
            <img src='$prof_pic' height='300'>
            </div><hr /><br /><br /><p />
	 
	";
		
	}
	
}  

}else{
			echo"No results found";
		}
	
}
} 

$searchemail = @$_POST['searchemail'];

if ($searchemail){  
	$search=strip_tags(@$_POST['email']);
	if (!empty($search)) { 
	  $sql = "SELECT * FROM users WHERE email='$search' " ;
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) { 
$user=$row["nickname"];
	$prof_pic=$row["profile_pic"]; 
	$_SESSION['id']=$row["user_id"];
	$id=$row["user_id"];
	 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			<div class='user' style='margin-top: 10px;'>
			<a href='user_profile.php?id=$id' style='font-size:18px; margin-left: 10px; '>$user </a> </div>
	         <br /><br /><br /><br />
			 
               <hr /> <br /><br />
	 
	 ";
}  

}else{
			echo"No results found";
		}
	
}
}     

$searchname = @$_POST['searchname'];

if ($searchname){  
	$search=strip_tags(@$_POST['name']);
	if (!empty($search)) { 
	  $sql = "SELECT * FROM users WHERE fname='$search' OR lname='$search' " ; 
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) { 
if(empty($row["nickname"])){
	$fname=$row["fname"];
$lname=$row["lname"];
$user=''.$fname.' '.$lname.'' ;
}
else 
	$user=$row["nickname"];
	$prof_pic=$row["profile_pic"]; 
	$_SESSION['id']=$row["user_id"];
	$id=$row["user_id"];
	 echo "
	       <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			<div class='user' style='margin-top: 10px;'>
			<a href='user_profile.php?id=$id' style='font-size:18px; margin-left: 10px; '>$user </a> </div>
	         <br /><br /><br /><br />
			 
               <hr /> <br /><br />
	 
			
	 
	 ";
}  

}
else{
			echo"No results found";
		}
	
}
}     

$searchhometown = @$_POST['searchhometown'];

if ($searchhometown){  
	$search=strip_tags(@$_POST['hometown']);
	if (!empty($search)) { 
	  $sql = "SELECT * FROM users WHERE hometown='$search' " ;
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) { 
$user=$row["nickname"];
	$prof_pic=$row["profile_pic"]; 
	$_SESSION['id']=$row["user_id"];
	$id=$row["user_id"];
	 echo "
	        <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			<div class='user' style='margin-top: 10px;'>
			<a href='user_profile.php?id=$id' style='font-size:18px; margin-left: 10px; '>$user </a> </div>
	         <br /><br /><br /><br />
			 
               <hr /> <br /><br />
	 
	 ";
}  

}else{
	echo "No results found";
}
	
}
}    

if (isset($_POST['search'])) {
		$search= mysqli_real_escape_string($db, $_POST['search']);
		
   if (!empty($search)) { 
	   $sql = "SELECT * FROM users WHERE nickname='$search' " ;
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) { 
while ($row = mysqli_fetch_assoc($result)) { 

	$user=$row["nickname"];
	$prof_pic=$row["profile_pic"]; 
	$id=$row["user_id"];
	$_SESSION['id']=$row["user_id"];
	 echo "
	         <div style='float: left;'>
            <img src='$prof_pic' height='60' style='margin-left: 10px;'>
            </div>
			<div class='user' style='margin-top: 10px;'>
			<a href='user_profile.php?id=$id' style='font-size:18px; margin-left: 10px; '>$user </a> </div>
	         <br /><br /><br /><br />
			 
               <hr /> <br /><br /> 
			   ";

}
} 
		}
		else{
			echo"No results found";
		}
	
}
?>

