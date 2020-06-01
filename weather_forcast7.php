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



//$data = "https://data.tmd.go.th/api/WeatherForecast7Days/V1/";
$data = "http://alerts.weather.gov/cap/tx.php?x=1";
$entries = file_get_contents($data);
$entries = new SimpleXmlElement($entries);
if(count($entries)):
    //echo "<pre>";print_r($entries);die;
    //alternate way other than registring NameSpace
    //$asin = $asins->xpath("//*[local-name() = 'ASIN']");

    $entries->registerXPathNamespace('prefix', 'http://www.w3.org/2005/Atom');
    $result = $entries->xpath("//prefix:entry");
    //echo count($asin);
    //echo "<pre>";print_r($result);die;
    foreach ($result as $entry):
        //echo "<pre>";print_r($entry);die;
        $dc = $entry->children('urn:oasis:names:tc:emergency:cap:1.1');
        echo $dc->event."<br/>";
        echo $dc->effective."<br/>";
        echo "<hr>";
    endforeach;
endif;

?>
