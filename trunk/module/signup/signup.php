<?php 

if ((isset($_POST['submit'])) AND ($_POST["name"]!="") AND ($_POST["email"]!="") AND ($_POST["username"]!="") AND ($_POST["password"]!="") AND ($_POST["confirm_password"]!="")) {
	// add user		
	$res=$obone->UserAllocate($_POST["username"], $_POST["password"]);
	
	if (($res!=false) AND ($res>0)) {
		// add user
		$obone_user=new Users();
		$obone_user->oneid=$res;
		$obone_user->user=$_POST["username"];
		$obone_user->password=sha1($_POST["password"]);
		$obone_user->name=$_POST["name"];
		$obone_user->email=$_POST["email"];
		$obone_user->sshkey=" ";
		$obone_user->enable=false;		
		$obone_user->Save();
		
		// add user privileges
		$pvalue=array(0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0);
		$index=1;
		foreach ($pvalue as $value) {
			$obone_userpriv=new User_Privileges();
			$obone_userpriv->user=$_POST["username"];
			$obone_userpriv->id=$index;
			$obone_userpriv->value=$value;
			$obone_userpriv->Save();	
			$index++;
		}
		
		// send mail
		$body=file_get_contents("module/signup/mail.signup.txt");
		$body=ereg_replace("%NAME%",$_POST["name"],$body);
		$body=ereg_replace("%EMAIL%",$_POST["email"],$body);
		$body=ereg_replace("%URL%",$url,$body);
		$body=nl2br($body);
		
		sendMassMail("ONE Console registration confirm",$body,$_POST["name"],$_POST["email"]);
		
		// success message
		$msgerror="Register account complete!, please check your e-mail to activate account.";		
	} else {
		// error message
		$msgerror="Cannot register account , please contact cloud administrator.";
	}
	
?>
<div class="login-container">
<h1 id="signup-logo"><a>One Console</a></h1>
<table class="round" width="490">
<tr>
	<td colspan="2"><?php if (isset($msgerror)) echo $msgerror;  ?></td>
</tr>
<tr>
	<td></td>
	<td align="right"><input type="button" value="OK" name="submit" class="submit" onClick="javascript:location.href='<?php echo $url; ?>';"></td>
</tr>
</table>
</div>
<?php 

} else {

?>
<div class="login-container">
<h1 id="signup-logo"><a>One Console</a></h1>
<form id="signup" name="signup" method="post" >
<table class="round">
<tr>
	<td><label for="name">Name</label></td>
	<td><input id="name" name="name" type="text" class="login-input"/></td>
</tr>
<tr>
	<td><label for="email">E-Mail</label></td>
	<td><input id="email" name="email" type="text" class="login-input" size="15"/></td>
</tr>
<tr>
	<td><label for="username">Username</label></td>
	<td><input id="username" name="username" type="text" class="login-input" size="10"/></td>
</tr>
<tr>
	<td><label for="password">Password</label></td>
	<td><input id="password" name="password" type="password" class="login-input" size="10"/></td>
</tr>
<tr>
	<td><label for="confirm_password">Confirm password</label></td>
	<td><input id="confirm_password" name="confirm_password" type="password" class="login-input" size="10"/></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" value="SignUp" class="submit" name="submit"></td>
</tr>
</table>
</form>
</div>
<?php 
} // else 
?>