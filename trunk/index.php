<?php

	require 'config.php';
	include "template/".$template."/header.php";	

	$obone=new One();
	$obone->service_url=$xmlrpc;
	$obone->session=$oneadmin.":".sha1($onepassword);
	
	/** test user **/	
	//$xml=$obone->UserPool();
	//$xml=$obone->UserAuthen("oneadmin", "oneadmin");
	//$xml=$obone->UserDelete(6);
	//$xml=$obone->UserAllocate("helen", "helen");
	//$xml=$obone->UserPasswd(7, "xxx");
	//$xml=$obone->UserAuthen("helen", "xxx");
	
	/** test VM **/
	
	//$xml=$obone->VmPool(0,TRUE,-1);
	//$xml=$obone->VmInfo(112);
	//$xml==$obone->VmAction("stop",112);
		
	/** test Host **/
	//$xml=$obone->HostPool();
	//$xml=$obone->HostInfo(0);
	//$xml=$obone->HostEnable(0,TRUE);
	
	/** test VNet **/
	//$xml=$obone->VNetPool(-2);
	//$xml=$obone->VNetInfo(0);
	
	/** test Image **/
	//$xml=$obone->ImagePool(-2);
	//$xml=$obone->ImageInfo(5);
	//$xml=$obone->ImageDelete(4);
	
	
	/** test Cluster **/
	//$xml=$obone->ClusterPool();
	//$xml=$obone->ClusterInfo(0);
	//$xml=$obone->ClusterAllocation("Testing Group");
	//$xml=$obone->ClusterDelete(1);
	//$xml=$obone->ClusterHostAdd(0, 1);
	//$xml=$obone->ClusterHostRemove(0);
	
	
	var_dump($xml);

?>
<button id="opener">Open Dialog</button>

<div id="dialog-modal" title="Basic dialog">
	<p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>


<?
	include "template/".$template."/footer.php"; 

?>
