<?php
	require 'config.php';
	include "template/".$template."/header.php";	
?>
<?php 

$obone=new One();
$obone->service_url=$xmlrpc;
$obone->session=$oneadmin.":".sha1($onepassword);

/** test class **/

//$xml=$obone->UserPool();
//$xml=$obone->UserAuthen("oneadmin", "oneadmin");
//$xml=$obone->UserDelete(6);
//$xml=$obone->UserAllocate("helen", "helen");
//$xml=$obone->UserPasswd(7, "xxx");
//$xml=$obone->UserAuthen("helen", "xxx");

//var_dump($xml);




?> 
<?php include "template/".$template."/footer.php"; ?>