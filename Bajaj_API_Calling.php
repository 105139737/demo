<?
function callAPIB($method, $url, $data,$force_refresh=true){


$cache 			= __DIR__."/json.cache"; // make this file in same dir
$refresh		= 60*60; // once an hour
// cache json results so to not over-query (api restrictions)
if ($force_refresh || ((time() - filectime($cache)) > ($refresh) || 0 == filesize($cache))) {
	// read json source
	$ch = curl_init($url) or die("curl issue");
	$curl_options = array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_FRESH_CONNECT => true,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 60,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => $method,
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Connection: keep-alive",
    "Content-Type: application/json",
    "Host: prodapitm.bajajfinserv.in",
    "Ocp-Apim-Subscription-Key: 3a4e5289e5a44c46ab3dd81ac735d313"
  ),
);
	curl_setopt_array($ch, $curl_options);
	$curlcontent = curl_exec( $ch );
	curl_close( $ch );
	
	$handle = fopen($cache, 'wb') or die('no fopen');	
	$json_cache = $curlcontent;
	fwrite($handle, $json_cache);
	fclose($handle);
} else {
	$json_cache = file_get_contents($cache); //locally
}
return $json_cache;
}
?>