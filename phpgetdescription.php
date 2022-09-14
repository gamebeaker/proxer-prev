<?php
$url = 'https://proxer.me/api/v1/info/entry';
$id = (int)$_GET['id'];
$fields = [
    'id'      => $id,
    'api_testmode' => 1
];

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

$fskinfo = [
'fsk0'         => 'Dieser Anime für alle geeignet.',
'fsk6'         => 'Dieser Anime ist nicht für Personen unter 6 Jahren geeignet.',
'fsk12'        => 'Dieser Anime ist nicht für Personen unter 12 Jahren geeignet.',
'fsk16'        => 'Dieser Anime ist nicht für Personen unter 16 Jahren geeignet.',
'fsk18'        => 'Dieser Anime ist nicht für Personen unter 18 Jahren geeignet.',
'bad_language' => 'Dieser Anime beinhaltet vulgäre Ausdrücke.',
'violence'     => 'Der Anime enthält Gewaltdarstellungen.',
'fear'         => 'Inhalt könnte verängstigend auf Kinder wirken.',
'sex'          => 'Erotische Darstellungen und Nacktheit mit sexuellem Bezug und Sexdarstellungen.'
];

$fields_string = http_build_query($fields);

$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_HEADER, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, $headertest);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_VERBOSE, true );

curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$headers = substr($response, 0, $header_size);
$body = substr($response, $header_size);
curl_close($ch);

?>

<tr class='preview<?php echo $id;?>'>
<td></td>
<td><a data-ajax="true" href="/info/<?php echo $id;?>#top"><img src='//cdn.proxer.me/cover/<?php echo $id;?>.jpg' style='width:200px; height:280px;'></a></td>
<td colspan='3'><table style='border-collapse: separate; background-color: #5e5e5e;'><tr style=' border-color: black; color: black;'>
<?php 

$PSK = explode(" ", json_decode($body, true)['data']['fsk']);
$PSKanz = count($PSK);
for ($i=0; $i < $PSKanz; $i++) { 
  if ($i == 0) {
  ?><td valign="top" style=' border-color: #5e5e5e;'><b>PSK</b></td><td valign="top"  style=' border-color: #5e5e5e;'><?php 
  }
  ?>
  <span style="cursor: help; margin:5px;" class="tip" title="<?php echo $fskinfo[$PSK[$i]]; ?>">
  <img src="/images/fsk/<?php echo $PSK[$i];?>.png" width="100" height="100">
  </span>
  <?php
  if ($i == $PSKanz-1){
  ?></td><?php
  }
}
?>
</tr><tr><td colspan='2'  style=' border-color: #5e5e5e;'><b>Beschreibung:</b><br><?php echo json_decode($body, true)['data']['description'];?></td></tr></table></td>
<td colspan='2'></td>
</tr>


