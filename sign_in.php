<?php include('server.php') ?>
 <table>
		  <tr>
		     <td width="60%" valign="top">
		     </td>
			  <td width="40%" valign="top">			  
			  <form method="post" action="sign_in.php" >
			 
			  <h2>Login</h2>
			   	<?php include('errors.php'); ?>		  
			  
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<input type="submit"  name="login_user" value="Login">
		</div>
			  
			    </form>
		     </td>
		  </tr>
		</table>
	</body>
</html>