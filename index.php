<?php
function alexaRank($url) {
 $alexaData = simplexml_load_file("http://data.alexa.com/data?cli=10&url=".$url);
 $alexa['globalRank'] =  isset($alexaData->SD->POPULARITY) ? $alexaData->SD->POPULARITY->attributes()->TEXT : 0 ;
 $alexa['CountryRank'] =  isset($alexaData->SD->COUNTRY) ? $alexaData->SD->COUNTRY->attributes() : 0 ;
 return json_decode(json_encode($alexa), TRUE);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Alexa Rank checker tool in php</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <style>
     body {
        font-family: Helvetica,Arial,sans-serif;
        font-size: 14px;
        line-height: 22px;
        text-align: center;
      }
  </style>
</head>
<body>
<div>
<h1>Alexa Rank checker tool in php</h1>
<p> Simple php bases script to fetch website's alexa rank. </p>
<form method="get" action="">
<div>
   <p>Enter your domain name.</p>
   <p><input name="siteinfo" style="width:350px;" placeholder="E.g. gudanglink.com" required="required"/></p>
   <p><input type="submit" value="Get Alexa Rank" id="qr-gn"></p>
</div>
</form>
<br/>
<?php
if(isset($_REQUEST['siteinfo'])) {
 	$url = $_REQUEST['siteinfo'];
    $alexa = alexaRank($url);
    $globalRank = isset($alexa['globalRank'][0]) ? $alexa['globalRank'][0] : 'N/A';
    $countryRank = isset($alexa['CountryRank']['@attributes']['RANK']) ? $alexa['CountryRank']['@attributes']['RANK'] : 'N/A';
    echo "<h1>".$url." global alexa rank is <b style='color:red'>".$globalRank."</b> And Country (".$alexa['CountryRank']['@attributes']['NAME'].") rank is <b style='color:red'>".$countryRank."</b></h3>";
 }
 ?>
<div></div>
</body>
</html>
