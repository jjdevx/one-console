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

?>