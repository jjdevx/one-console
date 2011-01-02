<?php

require '../../config.php';

$request = trim(strtolower($_REQUEST['email']));

$obone=new One();
$obone_user=new Users();
$result=$obone_user->Find("email like '".$request."'");
$valid = 'true';
if ((count($result)) > 0) {	
	$valid = '"<br>Thats already taken."';
}
echo $valid;
?>