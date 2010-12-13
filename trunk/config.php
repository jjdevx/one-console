<?php

require_once('include/adodb5/adodb.inc.php');
require_once('include/adodb5/adodb-active-record.inc.php');

$dbhost="localhost";
$dbname="oneconsole";
$dbusername="root";
$dbpassword="monalisa";

$language="en";
$template="default";

$db = &ADONewConnection('mysql'); 
$db->PConnect($dbhost,$dbusername,$dbpassword,$dbname);

if (!$db) die("Connection failed");   

ADOdb_Active_Record::SetDatabaseAdapter($db);

require 'include/oneconsole/class.user.php';
require 'include/oneconsole/class.user_privileges.php';
require 'include/oneconsole/class.template.php';
require 'include/oneconsole/class.privileges.php';

require "language/".$language.".php";

session_start();



?>