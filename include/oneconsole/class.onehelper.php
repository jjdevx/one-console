<?php


function isUserExsitByEmail($email) {
	$obone_user=New Users();
	$obone_user->Load("email='".$email."'");
	if (($obone_user->name)!="") {
		$result=TRUE;
	} else {
		$result=FALSE;
	}
	return $result;
}

function getUserInfoByEmail($email) {
	$obone_user=New Users();
	$obone_user->Load("email like '".$email."'");
	
	/*var_dump($obone_user);
	$result=array();
	array_push($result, $obone_user->user);
	array_push($result, $obone_user->password);
	array_push($result, $obone_user->name);
	array_push($result, $obone_user->email);
	array_push($result, $obone_user->sshkey);
	array_push($result, $obone_user->oneid);
	array_push($result, $obone_user->enable);
	*/
	return $obone_user;
}

/**
 * 
 * get realname of member
 * @param string $username
 */
function getRealNameByUsername($username){
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	return $obone_user->name; 
}

/**
 * 
 * show user menu
 * @param string $username
 */
function isShowUser($username){
	
	ADODB_Active_Record::ClassHasMany('Users', 'user_privileges','user');
		
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	
	$res=$obone_user->LoadRelations('user_privileges',"id=3 ");
	
	foreach ($res as $item) {
		($item->value=="1") ? $result=true : $result=false; 
	}
	
	return $result;
}

/**
 * 
 * show network menu
 * @param unknown_type $username
 */
function isShowNetwork($username){
	
	ADODB_Active_Record::ClassHasMany('Users', 'user_privileges','user');
		
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	
	$res=$obone_user->LoadRelations('user_privileges',"id=2 ");
	
	foreach ($res as $item) {
		($item->value=="1") ? $result=true : $result=false; 
	}
	
	return $result;	
}

/**
 * 
 * show host
 * @param unknown_type $username
 */
function isShowHost($username){
	
	ADODB_Active_Record::ClassHasMany('Users', 'user_privileges','user');
		
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	
	$res=$obone_user->LoadRelations('user_privileges',"id=1 ");
	
	foreach ($res as $item) {
		($item->value=="1") ? $result=true : $result=false; 
	}
	
	return $result;		
}

/**
 * 
 * show all vm
 * @param unknown_type $username
 */
function isShowAllVM($username){
	
	ADODB_Active_Record::ClassHasMany('Users', 'user_privileges','user');
		
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	
	$res=$obone_user->LoadRelations('user_privileges',"id=11 ");
	
	foreach ($res as $item) {
		($item->value=="1") ? $result=true : $result=false; 
	}
	
	return $result;		
}

/**
 * 
 * show all network
 * @param unknown_type $username
 */
function isShowAllNetwork($username){
	
	ADODB_Active_Record::ClassHasMany('Users', 'user_privileges','user');
	
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	
	$res=$obone_user->LoadRelations('user_privileges',"id=12 ");
	
	foreach ($res as $item) {
		($item->value=="1") ? $result=true : $result=false; 
	}
	
	return $result;		
}

function userAuthenDB($username,$password){
	$obone_user=new Users();
	$obone_user->Load("user='".$username."' AND password='".sha1($password)."'");
	if ($obone_user->enable==true) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function sendMassMail($subject,$body,$cname,$emailto) {
	global $smtp_host,$smtp_port,$admin_name,$admin_email;
	include_once("include/phpmailer/class.phpmailer.php");
	
	$mail = new phpmailer();
	$mail->CharSet="utf-8";
	$mail->IsHTML(true);
	$mail->Host= $smtp_host;
	$mail->Port= $smtp_port;
	$mail->Mailer="smtp";
	$mail->From=$admin_email;
	$mail->FromName=$admin_name;
	$mail->Subject=$subject;
	$mail->Body="<html><body>".stripcslashes($body)."</body></html>";
	$mail->AddAddress($emailto,$cname);
	$result=$mail->Send();
	// Clear all addresses and attachments for next loop
	$mail->ClearAddresses();
	return $result;
}

?>