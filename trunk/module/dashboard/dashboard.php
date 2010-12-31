<?php 
	
	// split user
	$oneuser=split(":",$_SESSION["SID"]);

?>
<div id="header">
<div id="dashboard-menu">Loged in as <a href="<?=$url;?>/preference"><?=getRealNameByUsername($oneuser[0]); ?></a> | <a href="<?=$url;?>/signout">SignOut</a></div>
<div id="dashboard-header"></div>
<div id="nav-menu">
<ul>
<li class="selected"><a href="<?=$url;?>/dashboard">Dashboard</a></li>
<li><a href="<?=$url;?>/instance">Instance</a></li>
<li><a href="<?=$url;?>/templates">Template</a></li>
<li><a href="<?=$url;?>/library">Library</a></li>
<li><a href="<?=$url;?>/report">Report</a></li>
<?php 
	if (isShowHost($oneuser[0])==true) {
?>
<li><a href="<?=$url;?>/host">Host</a></li>
<?php 
	}
?>
<?php 
	if (isShowNetwork($oneuser[0])==true) {
?>
<li><a href="<?=$url;?>/network">Network</a></li>
<?php 
	}
?>
<?php 
	if (isShowUser($oneuser[0])==true) {
?>
<li><a href="<?=$url;?>/member">Member</a></li>
<li><a href="<?=$url;?>/permission">Permission</a></li>
<?php 
	}
?>
</ul>
</div>
</div> 