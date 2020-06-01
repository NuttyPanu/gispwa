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

		//echo $json->Provinces[0]->ProvinceNameTh;

		foreach ($json->Provinces as $key) {
			//echo $key->ProvinceNameTh;
			//echo '<br>';


			//echo $key->SevenDaysForecast[0]->WeatherDescription;
			//echo '<br>';

			if(preg_match($prv, $key->ProvinceNameTh) === 1){

				//default = ""
				echo $key->ProvinceNameTh;
				echo '<br>';
				echo $key->ProvinceNameEnglish;
				echo '<br>';

				echo $key->SevenDaysForecast[0]->Date;  // 0-6  sum 7 days

				echo $key->SevenDaysForecast[0]->WeatherDescription;  // "ฝนฟ้าคะนอง",ท้องฟ้ามีเมฆบางส่วน
				echo $key->SevenDaysForecast[0]->WeatherDescriptionEn;  // ""Heavy Rain",",


				echo $key->SevenDaysForecast[0]->WaveHeight;  // "สงบ",คลื่นสูง 1-2 เมตร"
				echo $key->SevenDaysForecast[0]->WaveHeightEn;  // "Calm","Wave Height 1-2 m.",
				echo $key->SevenDaysForecast[0]->TempartureLevel;  // "ปกติ",
				echo $key->SevenDaysForecast[0]->TempartureLevelEn;  // "Normal"


				echo $key->SevenDaysForecast[0]->MaxTemperature->Value; 
				echo $key->SevenDaysForecast[0]->MaxTemperature->Unit; //"celcius"

				echo $key->SevenDaysForecast[0]->MinTemperature->Value; 
				echo $key->SevenDaysForecast[0]->MinTemperature->Unit; //"celcius"


				echo $key->SevenDaysForecast[0]->WindDirection->Value; 
				echo $key->SevenDaysForecast[0]->WindDirection->Unit;  //"degree"


				echo $key->SevenDaysForecast[0]->WindSpeed->Value; 
				echo $key->SevenDaysForecast[0]->WindSpeed->Unit; //"km/h"

				echo $key->SevenDaysForecast[0]->Rain->Value; 
				echo $key->SevenDaysForecast[0]->Rain->Unit; //"%"



				echo '<br>';





				break;
			}
			else{
				echo $prv.'-'.$key->ProvinceNameTh;
				echo '<br>';
				continue;
			}

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
