<?php

		$prv=$_REQUEST['prv'];

		$fullurl = 'https://data.tmd.go.th/api/WeatherForecast7Days/V1/';

		
        //$AccessToken = 'BwGlN2OsLJCMUF/YoAdKJR5GwQYCxU3BLTIPkMLLPC1IjVPH-S2LhD_P0R~GiPKA=JOP8N7MeY1U1ArA3X$LAQ0XfOiVsVxVUO2';
 
       // $header = array(
       //    "Content-Type: application/json",
       //     'Authorization: Token '.$AccessToken,
       // );
		
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt( $ch, CURLOPT_POST, 1); //POST 
        //curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		//echo $returned;
		//echo "<br>";
		//echo "ok";


		//header('Content-Type: application/json; charset=utf-8');
		$json = json_decode($returned);
		echo $json->Provinces[0]->ProvinceNameTh;

		foreach ($json->Provinces as $key->$value) {
			echo $key.'-'.$value;
			echo '<br>';

			/*
			if(preg_match($prv, $key) === 1){
				
				break;
			}
			else{
				continue;
			}
			*/
		}


		/*
		$xml = new SimpleXMLElement($xmlString);
		echo $xml->bbb->cccc->dddd['Id'];
		echo $xml->bbb->cccc->eeee['name'];
		// or...........
		foreach ($xml->bbb->cccc as $element) {
		  foreach($element as $key => $val) {
		   echo "{$key}: {$val}";
		  }
		}
		*/

?>
