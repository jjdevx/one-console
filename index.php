<?php

	require 'config.php';
	$obone=new One($xmlrpc, $oneadmin.":".sha1($onepassword));
	
	/*
	 * $obone->service_url=$xmlrpc;
	 * $obone->session=$oneadmin.":".sha1($onepassword);
	 */	

	$_SESSION['SID']="";
	
	// split query string
	$ocreq=split("/",$_REQUEST['q']);

	// check exist session
	if (($_SESSION['SID']=="") AND ($ocreq[0]!="lostpassword") AND ($ocreq[0]!="signin") AND ($ocreq[0]!="signup")) {
		header("Location: ".$url."/signin");
	} 
	
	// check module file exist load it!
	
	if ((file_exists("module/".$ocreq[0]."/".$ocreq[0].".php")) AND ($ocreq[0]!="")) {
		$modload=TRUE;
	} else {
		header("Location: ".$url."/dashboard");
	}
	
	// load header theme
	
	include "template/".$template."/header.php";
	
	// load module
	if ($modload==TRUE) {
		include "module/".$ocreq[0]."/".$ocreq[0].".php";
	} 
		
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
	
	
	
?>



<?

	include "template/".$template."/footer.php"; 

?>
