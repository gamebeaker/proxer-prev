<!DOCTYPE html>
<html>
<head>  
</head>
<body>
<?php
$url = 'https://proxer.me/anime/animeseries/clicks/all#top';

$headertest = [
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:104.0) Gecko/20100101 Firefox/104.0',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
'Accept-Language: de,en-US;q=0.7,en;q=0.3',
'Accept-Encoding: deflate',
'DNT: 1',
'Connection: keep-alive',
'Upgrade-Insecure-Requests: 1',
'Sec-Fetch-Dest: document',
'Sec-Fetch-Mode: navigate',
'Sec-Fetch-Site: same-origin',
'Sec-Fetch-User: ?1',
'Pragma: no-cache',
'Cache-Control: no-cache'
];

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, $headertest);
curl_setopt($ch,CURLOPT_VERBOSE, true );

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);
curl_close($ch);

echo $body;
?>

</div>
</body>
</html>
