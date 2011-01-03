<?php 

if ((isset($_POST["submit"])) AND ($_POST["email"]!="")) {
	// check user exist
	$result=getUserInfoByEmail($_POST["email"]);
	
	if (($result->oneid)!="") {
		// if usr exist then reset password and inform via e-mail		
		// gen salt and reset password in database then reset password in Cloud Infra
		$salt=substr(sha1(time()),0,10);
		$obone->UserPasswd($result->oneid, $salt);
		$obone_user=new Users();
		$obone_user->Load("oneid=".$result->oneid);
		$obone_user->password=sha1($salt);
		$obone_user->Save();
		
		// send mail
		$body=file_get_contents("module/lostpassword/mail.lostpassword.txt");
		$body=ereg_replace("%NAME%",$result->name,$body);
		$body=ereg_replace("%SALT%",$salt,$body);
		$body=nl2br($body);
		
		sendMassMail("ONE Console reset password",$body,$result->name,$result->email);
		
		$msgerror="Your new password was sent to your e-mail address!";
		
	} else {
		$msgerror="Your e-mail address is not exist!";
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
<form id="lostpass" name="signup" method="post" name="signup.php">
<table class="round">
<tr>
	<td colspan="2"><label class="error"><?php if (isset($msgerror)) echo $msgerror;  ?></label></td>
</tr>
<tr>
	<td><label for="email">E-Mail</label></td>
	<td><input id="email" name="email" type="text" class="login-input" size="22"/></td>
</tr>

<tr>
	<td></td>
	<td><input type="submit" value="Reset Password" name="submit" class="submit" ></td>
</tr>
</table>
</form>
</div>
<?php 
} // else
?>
