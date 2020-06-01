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

			/*
			echo $key->SevenDaysForecast[0]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[1]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[2]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[3]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[4]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[5]->WeatherDescription;
			echo '<br>';
			echo $key->SevenDaysForecast[6]->WeatherDescription;
			*/

			//if(preg_match('(กรุงเทพ|กรุงเทพมหานคร)', $key->ProvinceNameTh) === 1){
			if(preg_match("'".$prv."'", $key->ProvinceNameTh) === 1){

				echo '<br>';
				//default = ""
				echo $key->ProvinceNameTh;
				echo '<br>';
				echo $key->ProvinceNameEnglish;
				echo '<br>';
				echo $key->SevenDaysForecast[0]->Date; 
				echo '<br>';
				echo '<br>';
				echo $key->SevenDaysForecast[6]->Date; 
				echo '<br>';


				foreach ($key->SevenDaysForecast as $arr) {
					
					echo '-----------------------------------------------------';
					echo '<br>';

					echo $arr->Date;  // 0-6  sum 7 days
					echo '<br>';

					echo $arr->WeatherDescription;  // "ฝนฟ้าคะนอง",ท้องฟ้ามีเมฆบางส่วน ---ท้องฟ้าโปร่ง
					echo $arr->WeatherDescriptionEn;  // ""Heavy Rain",",
					echo '<br>';

					echo $arr->WaveHeight;  // "สงบ",คลื่นสูง 1-2 เมตร"
					echo $arr->WaveHeightEn;  // "Calm","Wave Height 1-2 m.",
					echo '<br>';


					echo $arr->TempartureLevel;  // "ปกติ",
					echo $arr->TempartureLevelEn;  // "Normal"
					echo '<br>';


					echo $arr->MaxTemperature->Value; 
					echo $arr->MaxTemperature->Unit; //"celcius"
					echo '<br>';

					echo $arr->MinTemperature->Value; 
					echo $arr->MinTemperature->Unit; //"celcius"
					echo '<br>';

					echo $arr->WindDirection->Value; 
					echo $arr->WindDirection->Unit;  //"degree"
					echo '<br>';

					echo $arr->WindSpeed->Value; 
					echo $arr->WindSpeed->Unit; //"km/h"
					echo '<br>';

					echo $arr->Rain->Value; 
					echo $arr->Rain->Unit; //"%"
					echo '<br>';
					echo '-----------------------------------------------------';
					echo '<br>';
				}

				//break;
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

$type_weather= array("Hot"=>"อากาศร้อน","Very Hot"=>"อากาศร้อนจัด","Cool"=>"อากาศเย็น","Cold"=>"อากาศหนาว","Very Cold"=>"อากาศหนาวจัด",
"Isolated"=>"ฝนบางพื้นที่","Widely Scattered"=>"ฝนกระจายเป็นแห่งๆ","Scattered"=>"ฝนกระจาย","Almost Widespread"=>"ฝนเกือบทั่วไป","Widespread"=>"ฝนทั่วไป",
"Light Rain"=>"ฝนเล็กน้อย","Moderate Rain"=>"ฝนปานกลาง","Heavy Rain"=>"ฝนหนัก","Very Heavy Rain"=>"ฝนหนักมาก","Fine"=>"ท้องฟ้าแจ่มใส","Fair="=>"ท้องฟ้าโปร่ง","Partly Cloudy Sky"=>"ท้องฟ้ามีเมฆบางส่วน","Cloudy Sky"=>"ท้องฟ้ามีเมฆเป็นส่วนมาก","Very Cloudy Sky"=>"ท้องฟ้ามีเมฆมาก","Overcast Sky"=>"ท้องฟ้ามีเมฆเต็มท้องฟ้า")

?>
