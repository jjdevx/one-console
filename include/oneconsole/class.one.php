<?php 

class One {

	var $service_url="http://localhost:2633/RPC2";
	var $session="";
	
	/**
	 * send xml data to OpenNebula RPC server
	 * @param $method
	 * @param $argument
	 */
	function rpc_send($method,$argument){		
		//Using the XML-RPC extension to format the XML package
		$request = xmlrpc_encode_request($method,$argument);
		$req = curl_init($this->service_url);

		//Using the cURL extension to send it off,  first creating a custom header block
		$headers = array();
		array_push($headers,"Content-Type: text/xml");
		array_push($headers,"Content-Length: ".strlen($request));
		array_push($headers,"\r\n");

		//URL to post to
		curl_setopt($req, CURLOPT_URL,$this->service_url);

		//Setting options for a secure SSL based xmlrpc server
		curl_setopt($req, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($req, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($req, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt($req, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($req, CURLOPT_HTTPHEADER, $headers );
		curl_setopt($req, CURLOPT_POSTFIELDS, $request );

		//Finally run
		$response = curl_exec($req);
				
		//Close the cURL connection
		curl_close($req);
				
		//Decoding the response to be displayed
		$result=xmlrpc_decode($response);	
		
		return $result;	
	}

	/**
	 * 
	 * allocates a virtual machine description from the given template string,
	 * return 1 is success return null or 0 is fail.
	 * @param $temlate
	 */
	function VmAllocate($temlate) {
		$result=$this->rpc_send("one.vm.allocate", array($this->session,$temlate));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}
		}
		return $result;
	}
	
	/**
	 * 
	 * initiates the instance of the given vmid on the target host,
	 * return 1 is success return null or 0 is fail.
	 * @param $vid
	 * @param $hid
	 */
	function VmDeploy($vid,$hid){
		$result=$this->rpc_send("one.vm.deploy", array($this->session,$vid,$hid));
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=FALSE;
			} else {
				$result=TRUE;
			}		
		}
		return $result;		
	}
	
