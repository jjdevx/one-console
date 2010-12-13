<?php

require_once('include/adodb5/adodb-active-record.inc.php');

$db = NewADOConnection('mysql://root:pwd@localhost/oneconsole');
ADOdb_Active_Record::SetDatabaseAdapter($db);

?>