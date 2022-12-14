<?php 
$kon=mysqli_connect("localhost","root","","tiketkita");
$sql="select * from pelanggan";
$q=mysqli_query($kon,$sql);
$r=mysqli_fetch_array($q);
$hasil=array();
function aesenc($pt) {
	$algo="aes-128-cbc";
	$kunci="1234567890111213";
	$iv="1234567890111213";
	$chsl=openssl_encrypt($pt,$algo,$kunci,$option=0,$iv);
	return $chsl;	
}
do {
	$hsl=array(
	'NIK'=>base64_encode(aesenc($r['NIK'])),
	'NamaPelanggan' => base64_encode(aesenc($r['NamaPelanggan'])),
	'Alamat' => base64_encode(aesenc($r['Alamat'])),
	'Password' => base64_encode(aesenc($r['Password'])));
	array_push($hasil,$hsl);
}while($r=mysqli_fetch_array($q));
$hasil=json_encode($hasil);
echo $hasil;
?>