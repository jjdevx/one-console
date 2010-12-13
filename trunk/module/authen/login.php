<?php 

if ($_REQUEST['login']!="") {
	// authen from XML RPC2	
	
} else {
	// show login form
?>
<form name="login" method="post">
<table>
<tr>
	<td><?=_USERNAME; ?></td>
	<td><input type="text" name="username" ></td>
</tr>
<tr>
	<td><?=_PASSWORD; ?></td> 
	<td><input type="password" name="password" ></td>
</tr>
<tr>
	<td></td> 
	<td><input type="submit" name="login" value="<?=_LOGIN?>"></td>
</tr>
</table>
</form>
<?php 
	
} 
?>