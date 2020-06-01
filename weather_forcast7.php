<?php

//		$fullurl = 'https://data.tmd.go.th/api/WeatherForecast7Days/V1/';
//
//		/*
//        $AccessToken = 'BwGlN2OsLJCMUF/YoAdKJR5GwQYCxU3BLTIPkMLLPC1IjVPH-S2LhD_P0R~GiPKA=JOP8N7MeY1U1ArA3X$LAQ0XfOiVsVxVUO2';
// 
//        $header = array(
//            "Content-Type: application/json",
//            'Authorization: Token '.$AccessToken,
//        );
//		*/
//         
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_VERBOSE, 1);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//		//curl_setopt( $ch, CURLOPT_POST, 1); //POST 
//        //curl_setopt($ch, CURLOPT_FAILONERROR, 0);
//        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//        curl_setopt($ch, CURLOPT_URL, $fullurl);
//         
//        $returned =  curl_exec($ch);
//        curl_close($ch);
//
//
//		//$xml = simplexml_load_string($returned);
//		//$json = json_encode($returned);
//		$array = json_decode($json,TRUE);
//		echo $json;



$fileContents= file_get_contents("https://data.tmd.go.th/api/WeatherForecast7Days/V1/");
$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
$fileContents = trim(str_replace('"', "'", $fileContents));
$simpleXml = simplexml_load_string($fileContents);
$json = json_encode($simpleXml);
$array = json_decode($json,TRUE); // convert the JSON-encoded string to a PHP variable
//return $array;

header('Content-Type: application/json; charset=utf-8');
echo $json;

?>
