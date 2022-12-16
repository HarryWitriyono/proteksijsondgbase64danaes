<?php $url="http://localhost/tiketsumber/";
function ambildatajsontiket($url){
	$cin=curl_init();
	curl_setopt($cin,CURLOPT_URL,$url);
	curl_setopt($cin,CURLOPT_RETURNTRANSFER,true);
	$hasiljson=curl_exec($cin);
	curl_close($cin);
    return $hasiljson;
}
function aesdec($pt) {
	$algo="aes-128-cbc";
	$kunci="1234567890111213";
	$iv="1234567890111213";
	$chsl=openssl_decrypt($pt,$algo,$kunci,$option=0,$iv);
	return $chsl;	
}
$daftarpelanggantiket=ambildatajsontiket($url);
if (empty($daftarpelanggantiket)){
echo "Server down !";
exit();
}
$hasil=json_decode($daftarpelanggantiket);
foreach($hasil as $r) {
	echo "NIK : ".aesdec(base64_decode($r->NIK))."<br>";
	echo "Nama Pelanggan : ".aesdec(base64_decode($r->NamaPelanggan))."<br>";
	echo "Alamat : ".aesdec(base64_decode($r->Alamat))."<br>";
	echo "Password : ".aesdec(base64_decode($r->Password))."<br>";
}
?>
