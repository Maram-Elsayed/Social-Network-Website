<?php include("./inc/header.inc.php");?>
<?php
$reg=@$_POST['reg'];
session_start();
$fname = "";
$lname = ""; 
$nickname = ""; 
$email = ""; 
$password = ""; 
$Birthdate = "";
$gender = "";  

?>
	    <table>
		  <tr>
		     <td width="60%" valign="top">
		     </td>
			  <td width="40%" valign="top">
			  <h2>Sign Up</h2>
			  <form action="#" method="POST">
			  <input type="text" name="fname" size="25" placeholder="First Name" /><br /><br />
			  <input type="text" name="lname" size="25" placeholder="Last Name" /><br /><br />
			  <input type="text" name="nickname" size="25" placeholder="Nickname" /><br /><br />
			  <input type="text" name="birthdate" size="25" placeholder="Birthdate" /><br /><br />
			  <input type="text" name="gender" size="25" placeholder="Gender" /><br /><br />
			  <input type="text" name="email" size="25" placeholder="email" /><br /><br />
			  <input type="text" name="password_1" size="25" placeholder="password" /><br /><br />
			  <input type="text" name="password_2" size="25" placeholder="password check" /><br /><br />
			   <input type="text" name="phone_1" size="25" placeholder="Phone 1" /><br /><br />
			  <input type="text" name="phone_2" size="25" placeholder="Phone 2" /><br /><br />	  
			  <input type="text" name="hometown" size="25" placeholder="Hometown" /><br /><br />
			  <input type="submit" name="reg" value="Sign Up" />
			  
			 
			  </form>
		     </td>
		  </tr>
		</table>
	</body>
</html>