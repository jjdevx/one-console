<?php 


if ((isset($_REQUEST['email'])) AND ($_REQUEST['email']!="")) {
	
	$obone_user= new Users();
	$obone_user->Load("email='".$_REQUEST['email']."'");
	
	if ($obone_user->email==$_REQUEST['email']) {
	 	
		$obone_user->enable=true;
		$obone_user->Save();
		
		$msgerror="Your account has been activated.";
		
	} else {
		
		$msgerror="E-Mail is not exist, please check your e-mail address to activate an account.";
	}
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
	<td align="right"><input type="button" value="OK" name="submit" class="submit" onClick="javascript:location.href='<?php echo $url; ?>/signin';"></td>
</tr>
</table>
</div>