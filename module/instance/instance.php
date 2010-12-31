<?php 
	
	// split user
	$oneuser=split(":",$_SESSION["SID"]);
	// load privileges
	$obone_user=New Users();
	$obone_user->Load("user='".$oneuser[0]."'");	
	// check provileges 
	
?>
<div id="header">
<div id="dashboard-menu">Loged in as <a href="<?=$url;?>/preference"><?=$obone_user->name; ?></a> | <a href="<?=$url;?>/signout">SignOut</a></div>
<div id="dashboard-header"></div>
<div id="nav-menu">
<ul>
<li><a href="<?=$url;?>/dashboard">Dashboard</a></li>
<li class="selected"><a href="<?=$url;?>/instance">Instance</a></li>
<li><a href="<?=$url;?>/templates">Template</a></li>
<li><a href="<?=$url;?>/library">Library</a></li>
<li><a href="<?=$url;?>/report">Report</a></li>
<li><a href="<?=$url;?>/host">Host</a></li>
<li><a href="<?=$url;?>/network">Network</a></li>
<li><a href="<?=$url;?>/member">Member</a></li>
<li><a href="<?=$url;?>/permission">Permission</a></li>
</ul>
</div>
</div> 