<?php
$db=mysqli_connect("localhost","root","","socialnetwork") ;
session_start();
if (isset($_SESSION['fname'])) {
$user = $_SESSION["fname"];
}
else {
$user = "";
}
?>
<!doctype html>
<html>
    <head>
        <title>findFriends</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css"/>
		<script src="js/main.js" type="text/javascript"></script>
    </head>
	<body>
	    <div class="headerMenu">
	       <div id="wrapper">
	          <div class="logo">
	             <img src="./img/find_friends_logo.png"/>
	          </div>
			  
			  
			
			<?php
			
			if (isset($_SESSION['user_id'])) {
				$user_id=$_SESSION['user_id'];
				$sql = "SELECT * FROM friend_requests WHERE user_to='$user_id' " ;
$result = mysqli_query($db, $sql);
$count=mysqli_num_rows($result); 
			echo '
			
			   <div id="menu" >
			   <a href="home.php" />Home</a>
			   <a href="profile.php" />Profile</a>	               			   
			   <a href="friend_requests.php" />Friend Requests '.$count.'</a>			   
			   <a href="account_settings.php" />Edit Account </a>
			   <a href="logout.php"  /> Logout</a>
			  </div> 
			  ';
			  ?> 
			  <div class="search_box">
			     <form action="search.php" method="post" id="search">
				 <input type="text" name="search" size="60" placeholder="Search...">
				 </form>
			  </div>
			  <?php
			  }
			  else{
				  echo '
				  <div id="menu" >
			   <a href="sign_up.php" />Sign Up</a>
			   <a href="sign_in.php" />Sign In</a>	   
			  </div> 
			  ';
			  }
			  
			?>  
	       </div>
	    </div>