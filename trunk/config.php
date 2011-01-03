<?php

require_once('include/adodb5/adodb.inc.php');
require_once('include/adodb5/adodb-active-record.inc.php');

$dbhost="localhost";
$dbname="oneconsole";
$dbusername="root";
$dbpassword="monalisa";

$url="http://localhost";

$language="en";
$template="default";

$smtp_host="localhost";
$smtp_port="25";

$oneadmin="oneadmin";
$onepassword="oneadmin";

$xmlrpc="http://localhost:2633/RPC2";

$db = &ADONewConnection('mysql'); 
$db->PConnect($dbhost,$dbusername,$dbpassword,$dbname);

//$db->debug=1;

if (!$db) die("Connection failed");   

ADOdb_Active_Record::SetDatabaseAdapter($db);

require 'include/oneconsole/class.user.php';
require 'include/oneconsole/class.user_privileges.php';
require 'include/oneconsole/class.template.php';
require 'include/oneconsole/class.privileges.php';
require 'include/oneconsole/class.one.php';
require 'include/oneconsole/class.onehelper.php';

require "language/".$language.".php";

session_start();


?>