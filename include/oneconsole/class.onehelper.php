<?php


function getRealNameByUsername($username){
	$obone_user=New Users();
	$obone_user->Load("user='".$username."'");	
	return $obone_user->name; 
}

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