<?php

require_once('include/adodb5/adodb.inc.php');
require_once('include/adodb5/adodb-active-record.inc.php');

$db = &ADONewConnection('mysql'); 
$db->PConnect('localhost','root','monalisa','oneconsole');

if (!$db) die("Connection failed");   

ADOdb_Active_Record::SetDatabaseAdapter($db);

require 'include/oneconsole/class.user.php';
require 'include/oneconsole/class.user_privileges.php';
require 'include/oneconsole/class.template.php';
require 'include/oneconsole/class.privileges.php';

require 'language/en.php';

session_start();


?>