<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>OpenNebula Web Management Console</title>
<link rel="stylesheet" type="text/css" href="template/default/style.css" />
<link rel="Stylesheet" type="text/css" href="include/jquery/css/ui-darkness/jquery-ui-1.8.7.custom.css"/>	
<!-- 
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="http://dev.jquery.com/view/trunk/plugins/validate/jquery.validate.js"></script>
 -->
<script type="text/javascript" src="include/jquery/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="include/jquery-validate/jquery.validate.js"></script>
<script type="text/javascript" src="include/jquery/js/jquery-ui-1.8.7.custom.min.js"></script>
<?php 
	// load module javacript
	global $ocreq;
	if ($ocreq[0]!="") {
?>
<script type="text/javascript" src="module/<?php echo $ocreq[0]; ?>/<?php echo $ocreq[0]; ?>.js"></script>
<?php 
	}
?>
</head>
<body>
