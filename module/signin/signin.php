<form name="login" id="login" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<table>
<tr>
	<td>
		<label for="username">Username</label>
	</td>
	<td>
		<input type="text" name="username">
	</td>
</tr>
<tr>
	<td>
		<label for="password">Password</label>
	</td>
	<td>
		<input type="password" name="password">
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<a href="lostpassword">forgot password ?</a> <a href="signup">don't have an account ?</a>
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input id="submit" type="submit" value="Login">
	</td>
</tr>
</table>
</form>
