<?php
	require 'config.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>OpenNebula Web Management Console</title>
</head>
<body>
<?php 

if (!isset($_SESSION['onesession'])) {
	include 'module/authen/login.php';
} else {
	echo "loged in";
}

?> 
</body>
</html>