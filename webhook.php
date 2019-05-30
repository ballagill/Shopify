<?php
header('Content-Type: application/json');
$request = file_get_contents('php://input');
$req_dump = print_r( $request, true );
$fp = file_put_contents( 'webhook.txt', $req_dump );


$handle = fopen("webhook.txt",'r');
$contents = file_get_contents("webhook.txt");	
	$response = json_decode($contents);
		$new=array();
		print_r($response);



$newarr=$response->line_items;
$customer_id = $response->customer->id;
$customer_name =  $response->customer->first_name.' '.$response->customer->last_name;


$a=array();
$price=array();
$barcode=array();
$sku=array();
$product_id='';
$prouct_handle=array();
foreach($newarr as $newrr){
	array_push($a,$newrr->title);
	array_push($price,$newrr->price);
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://22222222222222222222222222222222:22222222222222222222222222222222@mysite.myshopify.com/admin/variants/'.$newrr->variant_id.'.json',
	CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	$variantresponse = curl_exec($curl);	
	$vresponse = json_decode($variantresponse);
	foreach($vresponse as $vres){
		array_push($barcode,$vres->barcode);
		array_push($sku,$vres->sku);
		$product_id = $vres->product_id;
		
		
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => 'https://22222222222222222222222222222222:22222222222222222222222222222222@mysite.myshopify.com/admin/products/'.$product_id.'.json',
	CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	));
	$productresponse = curl_exec($curl);	
	$presponse = json_decode($productresponse);

foreach($presponse as $ppresponse){
array_push($prouct_handle,$ppresponse->handle);
 }	
		
		
		
		}}







echo $comma_separated = implode("  |  ", $a);
$val="lorem lorem";
$i= 0;
foreach($a as $aaaa){
    $aaa = str_replace("'","",$aaaa);
    $aa = str_replace('"','',$aaa);
 $order_reference = ltrim ($response->name,'#');	
if($response->email==""){}else{	



$created = explode('T',$response->created_at);


	$csv.= $response->email.','.$customer_name.','.$response->created_at.','.$aa.','.$order_reference.','.$prouct_handle[$i].','.$sku[$i].','.$customer_id.','.$price[$i].','.$response->currency.','."category:".$ppresponse->product_type.','."colette-au".','.$barcode[$i]."\n";


}
$i= $i+1;
}

$file_name = '05-29-2019-orders.csv';
$csv_handler = fopen ($file_name,'a');
fwrite ($csv_handler,$csv);
fclose($csv_handler);

include_once 'webhook_daily_basis.php';
 echo 'Data saved to txt file';
 
 
 
exit; 

?>