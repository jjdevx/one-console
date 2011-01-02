<?php

require '../../config.php';

$request = trim(strtolower($_REQUEST['username']));

$obone=new One();
$obone_user=new Users();
$result=$obone_user->Find("user like '".$request."'");
$valid = 'true';
if ((count($result)) > 0) {	
	$valid = '"<br>Thats already taken."';
}
echo $valid;
?>