	/**
	 * submits an action to be performed on a virtual machine. the action name to be performed, 
	 * can be: “shutdown”, “hold”, “release”, “stop”, “cancel”, “suspend”, 
	 * “resume”, “restart”, “finalize” 
	 * @param string $action
	 * @param int $vid
	 */
	function VmAction($action,$vid) {
		$result=$this->rpc_send("one.vm.action", array($this->session,$action,$vid));
				
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}		
		return $result;		
	}
	
	
	/**
	 * migrates one virtual machine (vid) to the target host (hid).
	 * @param $vid
	 * @param $hid
	 */
	function vmMigrate($vid,$hid){
		$result=$this->rpc_send("one.vm.migrate", array($this->session,$vid,$hid));
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;
	}
	
	/**
	 * Sets the disk to be saved in the given image.
	 * @param $vid
	 * @param $did
	 * @param $iid
	 */
	function VmSaveDisk($vid,$did,$iid){
		$result=$this->rpc_send("one.vm.savedisk", array($this->session,$vid,$did,$iid));
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;
	}
	
	/**
	 * gets information on a virtual machine 
	 * @param $vid
	 */
	function VmInfo($vid){
		$result=$this->rpc_send("one.vm.info", array($this->session,$vid,$did,$iid));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);			
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}

	/**
	 * Retrieves all or part of the VMs in the pool. 
	 * This method can be called with only the first two parameters for compatibility 
	 * with previous versions. 
	 * Filter flag < = -2: All VMs, -1: Connected user's VMs, > = 0: UID User's VMs
	 * 
	 * @param int $flag
	 * @param boolean $info
	 * @param int $state
	 */
	function VmPool($flag,$info=false,$state="-1") {
		$result=$this->rpc_send("one.vmpool.info", array($this->session,$flag,$info,$state));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);			
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;		
	}
	
	/**
	 * adds a host to the host list
	 * @param $hostname
	 * @param $im
	 * @param $vmm
	 * @param $tm
	 * @param $flag
	 */
	function HostAllocate($hostname,$im="im_kvm",$vmm="vmm_kvm",$tm="tm_nfs",$flag=true) {
		$result=$this->rpc_send("one.host.allocate", array($this->session,$hostname,$im,$vmm,$tm,$flag));
			if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;		
	}
	
	/**
	 * retrieves the information of the given host
	 * @param $hid
	 */
	function HostInfo($hid){
		$result=$this->rpc_send("one.host.info", array($this->session,$hid));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);				
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}

	/**
	 * deletes a host from the host list
	 * @param int $hid
	 */
	function HostDelete($hid){
		$result=$this->rpc_send("one.host.delete", array($this->session,$hid));
		if ($result[0]=true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;
	}
	
	/**
	 * Enables or disables a given host
	 * @param unknown_type $hid
	 * @param unknown_type $enable
	 */
	function HostEnable($hid,$enable=true){
		$result=$this->rpc_send("one.host.enable", array($this->session,$hid,$enable));
		if ($result[0]=true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;
	}
	
	/**
	 * retrieves all the hosts the pool 
	 */
	function HostPool(){
		$result=$this->rpc_send("one.hostpool.info", array($this->session));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);				
			$xml=simplexml_load_string($result[1]);
		}
		return $xml;	
	}
	
	/**
	 * 
	 * allocates a new virtual network
	 * @param $template
	 */
	function VNetAllocate($template){
		$result=$this->rpc_send("one.vn.allocate", array($this->session,$template));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}
		}
		return $result;
	}
	
	/**
	 * retrieves the information of the given virtual network
	 * @param $vid
	 */
	function VNetInfo($vid){
		$result=$this->rpc_send("one.vn.info", array($this->session,$vid));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);			
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}
	
	/**
	 * deletes a virtual network from the virtual network pool
	 * @param $vid
	 */
	function VNetDelete($vid){
		$result=$this->rpc_send("one.vn.delete", array($this->session,$vid));
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}
		}
		return $result;
	}
	
	/**
	 * Publishes or unpublishes a virtual network.
	 * @param $vid
	 * @param $enable
	 */
	function VNetPublish($vid,$enable=true){
		$result=$this->rpc_send("one.vn.publish", array($this->session,$vid,$enable));
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}
		}
		return $result;
	}

	/**
	 * retrieves all or part of the Virtual Networks in the pool 
	 * Filter flag < = -2: All VNs, -1: Connected user's VNs and Public ones, > = 0: UID User's VNs
	 */
	function VNetPool($flag=-2){
		$result=$this->rpc_send("one.vnpool.info", array($this->session,$flag));	
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);			
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}
	
	/** 
	 * add user to pool,
	 * return 1 is success return null or 0 is fail. 
	 * @param $username
	 * @param $passwd
	 */	
	function UserAllocate($username,$passwd) {
		$result=$this->rpc_send("one.user.allocate", array($this->session,$username,sha1($passwd)));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>0)) {
				$result=true;
			} else {
				$result=false;
			}
		}
		return $result;
	}
	
	/**
	 * Change password,
	 * return 1 is success return null is fail. 
	 * @param int $uid
	 * @param string $password
	 */	
	function UserPasswd($uid,$passwd) {
		$result=$this->rpc_send("one.user.passwd", array($this->session,$uid,sha1($passwd)));	
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;		
	}

	/**
	 * Delete user in pool, return 1 is success return null is fail.
	 * @param int $uid
	 */
	function UserDelete($uid) {
		$result=$this->rpc_send("one.user.delete", array($this->session,$uid));		
		if ($result[0]==true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;
	}
	
	/**
	 * List all users in pool, return is SimpleXML object.
	 */
	function UserPool() {
		$result=$this->rpc_send("one.userpool.info", array($this->session));		
		if (($result[0]==true)) {
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}
	
	/**
	 * User authentication, return 1 is success return null is fail.
	 * @param string $username
	 * @param string $password
	 */	
	function UserAuthen($username,$password) {
		$result=$this->rpc_send("one.userpool.info",array($this->session));
		$salt=$username.":".sha1($password);
		if (($result[0]==true)) {
			$xml=simplexml_load_string($result[1]);
			foreach ($xml->USER as $item) {	
				$saltorig=$item->NAME.":".$item->PASSWORD;
				if ($salt==$saltorig) {
					$result=true;
					return $result;
				} 
			}
		}		
		
	}
	
	/**
	 * allocates a new image
	 * @param $template
	 */
	function ImageAllocate($template){
		$result=$this->rpc_send("one.image.allocate", array($this->session,$template));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}
		}
		return $result;
	}
	
	/**
	 * retrieves the information of the given image
	 * @param $iid
	 */
	function ImageInfo($iid) {
		$result=$this->rpc_send("one.image.info", array($this->session,$iid));
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;		
	}
	
	/**
	 * deletes an image from the image pool
	 * @param $iid
	 */
	function ImageDelete($iid){
		$result=$this->rpc_send("one.image.delete", array($this->session,$iid));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;
	}
	
	/**
	 * 
	 * Modifies an image attribute
	 * @param $iid
	 * @param $attr
	 * @param $value
	 */
	function ImageUpdateArrtibute($iid,$attr,$value){
		$result=$this->rpc_send("one.image.update", array($this->session,$iid,$attr,$value));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;
	}
	
	/**
	 * Removes an image attribute
	 * @param $iid
	 * @param $attr
	 */
	function ImageRemoveArrtibute($iid,$attr){
		$result=$this->rpc_send("one.image.rmattr", array($this->session,$iid,$attr));
			if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;
	}
	
	/**
	 * Enables or disables an image
	 * @param unknown_type $iid
	 * @param unknown_type $enable
	 */
	function ImageEnable($iid,$enable=true){
		$result=$this->rpc_send("one.image.enable", array($this->session,$iid,$attr));
			if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;
	}

	/**
	 * Publishes or unpublishes an image
	 * @param unknown_type $iid
	 * @param unknown_type $enable
	 */
	function ImagePublish($iid,$enable=true){
		$result=$this->rpc_send("one.image.publish", array($this->session,$iid,$attr));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}		
		} else {
			$result=false;
		}
		return $result;
	}
	
	/**
	 * Retrieves all or part of the images in the pool, 
	 * Filter flag < = -2: All Images, -1: Images belonging to the connected user and Public ones,
	 * > = 0: UID User's Images
	 * @param $flag
	 */
	function ImagePool($flag=-2){
		$result=$this->rpc_send("one.imagepool.info", array($this->session,$flag));		
		if (($result[0]==true)) {
			$result[1]=str_replace("<![CDATA[", "",$result[1]);
			$result[1]=str_replace("]]>", "",$result[1]);			
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}
	
	/**
	 * 
	 * Creates a new cluster in the pool
	 * @param string $name
	 */
	function ClusterAllocation($name){
		$result=$this->rpc_send("one.cluster.allocate", array($this->session,$name));
		if ($result[0]==true) {
			if ((count($result) > 1) AND ($result[1]>=0)) {
				$result=true;
			} else {
				$result=false;
			}
		}
		return $result;
	}
	
	/**
	 * 
	 * Retrieves the information of the given cluster
	 * @param $cid
	 */
	function ClusterInfo($cid){
		$result=$this->rpc_send("one.cluster.info", array($this->session,$cid));
		if (($result[0]==true)) {
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;	
	}
	
	/**
	 * 
	 * Deletes a cluster from the cluster pool
	 * @param $cid
	 */
	function ClusterDelete($cid) {
		$result=$this->rpc_send("one.cluster.delete", array($this->session,$cid));
		if ($result[0]=true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;		
	}
	
	/**
	 * 
	 * Adds a host to a cluster.
	 * @param int $hid
	 * @param int $cid
	 */
	function ClusterHostAdd($hid,$cid){
		$result=$this->rpc_send("one.cluster.add", array($this->session,$hid,$cid));
		if ($result[0]=true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;			
	}
	
	/**
	 * 
	 * Removes a host from its cluster.
	 * @param unknown_type $hid
	 */
	function ClusterHostRemove($hid) {
		$result=$this->rpc_send("one.cluster.remove", array($this->session,$hid));
		if ($result[0]=true) {
			if (count($result) > 1) {
				$result=false;
			} else {
				$result=true;
			}		
		}
		return $result;	
	}
	
	/**
	 * 
	 * Returns the cluster pool information.
	 */
	function ClusterPool(){
		$result=$this->rpc_send("one.clusterpool.info", array($this->session,$flag));		
		if (($result[0]==true)) {
			$xml=simplexml_load_string($result[1]);
		}		
		return $xml;
	}
	
}

?>