
<?php include('server.php') ?>
 <table>
		  <tr>
		     <td width="60%" valign="top">
			 
		     </td>
			  <td width="40%" valign="top">			  
			  <form method="post" action="sign_up.php" >
			 
			  <h2>Sign Up</h2>
			  <?php include('errors.php'); ?>
			  <div class="input-group">
			<label>First Name *</label>
			<input type="text" name="fname" value="<?php echo $fname; ?>">
		     </div>
			  <div class="input-group">
			  <label>Last Name *</label>
			<input type="text" name="lname" value="<?php echo $lname; ?>">
		     </div>
			  <div class="input-group">
			 <label>Nickname</label>
			<input type="text" name="nickname" value="<?php echo $nickname; ?>">
		     </div>
			  <div class="input-group">
			   <label>Birthdate*</label>
			<input type="date" name="birthdate" value="<?php echo $birthdate; ?>"style="background-color:#F6F2F8;color : #6E004A;margin-top:12px;margin-right:30px;font-size:17px;">
		     </div>
			  <div class="input-group">
			  <label>Gender *</label>
			  <select name="gender"  style="color : #6E004A;background-color:#F6F2F8;margin-top:12px;margin-right:30px;font-size:17px;">
              <option value="female">Female</option>
              <option value="male">Male</option><br/>
  
              </select>
			
		     </div>
			  <div class="input-group">
			   <label><br/>Email *</label>
			<input type="text" name="email" value="<?php echo $email; ?>">
		     </div>
			 <div class="input-group">
			<label>Password *</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password *</label>
			<input type="password" name="password_2">
		</div>
			    <div class="input-group">
			   <label>Phone 1</label>
			<input type="text" name="phone_1" value="<?php echo $phone_1; ?>">
		     </div>
			  <div class="input-group">
			  <label>Phone 2</label>
			<input type="text" name="phone_2" value="<?php echo $phone_2; ?>">
		     </div>
			  <div class="input-group">
			  <label>Hometown</label>
			<input type="text" name="hometown" value="<?php echo $hometown; ?>">
		     </div>
			  <div class="input-group">
			<input type="submit"  name="reg_user" value="Sign Up">
		</div>
			  
			  
			  
			    </form>
		     </td>
		  </tr>
		</table>
	</body>
</html>