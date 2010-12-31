<?php 
 
 if ((isset($_POST["signin"])) AND ($_POST["username"]!="") AND ($_POST["password"]!="") AND ($obone->UserAuthen($_POST["username"], $_POST["password"])==true)) {
 	
 	$_SESSION["SID"]=$_POST["username"].":".$_POST["password"];
 	header("Location: dashboard"); 	
 	
 } else {
  
 }
 

?>
<div class="login-container">
<h1 id="login-logo"><a>One Console</a></h1>
<form name="login" id="login" method="post">
<table class="round">
<tr>
	<td colspan="2">
		<label for="username">Username</label><br>
		<input type="text" name="username" size="20" class="login-input">
	</td>
</tr>
<tr>
	<td colspan="2">
		<label for="password">Password</label><br>
		<input type="password" name="password" size="20" class="login-input">
	</td>
</tr>
<tr>
	<td>
		<p class="login">
			<a href="forgotpassowrd.php">forgot password ?</a><br>
			<a href="signup.php">don't have an account ?</a>
			
		</p>
	</td>
	<td align="right">
		<input type="hidden" value="1" name="signin">
		<input type="submit" value="SignIn" class="submit">
	</td>
</tr>
</table>
</form>
</div>