<?php
require("routeros_api.class.php");
$API = new routeros_api();
$API->debug = false;
$user_mikrotik  = "kintil";
$password_mikrotik  = "jirin";
$ip_mikrotik    = "10.5.250.1";

if($API->connect($ip_mikrotik, $user_mikrotik, $password_mikrotik)){
$username 	= $_POST['username'];
$password 	= $_POST['password'];
$nomor		= $_POST['nomor'];
$mac	  	= $_POST['mac'];
	try {
	$cekuser = $API->comm('/ip/hotspot/user/print',array(
			"?name"     => $username,
			));
	$cekmac = $API->comm('/ip/hotspot/user/print',array(
			"?mac-address"     => $mac,
			));
	if(count($cekuser)>0 or count($cekmac)>0){
		echo "<script>window.location='http://wifi.sman1cepu.sch.id/gagal.html'</script>";
	}else{
    $API->comm("/ip/hotspot/user/add", array(
			"server"		=> "all",
			"profile"		=> "Siswa",
			"name"     		=> $username,
			"password"		=> $password,
			"mac-address"	=> $mac,		
			"comment"		=> $nomor,
			"limit-uptime"	=> "00:00:00",
			"disabled"		=> "yes",
			));
    echo "<script>window.location='http://wifi.sman1cepu.sch.id/aktivasi.html'</script>";
		}
		$API->disconnect();
	} 
	catch (Exception $ex) {
	echo "Caught exception from router: " . $ex->getMessage() . "\n";
	}	
 
} else {
  echo " Router Not Connected";
  }
?>