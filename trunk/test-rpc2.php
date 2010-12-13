<?php 

//Using the XML-RPC extension to format the XML package
$request = xmlrpc_encode_request("one.userpool.info", array("oneadmin".":".sha1("oneadmin")));
$req = curl_init("http://172.16.20.183:2633/RPC2");

// Using the cURL extension to send it off,  first creating a custom header block
$headers = array();
array_push($headers,"Content-Type: text/xml");
array_push($headers,"Content-Length: ".strlen($request));
array_push($headers,"\r\n");

//URL to post to
curl_setopt($req, CURLOPT_URL, "http://172.16.20.183:2633/RPC2");

//Setting options for a secure SSL based xmlrpc server
curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($req, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt( $req, CURLOPT_CUSTOMREQUEST, "POST" );
curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
curl_setopt( $req, CURLOPT_POSTFIELDS, $request );

//Finally run
$response = curl_exec($req);

//Close the cURL connection
curl_close($req);

//Decoding the response to be displayed
$arr=xmlrpc_decode($response);

?>