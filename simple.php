<?php
$searchName = "";//The searchname as found in the url on the dashboard
$limit = 10;//The amount of results you want
$apiKey = ""; //unique apiKey for an account
$apiUrl = "/results/". urlencode($searchName) . "/limit:10";

$ch = curl_init("https://www.tracebuzz.com/api". $apiUrl);

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, 
    array('Authorization: '. $apiKey,   
          'Accept: application/json')); //application/json or application/xml for json or xml response. 

$result = json_decode(curl_exec($ch));
curl_close($ch);

var_dump($result); //To show you our response
if($result->status == "SUCCES") {
    
    foreach($result->data->results as $uniqueId => $result) {//These are the results. 
        var_dump($result);
    }
    
} else {
    var_dump($result->messages); //May contain error, warning, info and succes messages. For this example it should only return error messages. A message consist of a type, title and sometimes a description.
}
?>