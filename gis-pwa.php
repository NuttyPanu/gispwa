<?php
date_default_timezone_set('Asia/Bangkok');
header('Content-Type: text/html; charset=utf-8');

ini_set("log_errors", 1);
ini_set("error_log", "php-error.txt");

// for test debug file
require_once('LINEBotTiny.php');



$access_token = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

$channelAccessToken = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';
$channelSecret = 'b8c9ec55b321b2d04d2a6f131168ecd4';


$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$botName = "BOT";


$GISPWA= 'C6c9793d99e321e4659397c52365a68d3';
$METER= 'C6cf4977144b0d1c6aa8b5be22b04272c';
$NUT='U87b618904b23471df5c43312458c016b';
$GISDEV= 'C6d63e07eb0065b5019b861f11073fc41';


$key_notify=array("Nutty"=>"OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv","GIS_DEV"=>"gPidZUfXhBA0O2rUL1o0NBUL18EWrzIvZJJhDwOPopE","GIS_PWA"=>"6quJbwJSDQzowDEohK6XNvnrLgVKsVyDYr5x2VvCPns","METER_GIS"=>"MPUAjmRP1bHVZhWsvRsEctt59w2Gx9n0sBV51wfcnaW");

function notify($id,$msg){
	$key_noti='OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv';
	if($id == 'C6c9793d99e321e4659397c52365a68d3'){// gis_pwa
          $key_noti = "6quJbwJSDQzowDEohK6XNvnrLgVKsVyDYr5x2VvCPns";
	}
	else if($id == 'C6cf4977144b0d1c6aa8b5be22b04272c'){// METER
          $key_noti = "MPUAjmRP1bHVZhWsvRsEctt59w2Gx9n0sBV51wfcnaW";
	}
        else if($id == 'C6d63e07eb0065b5019b861f11073fc41'){// $GISDEV
          $key_noti = "gPidZUfXhBA0O2rUL1o0NBUL18EWrzIvZJJhDwOPopE";
	}
	else if($id == 'U87b618904b23471df5c43312458c016b'){// $NUT
          $key_noti = "OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv";
	}
	else{
	  $key_noti = "OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv";
	}
	
	//$message = $message.'&imageThumbnail=https://gispwaai.herokuapp.com/hbd.jpg'.'&imageFullsize=https://gispwaai.herokuapp.com/hbd.jpg';

	//$key_noti = 'OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv';//nutty
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	// SSL USE 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	//POST 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	// Message 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg"); 
	//ถ้าต้องการใส่รุป ให้ใส่ 2 parameter imageThumbnail และimageFullsize
	//curl_setopt( $chOne, CURLOPT_POSTFIELDS, //"message=$message&imageThumbnail=https://gispwaai.herokuapp.com/hbd.jpg&imageFullsize=https://gispwaai.herokuapp.com/hbd.jpg"); 
	//"message=$message");
	// follow redirects 
	curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
	//ADD header array 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', "Authorization: Bearer $key_noti", ); 
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	//RETURN 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
	//Check error 
	if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
	else { $result_ = json_decode($result, true); 
	echo "status : ".$result_['status']; 
	echo "message : ". $result_['message']; } 
	//Close connect 
	curl_close( $chOne ); 

}


//----------function--114------------//
function get_url($urllink) {
  $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $urllink);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
//---------------------------------//
function chk_friend($uid){

	$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
	$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

	//$lineid_encode = urlencode($uid);
	$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
	$q_msg = json_decode($json_cmsg); 
	if($q_msg){
		foreach($q_msg as $rec){
			if($rec->status == 'add_friend'){
				return true;
			}
			else{
				return false;
			}
		}
	}
	else{
		return false;
	}


}




function get_profile($fullurl) 
{
        $channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';
 
        $header = array(
            "Content-Type: application/json",
            'Authorization: Bearer '.$channelAccessToken2,
        );
 
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);      
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);
        return($returned);
}

//-----------auto send----push message------------------//
// Example : https://gispwaai.herokuapp.com/bot/bot.php?send=auto&text=test
// Example : https://gispwaai.herokuapp.com/bot/bot.php?send=auto&text=test&uid=R058c5b58c97773c8d032eef585b9dbd0

//https://gispwa.herokuapp.com/gis-pwa.php?send=text&text=ข้อความ&id=U87b618904b23471df5c43312458c016b // nut
//https://gispwa.herokuapp.com/gis-pwa.php?send=text&text=ข้อความ&id=C6cf4977144b0d1c6aa8b5be22b04272c // METER
//https://gispwa.herokuapp.com/gis-pwa.php?send=text&text=ข้อความ&id=C6c9793d99e321e4659397c52365a68d3 // กภส
//https://gispwa.herokuapp.com/gis-pwa.php?send=text&text=ข้อความ&id=C6d63e07eb0065b5019b861f11073fc41 // gis_dev


if ( $_GET['send'] == 'text' )
{
	$text = array(
			'type' => 'text',
			'text' => $_GET['text']
		);
	$uid = $_GET['id'];
	$client->pushMessage($uid, $text);
}
//---------------------------------------------------------//

if ( $_REQUEST['send'] == 'register' )
{

	$uid = $_REQUEST['id'];

	if(!$_REQUEST['nameid']){
		$nameid='nutty';
	}
	else{
		$nameid = $_REQUEST['nameid'];
	}

	if(!$_REQUEST['iconUrl']){
		$iconUrl='https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png';
	}
	else{
		$iconUrl = $_REQUEST['iconUrl'];
	}

 	$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;

	$text = array(
					/*
		            array(
			                'type' => 'text',
		                    'text' => 'ท่านสามารถลงทะเบียนได้โดยคลิกที่ปุ่มลงทะเบียนครับ'
		                ),
					*/
					array(
						'type' => 'flex',
						'altText' => 'ลงทะเบียน',
						'contents'=> array(

						/* เอามาจากflex*/

						  "type"=> "bubble",
						  "header"=> array(
							"type"=> "box",
							"layout"=> "horizontal",
							"contents"=> array(
							  array(
								"type"=> "text",
								"text"=> "ผูกบัญชีไลน์กับข้อมูลพนักงาน",
								"color"=> "#414141",
								"gravity"=> "center",
								"size"=> "lg",
								"wrap"=> true,
								"align"=> "center"
							  )
							)
						  ),
						  "body"=> array(
							"type"=> "box",
							"layout"=> "vertical",
							"contents"=> array(
							  array(
								"type"=> "box",
								"layout"=> "horizontal",
								"contents"=> array(
								  array(
									"type"=> "image",
									"url"=> $iconUrl,
									"size"=> "md",
									"align"=> "start",
								    "gravity"=> "center"
								  ),
								  array(
									"type"=> "text",
									"text"=> $nameid,
									"wrap"=> true,
									"size"=> "lg",
									"color"=> "#a57f23",
									"gravity"=> "center"
									//"flex" => 3 // for auto size image+name more(image<) less(image>)
								  )
								)
							  )

							)
						  ),
						  "footer"=> array(
							"type"=> "box",
							"layout"=> "vertical",
							"contents"=> array(

							  array(
								'type'=> "box",
								'layout'=> "vertical",
								'contents'=> array(
								   array(
									'type'=> "button",
									'style'=> "primary",
									"gravity"=> "center",
									"margin"=> "sm",
									'height'=> "sm",
									'action'=> array(
											'type'=> "uri",
											'label'=> "ลงทะเบียน",
											'uri'=> $str
											)
								   )
								  )
							  )


							)
						  ),

						  "styles"=> array(

								"header"=> array(
								  "backgroundColor"=> "#fdd74a"
								),
								"body"=> array(
								  "backgroundColor"=> "#fffcf2"
								),
								"footer"=> array(
								  "separator"=> true
								)

						  )

						/* เอามาจากflex*/

						)
					)
			);  	
	
	$client->pushMessage1($uid, $text);

}
//---------------------------------------------------------//









//ส่งแบบข้อความแบบ-multi----แบบ array มี sub array-------------//
if ( $_GET['send'] == 'location' )
{
	$text = array(
		            array(
			                'type' => 'image',
		                    'originalContentUrl' => $_GET['path_img'],
		                    'previewImageUrl' => $_GET['path_img']
		                ),
		            array(
							"type"=> "location",
							"title"=> "ตำแหน่งของภาพ(".urldecode($_GET['nameid']).")",
							"address"=> "Location",
							"latitude"=> $_GET['Latuse'],
							"longitude"=> $_GET['Lonuse']		
						)
			);  	
	$uid = $_GET['id'];
	$client->pushMessage1($uid, $text);
}

if ( $_GET['send'] == 'notify' )
{
	$key_noti='OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv';
	$msg=$_REQUEST['msg'];
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	// SSL USE 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	//POST 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	// Message 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=$msg"); 
	// follow redirects 
	curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1); 
	//ADD header array 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', "Authorization: Bearer $key_noti", ); 
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	//RETURN 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
	//Check error 
	if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); } 
	else { $result_ = json_decode($result, true); 
	echo "status : ".$result_['status']; 
	echo "message : ". $result_['message']; } 
	//Close connect 
	curl_close( $chOne ); 
}


// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		$uid = $event['source']['userId'];
		$gid = $event['source']['groupId'];


		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent

			$text = $event['message']['text'];
			$uid = $event['source']['userId'];
			$gid = $event['source']['groupId'];

			$timestamp = $event['timestamp'];
			/*
			if ($text == 'rich1') {

				$url = 'https://api.line.me/v2/bot/richmenu';
				$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

				$header = array(
					"Content-Type: application/json",
					'Authorization: Bearer '.$channelAccessToken2,
				);
				$ch = curl_init();
				//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
				//curl_setopt($ch, CURLOPT_VERBOSE, 1);
				//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_FAILONERROR, 0);		;
				//curl_setopt($ch, CURLOPT_HTTPGET, 1);
				//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_URL, $url);
				
				$profile =  curl_exec($ch);
				curl_close($ch);
				$obj = json_decode($profile);

				$pathpic = explode("cdn.net/", $obj->pictureUrl);

				$messages = [
						"type" => "text",
						//"text" =>  "สวัสดี คุณ ".$obj->displayName
						"text" =>  "สวัสดี คุณ ".$obj->displayName."(".$obj->statusMessage.")"
				];
			}
			else if ($text == 'rich2') {


			}
			*/

			if ($text == '#EGA' || $text == '#ega') {

				$key_noti= $gid;
				$message= 'EGA';
				notify($key_noti,$message);

				$messages = [
				'type' => 'text',
				'text' => 'สำนักงานรัฐบาลอิเล็กทรอนิกส์ (องค์การมหาชน) : EGA เปลี่ยนชื่อเป็น สำนักงานพัฒนารัฐบาลดิจิทัล (องค์การมหาชน) (ใช้ชื่อย่อ "สพร.") และเปลี่ยนชื่อภาษาอังกฤษเป็น "Digital Government Development Agency (Public Organization)" (ย่อว่า "DGA")'
				];

			}
			else if (preg_match('(ประกาศ|แจ้ง)', $text) === 1) {			

				$key_noti= $gid;
				$message= $text;
				notify($key_noti,$message);

				$messages = [
				'type' => 'text',
				'text' => 'รับทราบครับ'
				];

			}			
			

			else if ($text == 'กอล์ฟ' || $text == 'กอลฟ') {
				
				$messages = [
					'type' => 'image',
					'originalContentUrl' => "https://gispwa.herokuapp.com/image/7A669CAD-7C65-4C86-800A-F4E87ECB59BB.jpeg",
					'previewImageUrl' => "https://gispwa.herokuapp.com/image/7A669CAD-7C65-4C86-800A-F4E87ECB59BB.jpeg",
					
					'sender' => [
						'name' => "Golf",
						'iconUrl' => "https://gispwa.herokuapp.com/image/8A83B3B4-7C25-4A7E-896C-16658653C06B.jpeg",
					]
					];
				
			}


//			else if ($text == '#อากาศ' || $text == '#คุณภาพอากาศ') {
//
//				
//				$url = 'https://api.airvisual.com/v2/nearest_city?lat=13.829582090333&lon=100.69883982127&key=271d36a7-3efd-4a54-9864-554ea6203750';
//
//				//$url = 'https://api.airvisual.com/v2/nearest_city?key=271d36a7-3efd-4a54-9864-554ea6203750';
//				//$url = 'https://api.airvisual.com/v2/city?city=Mueang%20Nonthaburi&state=Nonthaburi&country=Thailand&key=271d36a7-3efd-4a54-9864-554ea6203750';
//
//				//$url = 'https://api.airvisual.com/v2/city?city=Mueang Nonthaburi&state=Nonthaburi&country=Thailand&key=271d36a7-3efd-4a54-9864-554ea6203750';
//
//				$ch = curl_init();
//				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//				curl_setopt($ch, CURLOPT_URL, $url);
//				$result = curl_exec($ch);
//				curl_close($ch);
//				$obj = json_decode($result);
//
//				//const city = $res.data.city;
//				//const temp = $res.data.current.weather.tp;
//				//const AQI = $res.data.current.pollution.aqius;
//				/*
//				var level = "";
//					if (AQI < 50) {
//					  level = "Good";  //https://www.iqair.com/assets/aqi/ic-face-green.svg 
//					} else if (AQI < 100) {
//					  level = "Moderate"; //https://www.iqair.com/assets/aqi/ic-face-yellow.svg
//					} else if (AQI < 150) {
//					  level = "Unhealthy for Sensitive Groups"; //https://www.iqair.com/assets/aqi/ic-face-orange.svg
//					} else if (AQI < 200) {
//					  level = "Unhealthy"; //https://www.iqair.com/assets/aqi/ic-face-red.svg
//					} else if (AQI < 300) {
//					  level = "Very Unhealthy"; //https://www.iqair.com/assets/aqi/ic-face-purple.svg
//					} else {
//					  level = "Hazardous"; //https://www.iqair.com/assets/aqi/ic-face-maroon.svg
//					}
//				*/
//
//				/*
//				.aqi-green{color:#718b3a;background:#a8e05f}
//				.aqi-yellow{color:#a57f23;background:#fdd74b}
//				.aqi-orange{color:#b25826;background:#fe9b57}
//				.aqi-red{color:#af2c3b;background:#fe6a69}
//				.aqi-opera-mauve{color:#634675;background:#a97abc}
//				.aqi-mauve-taupe{color:#683e51;background:#a87383}
//
//				.aqi-who-blue{color:#375c70;background:#60accb}
//				.aqi-bg-light-who-blue{background:#6cb4d2}
//				.aqi-bg-light-green{background:#b0e867}
//				.aqi-bg-light-orange{background:#ffa968}
//				.aqi-bg-light-yellow{background:#ffdf58}
//				.aqi-bg-light-red{background:#ff7978}
//				.aqi-bg-light-opera-mauve{background:#b283c5}
//				.aqi-bg-light-mauve-taupe{background:#b17c8c}
//				*/
//
//				//Description			Name		Icon
//				//clear sky (day)		01d.png		https://airvisual.com/images/01d.png
//				//clear sky (night)		01n.png		https://airvisual.com/images/01n.png
//				//few clouds (day)		02d.png		https://airvisual.com/images/02d.png
//				//few clouds (night)	02n.png		https://airvisual.com/images/02n.png
//				//scattered clouds		03d.png		https://airvisual.com/images/03d.png
//				//broken clouds			04d.png		https://airvisual.com/images/04d.png
//				//shower rain			09d.png		https://airvisual.com/images/09d.png
//				//rain (day time)		10d.png		https://airvisual.com/images/10d.png
//				//rain (night time)		10n.png		https://airvisual.com/images/10n.png
//				//thunderstorm			11d.png		https://airvisual.com/images/11d.png
//				//snow					13d.png		https://airvisual.com/images/13d.png
//				//mist					50d.png		https://airvisual.com/images/50d.png
//
//				//const message = `City: ${city}\nTemperature: ${temp}\nAQI: ${AQI}\nLevel: ${level}`;
//				/*
//				{"status":"success","data":{"city":"Bangkok","state":"Bangkok","country":"Thailand","location":{"type":"Point","coordinates":[100.4888394,13.7292915]},"current":{"weather":{"ts":"2020-03-29T08:00:00.000Z","tp":35,"pr":1007,"hu":50,"ws":5.1,"wd":200,"ic":"02d"},"pollution":{"ts":"2020-03-29T08:00:00.000Z","aqius":102,"mainus":"p2","aqicn":51,"maincn":"p2"}}}}
//
//				{"status":"success","data":{"city":"Mueang Nonthaburi","state":"Nonthaburi","country":"Thailand","location":{"type":"Point","coordinates":[100.51477,13.86075]},"current":{"weather":{"ts":"2020-03-29T08:00:00.000Z","tp":35,"pr":1007,"hu":50,"ws":5.1,"wd":200,"ic":"02d"},"pollution":{"ts":"2020-03-29T09:00:00.000Z","aqius":111,"mainus":"p2","aqicn":56,"maincn":"p2"}}}}
//				*/
//				/*
//				"ts": "2017-02-01T03:00:00.000Z",  //timestamp
//				"aqius": 21, //AQI value based on US EPA standard
//				"aqicn": 7, //AQI value based on China MEP standard
//				"tp": 8, //temperature in Celsius
//				"tp_min": 6, //minimum temperature in Celsius
//				"pr": 976,  //atmospheric pressure in hPa
//				"hu": 100, //humidity %
//				"ws": 3, //wind speed (m/s)
//				"wd": 313, //wind direction, as an angle of 360° (N=0, E=90, S=180, W=270)
//				"ic": "10n" //weather icon code, see below for icon index
//
//				"units": { //object containing units information
//				  "p2": "ugm3", //pm2.5
//				  "p1": "ugm3", //pm10
//				  "o3": "ppb", //Ozone O3
//				  "n2": "ppb", //Nitrogen dioxide NO2 
//				  "s2": "ppb", //Sulfur dioxide SO2 
//				  "co": "ppm" //Carbon monoxide CO 
//				}
//
//				*/
//
//				$messages = [
//					'type' => 'flex',
//					'altText' => 'Air Quality',
//					'contents'=> [
//					/* เอามาจากflex*/
//					  "type"=> "bubble",
//					  "header"=> [
//						"type"=> "box",
//						"layout"=> "horizontal",
//						"contents"=> [
//						  [
//							"type"=> "text",
//							"text"=> "Mung Nonthaburi",
//							"color"=> "#414141",
//							"gravity"=> "center",
//							"size"=> "xl",
//							"wrap"=> true,
//							"flex"=> 3
//						  ],
//						  [
//							"type"=> "image",
//							"url"=> "https://airvisual.com/images/01d.png",
//							"size"=> "xs",
//							"flex"=> 1
//						  ],
//						  [
//							"type"=> "text",
//							"text"=> "22 °C",
//							"color"=> "#414141",
//							"size"=> "lg",
//							"align"=> "end",
//							"gravity"=> "center",
//							"flex"=> 1
//						  ]
//						]
//					  ],
//					  "body"=> [
//						"type"=> "box",
//						"layout"=> "vertical",
//						"contents"=> [
//						  [
//							"type"=> "box",
//							"layout"=> "horizontal",
//							"contents"=> [
//							  [
//								"type"=> "image",
//								"url"=> "https://www.iqair.com/assets/aqi/ic-face-green.svg",
//								"size"=> "md",
//								"align"=> "start"
//							  ],
//							  [
//								"type"=> "text",
//								"text"=> "Moderate",
//								"wrap"=> true,
//								"size"=> "lg",
//								"color"=> "#a57f23",
//								"gravity"=> "center"
//							  ]
//							],
//							"margin"=> "xxl"
//						  ],
//						  [
//							"type"=> "box",
//							"layout"=> "baseline",
//							"contents"=> [
//							  [
//								"type"=> "text",
//								"text"=> "85",
//								"color"=> "#a57f23",
//								"size"=> "5xl",
//								"align"=> "center"
//							  ],
//							  [
//								"type"=> "text",
//								"text"=> "US AQI",
//								"color"=> "#a57f23",
//								"size"=> "xs",
//								"margin"=> "sm"
//							  ]
//							]
//						  ]
//						]
//					  ],
//					  "styles"=> [
//						"body"=> [
//						  "backgroundColor"=> "#fdd74b"
//						]
//					  ]
//					/* เอามาจากflex*/
//
//					]
//				];
//
//				/*
//				$text_reply = $obj->status.'\n'.$obj->data->city.'\n'.$obj->data->current->weather->tp.'\n'.$obj->data->current->pollution->aqius;
//
//				$messages = [
//				'type' => 'text',
//				'text' => $text_reply
//				];
//				*/
//			}

			else if (preg_match('(สถานการณ์โควิด|สรุปโควิด)', $text) === 1) {

				$handle1 = curl_init();
				 
				$url1 = "https://covid19.th-stat.com/api/open/today";
				 
				// Set the url
				curl_setopt($handle1, CURLOPT_URL, $url1);
				// Set the result output to be a string.
				curl_setopt($handle1, CURLOPT_RETURNTRANSFER, true);
				 
				$output1 = curl_exec($handle1);
				 
				curl_close($handle1);
				$obj = json_decode($output1); 

				$text_reply = "สถานการณ์โควิด-19
				\n $obj->UpdateDate 
				\n พบผู้ป่วยรายใหม่ จำนวน $obj->NewConfirmed ราย
				\n มีผู้ติดเชื้อสะสม $obj->Confirmed ราย
				\n เสียชีวิตเพิ่มขึ้น $obj->NewDeaths ราย (สะสม $obj->Deaths ราย)
				\n รักษาหาย $obj->NewRecovered ราย (รวม $obj->Recovered ราย)
				\n กำลังรักษาอยู่ใน รพ. $obj->Hospitalized ราย
				\n แหล่งที่มา: $obj->Source
				";



				$messages = [
				'type' => 'text',
				'text' => $text_reply 
				];
			
			}


			else if (preg_match('(#นัดหมาย|#เตือน)', $text) === 1) {
                                $ugid;
				if($event['source']['groupId']){
                                   $ugid = $event['source']['groupId'];
				}
				else{
                                   $ugid = $event['source']['userId'];
				}
				
				//$key_noti =$key_notify['Nutty'];
				//$key_noti = 'OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv';//nutty
				$message = '';
				$memo_=array(
					"29-05-2020"=>"เงินเดือนออกนะครับ (29 พ.ค. 63) ",
					"01-06-2020"=>"อย่าลืมมาทำงานกันนะครับ (1 มิ.ย. 63) ",
				);				

				$today_ = date("d-m-Y");

				$s7d = date("d-m-Y",strtotime("+7 days",strtotime($today_)));
				$s3d = date("d-m-Y",strtotime("+3 days",strtotime($today_)));
				$s2d = date("d-m-Y",strtotime("+2 days",strtotime($today_)));
				$s1d = date("d-m-Y",strtotime("+1 days",strtotime($today_)));


				if(array_key_exists($s7d, $memo_))  // holiday;
				//else if(in_array($today, $holiday))  // holiday;
				{
					$message .= "เหลือเวลาอีก 7 วัน: ".$memo_[$s7d]." ";
				}
				if(array_key_exists($s3d, $memo_))  // holiday;
				//else if(in_array($today, $holiday))  // holiday;
				{
					$message .= "เหลือเวลาอีก 3 วัน: ".$memo_[$s3d]." ";
				}
				if(array_key_exists($s2d, $memo_))  // holiday;
				//else if(in_array($today, $holiday))  // holiday;
				{
					$message .= "เหลือเวลาอีก 2 วัน: ".$memo_[$s2d]." ";
				}
				if(array_key_exists($s1d, $memo_))  // holiday;
				//else if(in_array($today, $holiday))  // holiday;
				{
					$message .= "เหลือเวลาอีก 1 วัน: ".$memo_[$s1d]." ";
				}

				if(array_key_exists($today_, $memo_))
				{
					$message .= "อย่าลืมวันนี้นะ : ".$memo_[$today_]." ";
				}				

				notify($ugid,$message);

			}


			else if (preg_match('(#ทดสอบ|#ทดสอบ)', $text) === 1) {

				if (chk_friend($uid) == true){
					//$gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

					$url = 'https://api.line.me/v2/bot/profile/'.$uid;
					//$url ='https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
					$profile = get_profile($url);
					$obj = json_decode($profile);

					$nameid = $obj->displayName;
					$status = $obj->statusMessage;
					$pathpic = explode("cdn.net/", $obj->pictureUrl);

					$messages = [
					'type' => 'text',
					'text' => 'แน่นอน เราเพื่อนกัน',
					'sender' => [
						'name' => $nameid,
						'iconUrl' => 'https://obs.line-apps.com/'.$pathpic[1]
					]
					];

				}
				else{
					$messages = [
					'type' => 'text',
					'text' => 'ผมไม่รู้จักคุณนะ เพิ่มผมเป็นเพื่อนก่อนสิ'
					];

				}



			}
			else if ($text == '#วัน') {
				$messages = [
				   "type"=> "text",
				   "text"=> "Hello Quick Reply!",
				   "quickReply"=> [
					"items"=> [
					 [
					  "type"=> "action",
					  "action"=> [
					   "type"=> "datetimepicker",
					   "label"=> "Datetime Picker",
					   "data"=> "storeId=12345",
					   "mode"=> "datetime",
					   "initial"=> "2018-09-11T00:00",
					   "max"=> "2018-12-31T23:59",
					   "min"=> "2018-01-01T00:00"
					  ]
					 ]
					]
				   ]
				];

			}

			else if ($text == '#ลงทะเบียนliff') {
				/*
				$str;
				//-- Very simple way
				$useragent = $_SERVER['HTTP_USER_AGENT']; 
				$iPod = stripos($useragent, "iPod"); 
				$iPad = stripos($useragent, "iPad"); 
				$iPhone = stripos($useragent, "iPhone");
				$Android = stripos($useragent, "Android"); 
				$iOS = stripos($useragent, "iOS");
				//-- You can add billion devices 

				$DEVICE = ($iPod||$iPad||$iPhone||$Android||$iOS);

				if (!$DEVICE) {
					$str ='https://nuttypanu.github.io/line-liff-v2-starter/public/';	
				}
				else{
					$str ='line://app/1653970390-EDvl28PQ';
				}
				*/
				$uid = $event['source']['userId'];
				//$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
				$str ='https://nuttypanu.github.io/line-liff-v2-starter/public/';//for linepc &movile
				//$str ='line://app/1653970390-EDvl28PQ'; // for mobile only

				
				$messages = [
					'type' => 'flex',
					'altText' => 'This is a Flex Message',
					'contents'=> [
					'type'=> 'bubble',
					'body'=> [
					 'type'=> "box",
					 'layout'=> "vertical",
					 'contents'=> [
					  [
					   'type'=> "button",
					   'style'=> "primary",
					   'height'=> "sm",
					   'action'=> [
						'type'=> "uri",
						'label'=> "Register",
						'uri'=> $str
					   ]
					  ]
					 ]
					]
					]
				];
				
			}



			else if (preg_match('(#เช็ค|#check)', $text) === 1) {

				$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
				$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

				//$lineid_encode = urlencode($uid);
				$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
				$q_msg = json_decode($json_cmsg); 
				if($q_msg){
					foreach($q_msg as $rec){
						$messages = [
						'type' => 'text',
						'text' => $rec->status
						];
					}
				}
				else{
					$messages = [
					'type' => 'text',
					'text' => 'ผมไม่ฟังคำสั่งของคนแปลกหน้าหรอกครับ'
					];
				}
            }
            else if(preg_match('(covid|Covid|โควิด|โควิท|โคโรนา|โคโรน่า)', $text) === 1 && preg_match('(รัฐ)', $text) === 1) {	

				$t=array("https://gispwa.herokuapp.com/image/st.jpg,https://gispwa.herokuapp.com/image/covid4.jpeg");

				$random_keys=array_rand($t,1);
				$pic = $t[$random_keys];

				$split = explode(",", $pic);
				$p = $split[0];
				$s = $split[1];

				$messages = [
					'type' => 'image',
					'originalContentUrl' => $s,
					'previewImageUrl' => $s,
					'sender' => [
						'name' => 'Covid-19',
						'iconUrl' => $p
					]
				];

			}			
			
            else if(preg_match('(covid|Covid|โควิด|โควิท|โคโรนา|โคโรน่า)', $text) === 1 && preg_match('(#|#)', $text) === 0) {	

				$t=array("https://gispwa.herokuapp.com/image/st4.jpg,https://gispwa.herokuapp.com/image/covid4.jpeg", "https://gispwa.herokuapp.com/image/st3.jpg,https://gispwa.herokuapp.com/image/covid3.jpg", "https://gispwa.herokuapp.com/image/st2.jpg,https://gispwa.herokuapp.com/image/covid1.jpg", "https://gispwa.herokuapp.com/image/st.jpg,https://gispwa.herokuapp.com/image/covid2.jpg",
				"https://gispwa.herokuapp.com/image/st.jpg,https://gispwa.herokuapp.com/image/covid7.jpg");

				$random_keys=array_rand($t,1);
				$pic = $t[$random_keys];

				$split = explode(",", $pic);
				$p = $split[0];
				$s = $split[1];

				$messages = [
					'type' => 'image',
					'originalContentUrl' => $s,
					'previewImageUrl' => $s,
					'sender' => [
						'name' => 'Covid-19',
						'iconUrl' => $p
					]
				];

			}
            else if(preg_match('(ล้างมือ|ป้องกันโควิด)', $text) === 1) {	
				$messages = [
					"type"=> "video",
					"originalContentUrl"=> "https://gispwa.herokuapp.com/video/covid.mp4",
					"previewImageUrl"=> "https://gispwa.herokuapp.com/video/covid.jpg",
					'sender' => [
						'name' => 'Covid-19',
						'iconUrl' => 'https://gispwa.herokuapp.com/video/profile_covid.jpg'
					]					
				];

			}
			else if (preg_match('(หิวจัง|หิวแล้ว|หิวมาก|หิวจุง|หิว)', $text) === 1) {

				//$gid = $event['source']['groupId'];
				$uid = $event['source']['userId'];

				if($event['source']['groupId'] == $GISPWA || $event['source']['groupId'] == $GISDEV || $event['source']['userId'] == $NUT){

					if (chk_friend($uid) == true){

						$url = 'https://api.line.me/v2/bot/profile/'.$uid;
						//$url ='https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
						$profile = get_profile($url);
						$obj = json_decode($profile);

						$nameid = $obj->displayName;
						$status = $obj->statusMessage;
						$pathpic = explode("cdn.net/", $obj->pictureUrl);

						$messages = [
							'type' => 'text',
							'text' => 'อยากกินลูกชิ้น เปิดเตาหน่อย',
							'sender' => [
								'name' => $nameid,
								'iconUrl' => 'https://obs.line-apps.com/'.$pathpic[1]
							]
						];

					}
					else{
						$t=array("วันนี้เหลือ ลูกชิ้นหมู 10 ไม้, ไส้กรอกชีส(เยิ้มๆ) 10 ไม้ รับทั้งหมดนี้เลยมั้ยคะ","วัตถุดิบอยู่ในตู้ เชิญหยิบกันตามสบายเลยค่ะ","รับอะไรดีคะ","ไส้กรอกมั้ยคะ");
						$random_keys=array_rand($t,1);
						$txt = $t[$random_keys];

						$messages = [
						'type' => 'text',
						'text' => $txt,
						'sender' => [
							'name' => 'Piman Charaman',
							'iconUrl' => 'https://gispwa.herokuapp.com/image/piman.jpg'
						]
						];
					}

				}

			}


			/*
			else if ($text == '#ตรวจสอบพื้นที่ให้บริการ') {

				$urllink = 'https://gisweb1.pwa.co.th/lineservice/line_register/check.php?id='.$uid; 
				$res = get_url($urllink); 
				$str = trim($res); 

				if ($str == 'found'){
					$messages = [
					'type' => 'text',
					'text' => 'โปรดแชร์ Location เพื่อตรวจสอบพื้นที่ให้บริการ'
					];
				}
				else if ($str == 'notfound'){
					$messages = [
					'type' => 'text',
					'text' => 'กรุณาลงทะเบียนก่อนใช้บริการนี้'
					];
				}
				else{
					$messages = [
					'type' => 'text',
					'text' => $str
					];
				}


			}
			*/
			


			//ทดสอบฟังก์ชั่น getprofile --user ต้องอัพเดทlineเป็นversionใหม่
			else if(preg_match('(สวัสดี|สวัสดีครับ|สวัสดีค่ะ)', $text) === 1) {	

					$gid = $event['source']['groupId'];
					$uid = $event['source']['userId'];

					//$uid =  'Uebffb1bffc4ccb8f823238e2c22f11ed';
					//$gid =  'Cd495e0ee56720de9b2b914dff0eabc16';

					//$url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid; //กลุ่ม
					$url = 'https://api.line.me/v2/bot/profile/'.$uid;			//user
					$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

					$header = array(
						"Content-Type: application/json",
						'Authorization: Bearer '.$channelAccessToken2,
					);
					$ch = curl_init();
					//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
					//curl_setopt($ch, CURLOPT_VERBOSE, 1);
					//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_FAILONERROR, 0);		;
					//curl_setopt($ch, CURLOPT_HTTPGET, 1);
					//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
					//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_URL, $url);
					
					$profile =  curl_exec($ch);
					curl_close($ch);
					$obj = json_decode($profile);

					$pathpic = explode("cdn.net/", $obj->pictureUrl);

					/*
					$a = array(

							array(
								'type' => 'text',
								'text' => 'สวัสดี @'.$obj->displayName."(".$obj->statusMessage.")"
							),
							array(
								'type' => 'image',
								'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1],
								'previewImageUrl' => 'https://obs.line-apps.com/'.$pathpic[1].'/large'
							)
//							,
//								array(
//									'type' => 'text',
//									'text' => $ty. ' '.$uid. ' '. $gid. ' '.$profile
//								)
//							,
//								array(
//									'type' => 'text',
//									'text' => 'สวัสดีคุณ '.$obj->displayName.' type='.$ty.' uid='.$uid.' gid='.$gid
//								)
//						,
//							array(
//								'type' => 'text',
//								'text' => $obj->statusMessage
//							),
//							array(
//								'type' => 'text',
//								'text' => $obj->pictureUrl
//							)
						);
					$client->replyMessage1($event['replyToken'],$a);
				*/
					$messages = [
							"type" => "text",
							//"text" =>  "สวัสดี คุณ ".$obj->displayName
							"text" =>  "สวัสดี คุณ ".$obj->displayName."(".$obj->statusMessage.")"
					];

			}
	


			else if (preg_match('(#วิธีการเพิ่มสิทธิ์|#วิธีเพิ่มสิทธิ์)', $text) === 1) {
				$text_reply = "
				
				วิธีการเพิ่มสิทธิ์ระบบติดตามมาตรวัดน้ำ 
				\n ใช้คีย์เวิร์ดในการเพิ่ม ดังนี้ #เพิ่มสิทธิ์ หรือ #เพิ่มสิทธิ์มาตร หรือ #เพิ่มสิทธิ์ระบบมาตร หรือ #เพิ่มสิทธิ์ระบบมาตรฯ 
				\n ***(เพิ่มสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
				\n ตัวอย่างการเพิ่มสิทธิ์
				\n  1.กรณีเพิ่มสิทธิ์ 1 คน => #เพิ่มสิทธิ์ 12974
				\n  2.กรณีเพิ่มสิทธิ์ มากกว่า 1 คน => #เพิ่มสิทธิ์ 12974 12975 12976

				\n ใช้คีย์เวิร์ดในการลบ ดังนี้ #ลบสิทธิ์ หรือ #ลบสิทธิ์มาตร หรือ #ลบสิทธิ์ระบบมาตร หรือ #ลบสิทธิ์ระบบมาตรฯ 
				\n ***(ลบสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
				\n  ตัวอย่างการลบสิทธิ์
				\n  1.กรณีลบสิทธิ์ 1 คน => #ลบสิทธิ์ 12974
				\n  2.กรณีลบสิทธิ์ มากกว่า 1 คน => #ลบสิทธิ์ 12974 12975 12976
				";

				// Build message to reply back
				$messages = [
				'type' => 'text',
				//'text' => $text
				'text' => $text_reply
				];

			}


/*
			if ($text == '#วิธีการสอบถามข้อมูล') {
				$text_reply = "คำสั่งของไลน์บอทต่างๆ 
				\n 1.ค้นหาข้อมูลความยาวท่อ => ท่อ [ชนิด] [ขนาด] [อายุ]
				\n  2.ค้นหาข้อมูลมาตรฯ => มาตรฯ [    ]
				\n  3.ค้นหาตำแหน่ง => location
				\n  4.เช็คสถานะDBระบบติดตามมาตร => meterstat 
				\n  5.ค้นหาตำแหน่งกปภ.สาขา => #ไป [กปภ.สาขา] 
				\n  6.555, sticker, รูป, พื้นที่ให้บริการ 
				";

				// Build message to reply back
				$messages = [
				'type' => 'text',
				//'text' => $text
				'text' => $text_reply
				];

			}



			else if ($text == 'meterstat') {
				if ($uid == U08f8f734c798d00fb72aaaa02dd15da7){
					//---------------------------------//
					$urllink = 'https://gisweb1.pwa.co.th/meterstat/log/chkfield.php'; 
					$str = get_url($urllink); //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

					$messages = [
						"type"=> "text",
						"text"=> $str
					];
				}
				else{
					$messages = [
						"type"=> "text",
						"text"=> 'โปรดลงทะเบียนก่อน'
					];
				}
			}



			else if ($text == '5552015') {

				$pwacode = $text;
				//---------------------------------//
				$urllink = 'https://gisweb1.pwa.co.th/bot_line/service/get_office_bot.php?pwa_code='.$pwacode; 
				$str = get_url($urllink); //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

				$messages = [
					"type"=> "text",
					"text"=> $str
				];
			}



			else if ($text == 'kpi' || $text == 'Kpi' || $text == 'KPI' ) {
				$pic = "https://gis4manager.herokuapp.com/image/kpi.jpg";
				// Build message to reply back
				$messages = [
					'type' => 'image',
					'originalContentUrl' => $pic,
					'previewImageUrl' => $pic
				];

			}


			else if ($text == 'ด่า') {
				$pic = "https://gis4manager.herokuapp.com/image/02.jpg";
				// Build message to reply back
				$messages = [
					'type' => 'image',
					'originalContentUrl' => $pic,
					'previewImageUrl' => $pic
				];

			}



			else if ($text == 'พื้นที่ให้บริการ') {
				$pic = "https://gisweb1.pwa.co.th/area/area/all.jpg";
				// Build message to reply back
				$messages = [
					'type' => 'image',
					'originalContentUrl' => $pic,
					'previewImageUrl' => $pic
				];

			}

			else if ($text == 'sticker') {

				// Build message to reply back
				$messages = [
					"type" => "sticker",
					"packageId" => "1",
					"stickerId" => "1"
				];

			}


//			else if ($text == 'many') {
//
//				// Build message to reply back
//				$messages = [
//
//					{
//						"type" => "sticker",
//						"packageId" => "1",
//						"stickerId" => "1"
//					},
//
//					{
//						"type" => "text",
//						"text" => "m"
//					}
//
//				];
//
//			}


			else if ($text == 'location') {
				$messages = [
					"type"=> "location",
					"title"=> "ตำแหน่ง กปภ.",
					"address"=> "กปภ. สำนักงานใหญ่",
					"latitude"=> 13.875844,
					"longitude"=> 100.585318
				];
			}



			else if ($text == 'งานเกษียณ') {
				$messages = [
					"type"=> "video",
					"originalContentUrl"=> "https://gis4manager.herokuapp.com/video/video.mp4",
					"previewImageUrl"=> "https://gis4manager.herokuapp.com/image/preview.jpg"
				];
			}
*/




			else if ($text == '#id') {
				$gid = $event['source']['groupId'];
				$uid = $event['source']['userId'];
				// Build message to reply back
				$messages = [
				'type' => 'text',
				"text" => 'uid:'.$uid.'\n'.'gid'.$gid
				];
			}


			else {
				
				/*
				$text_reply = "ยังไม่มีคำตอบ";

				// Build message to reply back
				$messages = [
				'type' => 'text',
				//'text' => $text
				"text" => $text_reply." ".$uid
				//"text" => $text_reply

				];

				*/

			}



			// Get replyToken
			$replyToken = $event['replyToken'];


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
				//'messages' => ["https://gispwaai.herokuapp.com/golf.jpg"],

			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}




	}
}





echo "OK";



////ชุดตัวอย่างการเขียนแบบของเตย-------------------//
//
////// Log to file
//$t = var_export( $client->parseEvents() , true);
//file_put_contents("test.txt", $t );
// 
// 
// 
//function replyMsg($event, $client)
//{

//            $gid = $event['source']['groupId']; ต้องเป็นกลุ่มเฉพาะ ถึงจะทำงาน

//    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
//        //มีด้วยกัน 2 field คือ type = “text” และ text ส่งได้สูงสุด 2000 ตัวอักษร สามารถใช้ emoticons ได้ตามมาตรฐาน unicode
//        $msg = $event['message']['text'];
//        if( $msg == 'ทดสอบ'){ $t = 'Test ละสิ';     
//            $a = array(
//                        array(
//                            'type' => 'sticker',
//                            'packageId' => 2,
//                            'stickerId' => 149
//                        ),
//                        array(
//                            'type' => 'text',
//                            'text' => $t . ''               
//                        )
//                    );
//            $client->replyMessage1($event['replyToken'],$a);
//        }
// 
// 
//        else if (preg_match('(สอบถาม|#สอบถาม|#ถาม)', $msg) === 1) {
// 
// 
//            //str_replace ( ' ', '%20', 'http://images.fastcompany.com/upload/Screen shot 2011-04-28 at 8.13.21 PM.png' );
//            //$question = trim($msg);
//            //$question = $msg;
// 
//            $question_txt = $msg;
//            //$question_utfde = utf8_decode($question_utfen);
//            //$question = 'eng';
// 
//            $question_urlen = urlencode ($msg);
// 
//            $uid = $event['source']['userId'];
//            $gid = $event['source']['groupId'];
// 
// 
//            //แจ้งกลับคนถาม---------------------------------------//
//            $t = 'เราได้รับคำถามของท่านแล้ว ขอบคุณสำหรับคำถามและเราจะรีบดำเนินการตอบกลับ';  
//            $a = array(
//                        array(
//                            'type' => 'text',
//                            'text' => $t . ''               
//                        )
//                    );
//            $client->replyMessage1($event['replyToken'],$a);
// 
// 
// 
//            if ($gid){
//                $id = $gid;
//            }
//            else{
//                $id = $uid;
//            }
//             
// 
//            $urllink = 'https://gisweb1.pwa.co.th/lineservice/line_admin/service/de_q.php?act=A&question='.$question_urlen.'&line_id='.$id.'&botname=gispwasys';
//            //$urllink = 'https://gisweb1.pwa.co.th/lineservice/line_register/check.php?id='.$uid; 
//            $res = get_url($urllink); 
//            $str = trim($res); 
//             
// 
//            //แจ้งแอดมินว่ามีคำถามเข้ามาใหม่---------------------------------------//
//            $uidnut = "U08f8f734c798d00fb72aaaa02dd15da7"; // id nut
//            //$uidnut = "C3959e1e52fb0b16f3f9d08c4ad2b0a97";      // id group dev
//            //$uidnut = "C67c2d145ca7be1b591c50c3b3831ada1";      // id group GIS
//            $client->pushMessage1($uidnut,array(
//                    array(
//                        'type' => 'text',
//                        'text' => 'มีคำถามเข้ามาใหม่ผ่าน gispwa(uid='.$uid.'gid='.$gid.'): '.$question_txt.' Link: '.'https://gisweb1.pwa.co.th/lineservice/line_admin/admin.html'
//                    ) )
//                );
// 
//            /*
//            //ทดสอบผลลัพธ์db
//            $uidnut = "U08f8f734c798d00fb72aaaa02dd15da7"; // id nut
//            $client->pushMessage1($uidnut,array(
//                    array(
//                        'type' => 'text',
//                        'text' => $str
//                    ) )
//                );
//            */
// 
// 
//        }
// 
//        else if (preg_match('(ด่า|เลว|ไม่ดี|โดนว่า|น่าเบื่อ|รำคาญ|ชั่ว|สันดาน|บ่น|ถูกว่า)', $msg) === 1) {
// 
// 
//            $t = 'การบ่นไม่ใช่การแก้ปัญหา และ การด่าก็ไม่ใช่วิธีการแก้ไข';  
//            $a = array(
//                        array(
//                            'type' => 'text',
//                            'text' => $t . ''               
//                        )
//                    );
//            $client->replyMessage1($event['replyToken'],$a);
// 
// 
//        }
// 
//        else if (preg_match('(กู|มึง|ควย|หัวขวด|หำ|หี|เหี้ย|กุ|มรึง|เมิง|เมริง)', $msg) === 1) {
// 
// 
// 
//            $t = 'พูดจาไม่เพราะเลยนะ ขอบอกเลยว่า "ไม่ชอบ"';     
//            $a = array(
//                        array(
//                            'type' => 'text',
//                            'text' => $t . ''               
//                        )
//                    );
//            $client->replyMessage1($event['replyToken'],$a);
// 
// 
//        }
// 
// 
// 
//        elseif( $msg == 'ลงทะเบียน'){ 
//         
//            $uid = $event['source']['userId'];
//            $str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
// 
//            $a = array(
//                     array(
// 
//                       "type"=> "imagemap",
//                       "baseUrl"=> "https://gispwasys.herokuapp.com/image/register/rich",
//                       "altText"=> "this is an imagemap",
//                       "baseSize"=> array(
//                         "height"=> 1040,
//                         "width"=> 1040
//                        ),
//                       "actions"=> array ( 
//                           array(
//                            "type"=> "uri",
//                            "linkUri"=> $str,
//                            "area"=> 
//                            array(
//                             "x"=> 0,
//                             "y"=> 520,
//                             "width"=> 1040,
//                             "height"=> 520
//                            )
//                           ),
//                           array(
//                            "type"=> "message",
//                            "text"=> "hello",
//                            "area"=> 
//                                array(
//                             "x"=> 0,
//                             "y"=> 0,
//                             "width"=> 1040,
//                             "height"=> 520
//                            )
//                           )
//                        )     
//                    )
//                     
//            );
//            $client->replyMessage1($event['replyToken'],$a);
//                 
//        }
// 
// 
//        elseif( $msg == 'ทดสอบbutton'){ 
// 
//            $client->replyMessage1($event['replyToken'],array(
//                   array(
//                  "type"=> "template",
//                   "altText"=> "this is a buttons template",
//                   "template"=> 
//                    array(
//                    "type"=> "buttons",
//                    "thumbnailImageUrl"=> "https://swls.pwa.co.th/dmaline/imgToei/logo-PWA.jpg",
//                    "title"=> "Menu",
//                    "text"=> "Web Site",
//                    "actions"=>          
//                   array ( 
//                     array(
//                    "type"=> "uri",
//                    "label"=> "DMAMA",
//                    "uri"=> "http://dmama.pwa.co.th"
//                     ),
//                     array(
//                    "type"=> "uri",
//                    "label"=> "DMA Monitor",
//                    "uri"=> "http://dmamonitor.pwa.co.th"
//                     )
//                    )
//                    )
//                ))
//               );
//     
//        }
// 
// 
// 
// 
////      $client->replyMessage($event['replyToken'],array(
////             array(
////            "type"=> "template",
////             "altText"=> "this is a buttons template",
////             "template"=> 
////              array(
////              "type"=> "buttons",
////              "thumbnailImageUrl"=> "https://swls.pwa.co.th/dmaline/imgToei/logo-PWA.jpg",
////              "title"=> "Menu",
////              "text"=> "Web Site",
////              "actions"=>          
////             array ( 
////             /*  array(
////              "type"=> "postback",
////              "label"=> "PWA",
////              "data"=> "https://swls.pwa.co.th/SmartWaterLevelDetail.aspx?device_name=5541019-SL-WL-01",
////              "text"=> "Sent value"
////               ),*/
////               array(
////              "type"=> "uri",
////              "label"=> "DMAMA",
////              "uri"=> "http://dmama.pwa.co.th"
////               ),
////               array(
////              "type"=> "uri",
////              "label"=> "DMA Monitor",
////              "uri"=> "http://dmamonitor.pwa.co.th"
////               )
////              )
////              )
////          ))
////         );
// 
// 
// 
// 
//        /*
//        else {$t = 'ถามไรเนี่ย งง ถามใหม่ๆ'; 
//            $a = array(
//                        array(
//                                'type' => 'sticker',
//                                'packageId' => 2,
//                                'stickerId' => 149
//                            ),
//                        array(
//                                'type' => 'text',
//                                'text' => $t . ''                
//                            )
//                );  
//            $client->replyMessage1($event['replyToken'],$a);         
//        }
//        */
// 
//    }
//     
//    elseif ($event['type'] == 'message' && $event['message']['type'] == 'image') {
//    //การส่งรูปภาพ อาจจะลำบากหน่อย เพราะทาง LINE จะให้เราส่งเป็น URL ของ รูปให้กับ LINE Server แทน เพราะฉะนั้นเราต้องหา Server ที่สำหรับ upload รูปภาพเอง และสร้าง link ขึ้นมาเพื่อเอาไปส่งให้ LINE โดยจำกัดขนาด    
// 
// 
//        //แจ้งว่ามีคนส่งรูปในกลุ่มDEV
//        $text = array(
//                    array(
//                        'type' => 'text',
//                        'text' => "มีคนส่งรูปในกลุ่ม GIS Smart Farm Sys"
//                    )
//                );
//        $id = "U08f8f734c798d00fb72aaaa02dd15da7";    // id nut
//        $client->pushMessage1($id, $text);
// 
// 
//        /*
//        //แจ้งโดยการส่งรูป
//        $client->pushMessage2(array( 
//                    'to' => 'U08f8f734c798d00fb72aaaa02dd15da7', 
//                    'messages' => array(
//                        array(
//                            'type' => 'image',
//                            'originalContentUrl' => "https://gispwasys.herokuapp.com/image/send.jpg",
//                            'previewImageUrl' => "https://gispwasys.herokuapp.com/image/send.jpg"
//                        )
//                    )
//                ));
//        */
// 
// 
//    }           
//    elseif ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {
//        $client->replyMessage1($event['replyToken'],array(
//                array(
//                    'type' => 'sticker',
//                    'packageId' => 3,
//                    'stickerId' => 232
//                ) )
//            );
//    }
// 
//   elseif ($event['type'] == 'message' && $event['message']['type'] == 'location') {
// 
// 
//        $latitude = $event['message']['latitude'];
//        $longitude = $event['message']['longitude'];
//        $title = $event['message']['title'];
//        $address = $event['message']['address'];
//        $uid = $event['source']['userId'];
//        $gid = $event['source']['groupId'];
// 
// 
//            $urllink = 'https://gisweb1.pwa.co.th/lineservice/line_register/check.php?id='.$uid; 
//                $res = get_url($urllink); 
//                $str = trim($res); 
// 
//            if ($str == 'found'){
//                /*
//                $text = [
//                        "type"=> "location",
//                        "title"=> 'ตำแหน่งของท่าน',
//                        "address"=> $address,
//                        "latitude"=> $latitude,
//                        "longitude"=> $longitude
//                        ];       
//                $uid = $event['replyToken']; // id reply
//                $client->replyMessage($uid, $text);
//                */
// 
// 
//               /*
//                $client->replyMessage1($event['replyToken'],array(
//                                array(
//                                    'type' => 'text',
//                                    'text' => 'GPS'              
//                                )
//                            )
//                );
//                */
// 
// 
//                if ($gid){
//                    $t = 'กำลังตรวจสอบตำแหน่งของท่าน โปรดรอสักครู่ ...';    
//                    $client->pushMessage1($gid,array(
//                                array(
//                                    'type' => 'text',
//                                    'text' => $t
//                                ) 
//                            )
//                    );
//                }
// 
//                else if ($uid){
//                    $t = 'กำลังตรวจสอบตำแหน่งของท่าน โปรดรอสักครู่ ...';    
//                    $client->pushMessage1($uid,array(
//                                array(
//                                    'type' => 'text',
//                                    'text' => $t
//                                ) 
//                            )
//                    );
//                }
// 
// 
// 
// 
//                $urllink = 'https://gisweb1.pwa.co.th/lineservice/servicearea/check_area.php?latitude='.$latitude.'&longitude='.$longitude; 
//                $str = get_url($urllink); 
//                //$str = iconv("win-874","utf-8",$convert);
//                //$json = json_decode($str);
//                $split = explode(",", $str);
//                //echo $split[0];
//                //echo $split[1];
//                //echo $split[2];
// 
//                if ($split[0] == 'in'){
// 
//                   $client->replyMessage1($event['replyToken'],array(
//                            array(
//                                    "type"=> "location",
//                                    "title"=> "ตำแหน่งของท่าน",
//                                    "address"=> $address,
//                                    "latitude"=> $latitude,
//                                    "longitude"=> $longitude
//                            ),
//                            array(
//                                    'type' => 'text',
//                                    'text' => 'ตำแหน่งของท่านอยู่ในพื้นที่ให้บริการของกปภ.สาขา'. $split[2].' ('.$split[1].')'
//                            ),
// 
//                            array(
//                              "type"=> "template",
//                              "altText"=> "this is a confirm template",
//                              "template"=> array(
//                                  "type"=> "confirm",
//                                  "text"=> "ท่านต้องการขอใช้น้ำประปา(รายใหม่)?",
//                                  "actions"=> 
// 
//                                      array (
//                                          array(
//                                            "type"=> "message",
//                                            "label"=> "ใช่",
//                                            "text"=> "ใช่"
//                                          ),
//                                          array(
//                                            "type"=> "message",
//                                            "label"=> "ไม่",
//                                            "text"=> "ไม่"
//                                          )
//                                      )
//                              )
//                            )
// 
// 
//                       )
//                    );
//                }
// 
//                else if ($split[0] == 'out'){
// 
//                   $client->replyMessage1($event['replyToken'],array(
//                            array(
//                                    "type"=> "location",
//                                    "title"=> "ตำแหน่งของท่าน",
//                                    "address"=> $address,
//                                    "latitude"=> $latitude,
//                                    "longitude"=> $longitude
//                            ),
//                            array(
//                                    'type' => 'text',
//                                    'text' => 'ไม่อยู่ในพื้นที่ให้บริการของกปภ.'    
//                            )
// 
//                       )
//                    );
//                }
// 
//            }
// 
//            else if ($str == 'notfound'){
// 
//            }
// 
// 
//    }
//}
// 
// 
// 
//// listen  $client->parseEvents()  ควรเอาไว้ล่างสุด ถ้าเอาไว้ด้านบนจะทำให้ pushMsg ไม่ได้
//foreach ($client->parseEvents() as $event) {
//    switch ($event['type']) {
//        case 'message':
//            $message = $event['message'];
//            switch ($message['type']) {
//                case 'text':
//                    replyMsg($event, $client);                  
//                    break;
//                case 'image':
//                    replyMsg($event, $client);                  
//                    break;
//                case 'sticker':
//                    replyMsg($event, $client);                  
//                    break;
//                case 'location':
//                    replyMsg($event, $client);                  
//                    break;
//                default:
//                    //error_log("Unsupporeted message type: " . $message['type']);
//                    break;
//            }
//            break;
//        default:
//            error_log("Unsupporeted event type: " . $event['type']);
//            break;
//    }
//};
////ชุดตัวอย่างการเขียนแบบของเตย-------------------//
// 
//echo "OK2";


//------------ gis
//C0258185eadd1aef77466dfb30d189e56 metergis
 //Cbb266cca8a0e0b7ae940dec7f3dc15dc gis+pjoe
//ฟังก์ชั่น ReplyMessage-------------------------------------------------------------//

function replyMsg1($event, $client)
{
    $uid;
    $gid;
    $ty  = $event['source']['type'];    //user,group
    //$uid = $event['source']['userId'];
    //$gid = $event['source']['groupId'];
    if($event['source']['userId']){
        $uid = $event['source']['userId'];
    }
    if($event['source']['groupId']){
        $uid = $event['source']['groupId'];
    }
 
    $id = $event['message']['id'];
 

	if ($event['type'] == 'follow') {
	 //U87b618904b23471df5c43312458c016b

		$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
		$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

		//$lineid_encode = urlencode($uid);
		//$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"line_id":"'.$uid.'"}');
		//$q_msg = json_decode($json_cmsg); 
	 
		//count-question---------//
		$json_c = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}&c=true');
		$count = json_decode($json_c);  //จำนวนที่นับได้
		//count-question---------//
	 
		$id = $event['source']['userId'];
		$urlp = 'https://api.line.me/v2/bot/profile/'.$id;
		$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

		$header = array(
			"Content-Type: application/json",
			'Authorization: Bearer '.$channelAccessToken2,
		);

		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
		//curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);       ;
		//curl_setopt($ch, CURLOPT_HTTPGET, 1);
		//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_URL, $urlp);
		 
		$profile =  curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($profile);


		$pathpic = explode("cdn.net/", $obj->pictureUrl);
	 
		if ($count == 0){

			//Post New Data--------------------------//
			$newData = json_encode(
			  array(
				'lineid'=> $uid,
				'name'=> $obj->displayName,
				'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1],

				'user_id'=> '-',
				'pwacode'=> '-',

				'manage_db'=> 'no',
				'chk_db'=> 'no',

				'pwaarea'=> 'no',
				'weather'=> 'no',
				'other'=> 'no',

				'lat'=> '-',
				'lng'=> '-',

				'datetime'=> date("Y-m-d h:i:sa"),
				'status' => 'add_friend'
			  )
			);

			$opts = array(
			  'http' => array(
				  'method' => "POST",
				  'header' => "Content-type: application/json",
				  'content' => $newData
			   )
			);
			$context = stream_context_create($opts);
			$returnValue = file_get_contents($url,false,$context);
			//Post New Data--------------------------//


			$sec = explode('"$oid" : "', $returnValue);
			$sec_id = explode('"', $sec[1]);

			 
			$t=array("ขอบคุณที่แอดเราเป็นเพื่อนนะ","ขอบคุณที่แอดเราเป็นเพื่อนนะ","ขอบคุณที่แอดเราเป็นเพื่อนนะ","ขอบคุณที่แอดเราเป็นเพื่อนนะ");
			$random_keys=array_rand($t,1);
			$txt = $t[$random_keys];
			$a = array(
						array(
							'type' => 'text',
							//'text' => $txt." เพิ่ม id:".$sec_id[0]." count:".$count
							'text' => $txt
						)
					);
			$client->replyMessage1($event['replyToken'],$a);


		}
		else if ($count == 1){  

			//query-คำถามที่เคยถามในdb----------------------------------//
			$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
			$q_json_f = json_decode($json_f); 
			$q_json_id = $q_json_f[0]->_id;
			$q_json_oid = '';
			foreach ($q_json_id as $k=>$v){
				$q_json_oid = $v; // etc.
			}

			//update-----------------------------------//
			//$_id = '59fb2268bd966f7657da67cc';
			$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

			$newupdate = json_encode(
				array(
					'$set' => array('lineid'=> $uid),
					'$set' => array('name'=> $obj->displayName),
					'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

					//'$set' => array('user_id'=> '-'),
					//'$set' => array('pwacode'=> '-'),
					//'$set' => array('manage_db'=> 'no'),
					//'$set' => array('chk_db'=> 'no'),

					//'$set' => array('pwaarea'=> 'no'),
					//'$set' => array('weather'=> 'no'),
					//'$set' => array('other'=> 'no'),

					//'$set' => array('lat'=> '-'),
					//'$set' => array('lng'=> '-'),

					'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
					'$set' => array('status'=> 'add_friend')

				)
			);

			$optsu = array(
				'http' => array(
					'method' => "PUT",
					'header' => "Content-type: application/json",
					'content' => $newupdate
				)
			);

			$contextu = stream_context_create($optsu);
			$returnValup = file_get_contents($url_up, false, $contextu);


			$t=array("ยินดีต้อนรับกลับมาเป็นเพื่อนครับ","อย่าบล็อคผมอีกนะครับ");
			$random_keys=array_rand($t,1);
			$txt = $t[$random_keys];
			//$txt = 'มีคำถามนี้แล้ว-อัพเดท $oid:';
			$a = array(
						array(
							'type' => 'text',
							//'text' => $txt." อัพเดท id:".$q_json_oid." count:".$count
							'text' => $txt
						)
					);
			$client->replyMessage1($event['replyToken'],$a);
		}
	

	}
	else if ($event['type'] == 'unfollow') {
	 //U87b618904b23471df5c43312458c016b

		$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
		$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

		//$lineid_encode = urlencode($uid);
		//$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
		//$q_msg = json_decode($json_cmsg); 
	 
		//count-question---------//
		$json_c = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}&c=true');
		$count = json_decode($json_c);  //จำนวนที่นับได้
		//count-question---------//
	 
		$id = $event['source']['userId'];
		$urlp = 'https://api.line.me/v2/bot/profile/'.$id;
		$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

		$header = array(
			"Content-Type: application/json",
			'Authorization: Bearer '.$channelAccessToken2,
		);

		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
		//curl_setopt($ch, CURLOPT_VERBOSE, 1);
		//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_FAILONERROR, 0);       ;
		//curl_setopt($ch, CURLOPT_HTTPGET, 1);
		//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_URL, $urlp);
		 
		$profile =  curl_exec($ch);
		curl_close($ch);
		$obj = json_decode($profile);


		$pathpic = explode("cdn.net/", $obj->pictureUrl);
	 
		if ($count == 0){

			//Post New Data--------------------------//
			$newData = json_encode(
			  array(
				'lineid'=> $uid,
				'name'=> $obj->displayName,
				'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1],

				'user_id'=> '-',
				'pwacode'=> '-',

				'manage_db'=> 'no',
				'chk_db'=> 'no',

				'pwaarea'=> 'no',
				'weather'=> 'no',
				'other'=> 'no',

				'lat'=> '-',
				'lng'=> '-',

				'datetime'=> date("Y-m-d h:i:sa"),
				'status' => 'unfriend'
			  )
			);

			$opts = array(
			  'http' => array(
				  'method' => "POST",
				  'header' => "Content-type: application/json",
				  'content' => $newData
			   )
			);
			$context = stream_context_create($opts);
			$returnValue = file_get_contents($url,false,$context);
			//Post New Data--------------------------//


			$sec = explode('"$oid" : "', $returnValue);
			$sec_id = explode('"', $sec[1]);

			 
			$t=array("Unfriend เราไปแล้ว","เสียใจ");
			$random_keys=array_rand($t,1);
			$txt = $t[$random_keys];
			$a = array(
						array(
							'type' => 'text',
							//'text' => $txt." เพิ่ม id:".$sec_id[0]." count:".$count
							'text' => $txt
						)
					);
			$client->replyMessage1($event['replyToken'],$a);


		}
		else if ($count == 1){  

			//query-คำถามที่เคยถามในdb----------------------------------//
			$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
			$q_json_f = json_decode($json_f); 
			$q_json_id = $q_json_f[0]->_id;
			$q_json_oid = '';
			foreach ($q_json_id as $k=>$v){
				$q_json_oid = $v; // etc.
			}

			//update-----------------------------------//
			//$_id = '59fb2268bd966f7657da67cc';
			$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

			$newupdate = json_encode(
				array(
					'$set' => array('lineid'=> $uid),
					'$set' => array('name'=> $obj->displayName),
					'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

					//'$set' => array('user_id'=> '-'),
					//'$set' => array('pwacode'=> '-'),
					//'$set' => array('manage_db'=> 'no'),
					//'$set' => array('chk_db'=> 'no'),

					//'$set' => array('pwaarea'=> 'no'),
					//'$set' => array('lat'=> '-'),
					//'$set' => array('lng'=> '-'),

					'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
					'$set' => array('status'=> 'unfriend')

				)
			);

			$optsu = array(
				'http' => array(
					'method' => "PUT",
					'header' => "Content-type: application/json",
					'content' => $newupdate
				)
			);

			$contextu = stream_context_create($optsu);
			$returnValup = file_get_contents($url_up, false, $contextu);


			$t=array("Unfriend เราทำไม","โดนบล็อคแล้ว");
			$random_keys=array_rand($t,1);
			$txt = $t[$random_keys];
			//$txt = 'มีคำถามนี้แล้ว-อัพเดท $oid:';
			$a = array(
						array(
							'type' => 'text',
							//'text' => $txt." อัพเดท id:".$q_json_oid." count:".$count
							'text' => $txt
						)
					);
			$client->replyMessage1($event['replyToken'],$a);
		}
	

	}
	else if ($event['type'] == 'join') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'ขอบคุณที่รับผมเข้ากลุ่มครับ'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'leave') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'โดนถีบออกจากกลุ่ม'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'memberJoined') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'ฮัลโหลๆ แนะนำตัวหน่อย สมาชิกใหม่'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'memberLeft') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'RIP. เสียใจด้วย คุณไม่ได้ไปต่อ'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'postback') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => $event['postback']['data']           
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}

	elseif ($event['type'] == 'beacon') {	
		$txt;
		if($event['beacon']['type'] == 'enter'){
			$txt = 'in '.'hwid='.$event['beacon']['hwid'].'   '.'type='.$event['beacon']['type'];	
		}
		elseif($event['beacon']['type'] == 'leave'){
			$txt = 'out '.'hwid='.$event['beacon']['hwid'].'   '.'type='.$event['beacon']['type'];	
		}
		
		$a = array(
					array(
						'type' => 'text',
						'text' => $txt           
					)
				);
		$client->replyMessage1($event['replyToken'],$a);

	}




}


function replyMsg($event, $client)
{

  //if($event['source']['groupId'] == $GISPWA || $event['source']['groupId'] == $METER || $event['source']['groupId'] == $GISDEV || $event['source']['userId'] == $NUT){

    $uid;
    $gid;
    $ty  = $event['source']['type'];    //user,group
    //$uid = $event['source']['userId'];
    //$gid = $event['source']['groupId'];
    if($event['source']['userId']){
        $uid = $event['source']['userId'];
    }
    if($event['source']['groupId']){
        $uid = $event['source']['groupId'];
    }
 
    $id = $event['message']['id'];
 

    //-----ถ้ามีการส่งข้อความText------------------------------------------------------------//
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
        //ข้อความtext ที่ได้รับ
        $msg = $event['message']['text'];
 
        $api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
        $url = 'https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key;
 
 
        //file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/kunutt?apiKey='.$api_key.'&q={ "_id" : { "$oid" : "59fc80f9c2ef163b3e8be96d"} ,"question":"'.$_question.'"}&c=true');
 
 
        $msg_encode = urlencode($msg);
        $json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key.'&q={"question":"'.$msg_encode.'"}');
        $q_msg = json_decode($json_cmsg); 
 
 
         if (preg_match('(สอนบอท)', $msg) === 1) {
 
            if(strstr($msg,"[") && strstr($msg,"|") && strstr($msg,"]")){
 
                // พบคำว่า PHP ในข้อความ
 
                $x_tra = str_replace("สอนบอท","", $msg);
                $pieces = explode("|", $x_tra);
                $_question = str_replace("[","",$pieces[0]);
                $_answer = str_replace("]","",$pieces[1]);
 
                if($_question == '' || $_answer == '' ){
                    exit();
                }
 
                //count-question---------//
                $json_c = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key.'&q={"question":"'.$_question.'"}&c=true');
                $count = json_decode($json_c);  //จำนวนที่นับได้
                //count-question---------//
 
 
 
						$id = $event['source']['userId'];
                        $urlp = 'https://api.line.me/v2/bot/profile/'.$id;
                        $channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';
 
                        $header = array(
                            "Content-Type: application/json",
                            'Authorization: Bearer '.$channelAccessToken2,
                        );
 
                        $ch = curl_init();
                        //curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
                        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
                        //curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_FAILONERROR, 0);       ;
                        //curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        //curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_URL, $urlp);
                         
                        $profile =  curl_exec($ch);
                        curl_close($ch);
                        $obj = json_decode($profile);
 
 
                        $pathpic = explode("cdn.net/", $obj->pictureUrl);
 
 
 
                if ($count == 0){
 
                    //Post New Data--------------------------//
                    $newData = json_encode(
                      array(
                        'question' => $_question,
                        'answer'=> $_answer,
                        'uid'=> $uid,
                        'name'=> $obj->displayName,
                        'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1]
                      )
                    );
 
                    $opts = array(
                      'http' => array(
                          'method' => "POST",
                          'header' => "Content-type: application/json",
                          'content' => $newData
                       )
                    );
                    $context = stream_context_create($opts);
                    $returnValue = file_get_contents($url,false,$context);
                    //Post New Data--------------------------//
 
 
                    $sec = explode('"$oid" : "', $returnValue);
                    $sec_id = explode('"', $sec[1]);
 
                     
                    $t=array("น่ารักที่สุดอ่ะเราน่ะ","ต่อไปเราจะตอบเธอแบบนี้นะ","ขอบคุณที่สอนเรานะ","เข้าใจแล้วล่ะว่าต้องตอบเธอยังไง");
                    $random_keys=array_rand($t,1);
                    $txt = $t[$random_keys];
                    $a = array(
                                array(
                                    'type' => 'text',
                                    //'text' => $txt." เพิ่ม id:".$sec_id[0]." count:".$count
                                    'text' => $txt
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
 
 
                }
                else if ($count == 1){  
 
                    //query-คำถามที่เคยถามในdb----------------------------------//
                    $json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key.'&q={"question":"'.$_question.'"}');
                    $q_json_f = json_decode($json_f); 
                    $q_json_id = $q_json_f[0]->_id;
                    $q_json_oid = '';
                    foreach ($q_json_id as $k=>$v){
                        $q_json_oid = $v; // etc.
                    }
 
                    //update-----------------------------------//
                    //$_id = '59fb2268bd966f7657da67cc';
                    $url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/meter_gis/'.$q_json_oid.'?apiKey='.$api_key;
 
                    $newupdate = json_encode(
                        array(
                            '$set' => array('answer'=> $_answer)
                        )
                    );
 
                    $optsu = array(
                        'http' => array(
                            'method' => "PUT",
                            'header' => "Content-type: application/json",
                            'content' => $newupdate
                        )
                    );
 
                    $contextu = stream_context_create($optsu);
                    $returnValup = file_get_contents($url_up, false, $contextu);
 
 
                    $t=array("คำถามนี้เคยสอนแล้วนะ แต่ไม่เปงไร จำใหม่ก็ได้","สอนซ้ำๆแบบนี้ เมมจะเต็มแล้วนะ");
                    $random_keys=array_rand($t,1);
                    $txt = $t[$random_keys];
                    //$txt = 'มีคำถามนี้แล้ว-อัพเดท $oid:';
                    $a = array(
                                array(
                                    'type' => 'text',
                                    //'text' => $txt." อัพเดท id:".$q_json_oid." count:".$count
                                    'text' => $txt
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
            }
 
            else{
 
                    $t = 'สอนผมได้นะ เพียงพิมพ์: สอนบอท[คำถาม|คำตอบ]';  
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $t . ''               
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
            }
 
 
        }
 
        else{
 
            $ty = $event['source']['type']; //user,group
 
            //หากไม่มีคำว่า สอนบอทจะมีการยิง API ข้างต้นไปตรงๆ โดยมี q สำหรับ Query {question:คำถาม} ไปเลย ก็จะใช้การเรียกคือ
 
            if($q_msg){
                foreach($q_msg as $rec){
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $rec->answer            
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
            }
 
            else{
 


			   if (preg_match('(#ดุ๊กดิ๊ก|#ดุ้กดิ้ก|#ดุกดิก|#ดุ๊กดิ้ก|#ดุ้กดิ๊ก)', $msg) === 1) {

					/*
					$11537=array("11537,52002734", "11537,52002735", "11537,52002736", "11537,52002737", "11537,52002738", "11537,52002739", "11537,52002740", "11537,52002741", "11537,52002742", "11537,52002743", "11537,52002744", "11537,52002745", "11537,52002746", "11537,52002747", "11537,52002748", "11537,52002749", "11537,52002750", "11537,52002751", "11537,52002752", "11537,52002753", "11537,52002754", "11537,52002755", "11537,52002756", "11537,52002757", "11537,52002758", "11537,52002759", "11537,52002760", "11537,52002761", "11537,52002762", "11537,52002763", "11537,52002764", "11537,52002765", "11537,52002766", "11537,52002767", "11537,52002768", "11537,52002769", "11537,52002770", "11537,52002771", "11537,52002772", "11537,52002773");

					$11538=array("11538,51626494", "11538,51626495", "11538,51626496", "11538,51626497", "11538,51626498", "11538,51626499", "11538,51626500", "11538,51626501", "11538,51626502", "11538,51626503", "11538,51626504", "11538,51626505", "11538,51626506", "11538,51626507", "11538,51626508", "11538,51626509", "11538,51626510", "11538,51626511", "11538,51626512", "11538,51626513", "11538,51626514", "11538,51626515", "11538,51626516", "11538,51626517", "11538,51626518", "11538,51626519", "11538,51626520", "11538,51626521", "11538,51626522", "11538,51626523", "11538,51626524", "11538,51626525", "11538,51626526", "11538,51626527", "11538,51626528", "11538,51626529", "11538,51626530", "11538,51626531", "11538,51626532", "11538,51626533");

					$11539=array("11539,52114110", "11539,52114111", "11539,52114112", "11539,52114113", "11539,52114114", "11539,52114115", "11539,52114116", "11539,52114117", "11539,52114118", "11539,52114119", "11539,52114120", "11539,52114121", "11539,52114122", "11539,52114123", "11539,52114124", "11539,52114125", "11539,52114126", "11539,52114127", "11539,52114128", "11539,52114129", "11539,52114130", "11539,52114131", "11539,52114132", "11539,52114133", "11539,52114134", "11539,52114135", "11539,52114136", "11539,52114137", "11539,52114138", "11539,52114139", "11539,52114140", "11539,52114141", "11539,52114142", "11539,52114143", "11539,52114144", "11539,52114145", "11539,52114146", "11539,52114147", "11539,52114148", "11539,52114149");
					*/

					$sticker=array("11537,52002734","11537,52002735","11537,52002736","11537,52002737","11537,52002738","11537,52002739","11537,52002740","11537,52002741","11537,52002742","11537,52002743","11537,52002744","11537,52002745","11537,52002746","11537,52002747","11537,52002748","11537,52002749","11537,52002750","11537,52002751","11537,52002752","11537,52002753","11537,52002754","11537,52002755","11537,52002756","11537,52002757","11537,52002758","11537,52002759","11537,52002760","11537,52002761","11537,52002762","11537,52002763","11537,52002764","11537,52002765","11537,52002766","11537,52002767","11537,52002768","11537,52002769","11537,52002770","11537,52002771","11537,52002772","11537,52002773","11538,51626494","11538,51626495","11538,51626496","11538,51626497","11538,51626498","11538,51626499","11538,51626500","11538,51626501","11538,51626502","11538,51626503","11538,51626504","11538,51626505","11538,51626506","11538,51626507","11538,51626508","11538,51626509","11538,51626510","11538,51626511","11538,51626512","11538,51626513","11538,51626514","11538,51626515","11538,51626516","11538,51626517","11538,51626518","11538,51626519","11538,51626520","11538,51626521","11538,51626522","11538,51626523","11538,51626524","11538,51626525","11538,51626526","11538,51626527","11538,51626528","11538,51626529","11538,51626530","11538,51626531","11538,51626532","11538,51626533","11539,52114110","11539,52114111","11539,52114112","11539,52114113","11539,52114114","11539,52114115","11539,52114116","11539,52114117","11539,52114118","11539,52114119","11539,52114120","11539,52114121","11539,52114122","11539,52114123","11539,52114124","11539,52114125","11539,52114126","11539,52114127","11539,52114128","11539,52114129","11539,52114130","11539,52114131","11539,52114132","11539,52114133","11539,52114134","11539,52114135","11539,52114136","11539,52114137","11539,52114138","11539,52114139","11539,52114140","11539,52114141","11539,52114142","11539,52114143","11539,52114144","11539,52114145","11539,52114146","11539,52114147","11539,52114148","11539,52114149");
	

					$random_keys=array_rand($sticker,1);
					$txt = $sticker[$random_keys];

					$split = explode(",", $txt);
					$p = $split[0];
					$s = $split[1];
					//echo $split[0];
					
					$client->replyMessage1($event['replyToken'],array(
							array(
								'type' => 'sticker',
								'packageId' => $p,
								'stickerId' => $s,
								'stickerResourceType'=> 'ANIMATION'
							)
							/*
							array(
								'type' => 'sticker',
								'packageId' => $p,
								'stickerId' => $s,
								//'stickerResourceType'=> 'STATIC'
							),
							array(
								'type' => 'sticker',
								'packageId' => 3,
								'stickerId' => 232
							),
								array(
								'type' => 'sticker',
								'packageId' => 3,
								'stickerId' => 233
							)       
							*/
					 
					)
						);
				}


                else if (preg_match('(#ระบบกภส.)', $msg) === 1) {

					$client->replyMessage1($event['replyToken'],array(

						array(
							"type"=> "template",
							  "altText"=> "this is a image carousel template",
							  "template"=> 
							  array(
								  "type"=> "image_carousel",
								  "columns"=> 
								  array ( 
									  array(
										"imageUrl"=> "https://swls.pwa.co.th/dmaline/imgToei/logo-PWA.jpg",
										"action"=> 
										array(
										  "type"=> "message",
										  "label"=> "PWA",
										  "text"=> "PWA"
										)
									  ),
									  array(
										"imageUrl"=> "https://swls.pwa.co.th/dmaline/imgToei/sadness200.jpg",
										"action"=> 
										array(
										  "type"=> "uri",
										  "label"=> "Sadness",
										  "uri"=> "https://swls.pwa.co.th/dmaline/imgToei/sadness.jpg"
										)
									  )
								  )
							  )
						)

					));

				 }

                else if (preg_match('(บอทครับ|บอทคะ|บอทคับ|ดีบอท|สวัสดีครับบอท|สวัสดีบอท|หวัดดีบอท)', $msg) === 1) {
 
                    if ($ty == 'user'){
 
                        $url = 'https://api.line.me/v2/bot/profile/'.$uid;
                        $channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';
 
                        $header = array(
                            "Content-Type: application/json",
                            'Authorization: Bearer '.$channelAccessToken2,
                        );
 
                        $ch = curl_init();
                        //curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
                        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
                        //curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_FAILONERROR, 0);       ;
                        //curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        //curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_URL, $url);
                         
                        $profile =  curl_exec($ch);
                        curl_close($ch);
                        $obj = json_decode($profile);
 
 
                        $pathpic = explode("cdn.net/", $obj->pictureUrl);
 
 
                        $a = array(
 
                                array(
                                    'type' => 'text',
                                    'text' => 'ดีจ้า '.$obj->displayName
                                ),
                                array(
                                    'type' => 'image',
                                    'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1],
                                    'previewImageUrl' => 'https://obs.line-apps.com/'.$pathpic[1].'/large'
                                )
    //                      ,
    //                          array(
    //                              'type' => 'text',
    //                              'text' => $ty. ' '.$uid. ' '. $gid. ' '.$profile
    //                          )
    //                      ,
    //                          array(
    //                              'type' => 'text',
    //                              'text' => 'สวัสดีคุณ '.$obj->displayName.' type='.$ty.' uid='.$uid.' gid='.$gid
    //                          )
    //                      ,
    //                          array(
    //                              'type' => 'text',
    //                              'text' => $obj->statusMessage
    //                          ),
    //                          array(
    //                              'type' => 'text',
    //                              'text' => $obj->pictureUrl
    //                          )
                            );
                        $client->replyMessage1($event['replyToken'],$a);
 
                    }
 
                    else if ($ty == 'group'){
 
 
                        $gid = $event['source']['groupId'];
                        $uid = $event['source']['userId'];
 
                        //$uid =  'Uebffb1bffc4ccb8f823238e2c22f11ed';
                        //$gid =  'Cd495e0ee56720de9b2b914dff0eabc16';
                        $url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
                        //$url = 'https://api.line.me/v2/bot/profile/'.$uid;
                        $channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';
 
                        $header = array(
                            "Content-Type: application/json",
                            'Authorization: Bearer '.$channelAccessToken2,
                        );
                        $ch = curl_init();
                        //curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
                        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
                        //curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_FAILONERROR, 0);       ;
                        //curl_setopt($ch, CURLOPT_HTTPGET, 1);
                        //curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
                        curl_setopt($ch, CURLOPT_HEADER, 0);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
                        curl_setopt($ch, CURLOPT_URL, $url);
                         
                        $profile =  curl_exec($ch);
                        curl_close($ch);
                        $obj = json_decode($profile);
 
                        $pathpic = explode("cdn.net/", $obj->pictureUrl);
 
                        $a = array(
 
                                array(
                                    'type' => 'text',
                                    'text' => 'ดีจ้า '.$obj->displayName
                                ),
                                array(
                                    'type' => 'image',
                                    'originalContentUrl' => 'https://obs.line-apps.com/'.$pathpic[1],
                                    'previewImageUrl' => 'https://obs.line-apps.com/'.$pathpic[1].'/large'
                                )
//                          ,
//                              array(
//                                  'type' => 'text',
//                                  'text' => $ty. ' '.$uid. ' '. $gid. ' '.$profile
//                              )
//                          ,
//                              array(
//                                  'type' => 'text',
//                                  'text' => 'สวัสดีคุณ '.$obj->displayName.' type='.$ty.' uid='.$uid.' gid='.$gid
//                              )
    //                      ,
    //                          array(
    //                              'type' => 'text',
    //                              'text' => $obj->statusMessage
    //                          ),
    //                          array(
    //                              'type' => 'text',
    //                              'text' => $obj->pictureUrl
    //                          )
                            );
                        $client->replyMessage1($event['replyToken'],$a);
 
                    }
 
                }
 

				else if(preg_match('(#DGA|#dga|#authen|#ออเทน|#Authen)', $msg) === 1) {

						$urllink = 'https://gisweb1.pwa.co.th/lineservice/dga/get_log_count.php'; 
						$chl = curl_init();
						curl_setopt( $chl, CURLOPT_URL, $urllink); 
						curl_setopt($chl, CURLOPT_RETURNTRANSFER , 1);
						curl_setopt($chl, CURLOPT_POST, 0);
						curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 0); 
						curl_setopt($chl, CURLOPT_TIMEOUT, 6000); //timeout in seconds
						$res = curl_exec($chl);		
						curl_close($chl);
						//$obj = json_decode($res);
						
						$a_ = array(

									array(
										'type' => 'text',
										'text' => $res
										
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);						

					
				}


				else if(preg_match('(#อัพโหลด|#Upload|#upload|#สถานะอัพโหลด|#อับโหลด|#สถานะอับโหลด)', $msg) === 1) {

					$div = explode(" ",$msg);
					if(preg_match('(meter|bldg|pipe|firehydrant|valve)', $div[1]) === 1){
						$urllink = 'https://gisweb1.pwa.co.th/lineservice/gisdatastat/check_postgres_vs_oracle.php?ly='.$div[1]; 
						$chl = curl_init();
						curl_setopt( $chl, CURLOPT_URL, $urllink); 
						curl_setopt($chl, CURLOPT_RETURNTRANSFER , 1);
						curl_setopt($chl, CURLOPT_POST, 0);
						curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 0); 
						curl_setopt($chl, CURLOPT_TIMEOUT, 6000); //timeout in seconds
						$res = curl_exec($chl);		
						curl_close($chl);

						$a_ = array(

									array(
										'type' => 'text',
										'text' => 'การอัพโหลด '.$div[1].' '.$res 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
					}
					else{
						$urllink = 'https://gisweb1.pwa.co.th/lineservice/gisdatastat/check_postgres_vs_oracle_pwacode.php?name='.$div[1]; 
						$chl = curl_init();
						curl_setopt( $chl, CURLOPT_URL, $urllink); 
						curl_setopt($chl, CURLOPT_RETURNTRANSFER , 1);
						curl_setopt($chl, CURLOPT_POST, 0);
						curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 0); 
						curl_setopt($chl, CURLOPT_TIMEOUT, 6000); //timeout in seconds
						$res = curl_exec($chl);		
						curl_close($chl);

						$a_ = array(

									array(
										'type' => 'text',
										'text' => 'การอัพโหลด '.$div[1].' '.$res 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);						
						/*
						$a_ = array(

									array(
										'type' => 'text',
										'text' => '"'.$div[1].'"'.' คำค้นนี้ไม่สามารถตรวจสอบการอัพโหลดได้'
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
						*/
					}
				}


				else if(preg_match('(#เพิ่มสิทธิ|#เพิ่มสิทธิ์|#เพิ่มสิทธิ์มาตร|#เพิ่มสิทธิ์ระบบมาตร|#เพิ่มสิทธิ์ระบบมาตรฯ)', $msg) === 1) {
                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];
					$chk = chk_friend($uid);
					if($chk == false){
					   $a_ = array(

									array(
										'type' => 'text',
										'text' => 'ถ้าไม่แอดผมเป็นเพื่อน ผมก็ไม่ทำงานให้หรอกครับ'.$chk 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
					}
					else{

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];


					$today = date("Y-m-d");
					//$today = "2018-07-01";
					$txt = "";
					$DayOfWeek = date("w", strtotime($today));
					if($DayOfWeek == 0 )  // 0 = Sunday, 6 = Saturday;
					{
						$txt = "ให้ผมพักบ้างไม่ได้หรอ วันอาทิตย์เป็นวันหยุดนะครับ ชิ...";
						//echo "$today = <font color=red>Holiday(Sunday)</font><br>";
					}

					else if($DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
					{
						$txt = "ให้ผมพักบ้างไม่ได้หรอ วันเสาร์เป็นวันหยุดนะครับ ชิ...";
						//echo "$today = <font color=red>Holiday(Saturday)</font><br>";
					}

					else{
						$speak=array("ตั้งใจทำงานดีมาก","ขยันแบบนี้ องค์กรชอบครับ","ขอให้ตั้งใจทำงานแบบนี้ต่อไปนะครับ","ขยันทำงานแบบนี้ต่อไปนะ","ขอมอบตำแหน่งนักวิชาการเพิ่มสิทธิ์ให้คุณ");
						$random_keys=array_rand($speak,1);
						$txt = $speak[$random_keys];
						//echo "$today = <font color=blue>No Holiday</font><br>";
					}



					//$getA = "#เพิ่มสิทธิ์ 12974 12975 111 1211 8879";

					//$div = explode(" ",$getA);
					$div = explode(" ",$msg);
					/*
					echo $div[0]; //#เพิ่มสิทธิ์
					echo '<br>';
					echo $div[1];
					echo '<br>';
					echo $div[2];
					echo '<br>';
					echo $div[3];
					echo '<br>';
					echo $div[4];
					echo '<br>';
					echo $div[5];
					echo '<br>';
					echo 'count array= '.count($div);
					echo '<br>';
					*/
					$data = array();

					for ($x = 1; $x <= count($div); $x++) {
						//echo "The number is: $x <br>";
						array_push($data, $div[$x]);
					} 
					/*
					echo $data[0]; //#เพิ่มสิทธิ์
					echo '<br>';
					echo $data[1];
					echo '<br>';
					echo $data[2];
					echo '<br>';
					echo $data[3];
					echo '<br>';
					echo $data[4];
					echo '<br>';
					echo $data[5];
					*/
					///*

					$url = 'https://api.line.me/v2/bot/profile/'.$uid;			//user
					$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

					$header = array(
						"Content-Type: application/json",
						'Authorization: Bearer '.$channelAccessToken2,
					);
					$ch = curl_init();
					//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
					//curl_setopt($ch, CURLOPT_VERBOSE, 1);
					//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
					//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
					curl_setopt($ch, CURLOPT_FAILONERROR, 0);		;
					//curl_setopt($ch, CURLOPT_HTTPGET, 1);
					//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
					//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
					curl_setopt($ch, CURLOPT_URL, $url);
					
					$profile =  curl_exec($ch);
					curl_close($ch);
					$obj = json_decode($profile);

					$name = urlencode($obj->displayName);
					//$obj->displayName."(".$obj->statusMessage.")
					//$name = "test";		
					/*
					$messages = [
					'type' => 'text',
					'text' => 'คุณ '.$obj->displayName.' โปรดรอสักครู่... ระบบกำลังเพิ่มสิทธิ์'
					];
					*/
					
						$urllink = 'https://gisweb1.pwa.co.th/meterstat/service/userline.php';
								$chl = curl_init();
								curl_setopt( $chl, CURLOPT_URL, $urllink); 
								curl_setopt($chl, CURLOPT_RETURNTRANSFER , 1);
								curl_setopt($chl, CURLOPT_POST, 1);
								//curl_setopt($chl, CURLOPT_MAXCONNECTS, 6000); //timeout in sconds
								//curl_setopt($chl, CURLOPT_TIMECONDITION, 6000); //timeout in sconds
								//CURLOPT_CONNECTTIMEOUT - The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
								//CURLOPT_TIMEOUT - The maximum number of seconds to allow cURL functions to execute.
								curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 0); 
								curl_setopt($chl, CURLOPT_TIMEOUT, 6000); //timeout in seconds

								  $values = array(
									'gid' => $gid,
									'uid' => $uid,
									'name' => $name,
									'type' => 'meter_add',
									'data' => $data
								  );
								$params = http_build_query($values);
								curl_setopt($chl, CURLOPT_POSTFIELDS,$params); 
								$res = curl_exec($chl);		
								curl_close($chl);


						/*	
						$messages = [
						'type' => 'text',
						'text' => $res
						];
						*/

						/*
						$messages = [					
						'type' => 'sticker',
						 'packageId' => 1,
						 'stickerId' => 1
						];
						*/

						
					   $a_ = array(

									array(
										'type' => 'text',
										'text' => $obj->displayName." ".$txt          
									),

									array(
										'type' => 'text',
										'text' => $res . '' 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
					}
				}

				else if(preg_match('(#ลบสิทธิ|#ลบสิทธิ์|#ลบสิทธิ์มาตร|#ลบสิทธิ์ระบบมาตร|#ลบสิทธิ์ระบบมาตรฯ)', $msg) === 1) {
                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];
					$chk = chk_friend($uid);

					if($chk == false){
					   $a_ = array(

									array(
										'type' => 'text',
										'text' => 'ถ้าไม่แอดผมเป็นเพื่อน ผมก็ไม่ทำงานให้หรอกครับ'.$chk 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
					}
					else{
						$gid = $event['source']['groupId'];
						$uid = $event['source']['userId'];


						$today = date("Y-m-d");
						//$today = "2018-07-01";
						$txt = "";
						$DayOfWeek = date("w", strtotime($today));
						if($DayOfWeek == 0 )  // 0 = Sunday, 6 = Saturday;
						{
							$txt = "ให้ผมพักบ้างไม่ได้หรอ วันอาทิตย์เป็นวันหยุดนะครับ ชิ...";
							//echo "$today = <font color=red>Holiday(Sunday)</font><br>";
						}

						else if($DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
						{
							$txt = "ให้ผมพักบ้างไม่ได้หรอ วันเสาร์เป็นวันหยุดนะครับ ชิ...";
							//echo "$today = <font color=red>Holiday(Saturday)</font><br>";
						}

						else{
							$speak=array("ตั้งใจทำงานดีมาก","ขยันแบบนี้ องค์กรชอบครับ","ขอให้ตั้งใจทำงานแบบนี้ต่อไปนะครับ","ขยันทำงานแบบนี้ต่อไปนะ","ขอมอบตำแหน่งนักวิชาการเพิ่มสิทธิ์ให้คุณ");
							$random_keys=array_rand($speak,1);
							$txt = $speak[$random_keys];
							//echo "$today = <font color=blue>No Holiday</font><br>";
						}


						//$getA = "#เพิ่มสิทธิ์ 12974 12975 111 1211 8879";

						//$div = explode(" ",$getA);
						$div = explode(" ",$msg);
						/*
						echo $div[0]; //#เพิ่มสิทธิ์
						echo '<br>';
						echo $div[1];
						echo '<br>';
						echo $div[2];
						echo '<br>';
						echo $div[3];
						echo '<br>';
						echo $div[4];
						echo '<br>';
						echo $div[5];
						echo '<br>';
						echo 'count array= '.count($div);
						echo '<br>';
						*/
						$data = array();

						for ($x = 1; $x <= count($div); $x++) {
							//echo "The number is: $x <br>";
							array_push($data, $div[$x]);
						} 
						/*
						echo $data[0]; //#เพิ่มสิทธิ์
						echo '<br>';
						echo $data[1];
						echo '<br>';
						echo $data[2];
						echo '<br>';
						echo $data[3];
						echo '<br>';
						echo $data[4];
						echo '<br>';
						echo $data[5];
						*/
						///*

						$url = 'https://api.line.me/v2/bot/profile/'.$uid;			//user
						$channelAccessToken2 = 't9nRyxC8yWtjxD0TEtDdpiNKCY3u+C1hCnIW4khz+OxQqI6dfYN3zQfjcnZc4nIWgjD8My1l2OG7C5qEfwjLujcqMBTUfwUdLxPv7yy7YcUeddjESBThvLErPrnyo7+Mq1PCI5wauXh3OK5PZ5aqeQdB04t89/1O/w1cDnyilFU=';

						$header = array(
							"Content-Type: application/json",
							'Authorization: Bearer '.$channelAccessToken2,
						);
						$ch = curl_init();
						//curl_setopt($ch, CURLOPT_HTTP_VERSION, 'CURL_HTTP_VERSION_1_1');
						//curl_setopt($ch, CURLOPT_VERBOSE, 1);
						//curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
						//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_FAILONERROR, 0);		;
						//curl_setopt($ch, CURLOPT_HTTPGET, 1);
						//curl_setopt($ch, CURLOPT_USERAGENT, $agent);
						//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
						curl_setopt($ch, CURLOPT_HEADER, 0);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
						curl_setopt($ch, CURLOPT_URL, $url);
						
						$profile =  curl_exec($ch);
						curl_close($ch);
						$obj = json_decode($profile);

						$name = urlencode($obj->displayName);
						//$obj->displayName."(".$obj->statusMessage.")
						//$name = "test";		
						/*
						$messages = [
						'type' => 'text',
						'text' => 'คุณ '.$obj->displayName.' โปรดรอสักครู่... ระบบกำลังเพิ่มสิทธิ์'
						];
						*/

						$urllink = 'https://gisweb1.pwa.co.th/meterstat/service/userline.php';
								$chl = curl_init();
								curl_setopt( $chl, CURLOPT_URL, $urllink); 
								curl_setopt($chl, CURLOPT_RETURNTRANSFER , 1);
								curl_setopt($chl, CURLOPT_POST, 1);
								//curl_setopt($chl, CURLOPT_MAXCONNECTS, 6000); //timeout in sconds
								//curl_setopt($chl, CURLOPT_TIMECONDITION, 6000); //timeout in sconds
								//CURLOPT_CONNECTTIMEOUT - The number of seconds to wait while trying to connect. Use 0 to wait indefinitely.
								//CURLOPT_TIMEOUT - The maximum number of seconds to allow cURL functions to execute.
								curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 0); 
								curl_setopt($chl, CURLOPT_TIMEOUT, 6000); //timeout in seconds

								  $values = array(
									'gid' => $gid,
									'uid' => $uid,
									'name' => $name,
									'type' => 'meter_del',
									'data' => $data
								  );
								$params = http_build_query($values);
								curl_setopt($chl, CURLOPT_POSTFIELDS,$params); 
								$res = curl_exec($chl);		
								curl_close($chl);


						/*	
						$messages = [
						'type' => 'text',
						'text' => $res
						];
						*/

						/*
						$messages = [					
						'type' => 'sticker',
						 'packageId' => 1,
						 'stickerId' => 1
						];
						*/

						
					   $a_ = array(

									array(
										'type' => 'text',
										'text' => $obj->displayName." ".$txt          
									),

									array(
										'type' => 'text',
										'text' => $res . '' 
									),
								);
						$client->replyMessage1($event['replyToken'],$a_);
					}
				}

				else if(preg_match('(#ลบ|#ลบข้อมูล)', $msg) === 1) {

						$pieces = explode(" ", $msg);
						$_sel = $pieces[1];

						$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";

						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key.'&q={"question":"'.$_sel.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}
 
						//$_id = '59fb2268bd966f7657da67cc';
						$url_d = 'https://api.mlab.com/api/1/databases/linedb/collections/meter_gis/'.$q_json_oid.'?apiKey='.$api_key;

						$optsd = array(
								'http' => array(
								'method' => "DELETE",
								'header' => "Content-type: application/json"
							)
						);
	 
						$contextd = stream_context_create($optsd);
						$returnValdel = file_get_contents($url_d, false, $contextd);

						$t=array("ลบให้แล้วครับ","จัดให้ครับ","ลบเรียบร้อยครับ");
						$random_keys=array_rand($t,1);
						$txt = $t[$random_keys];
						$a = array(
									array(
										'type' => 'text',
										'text' => $txt          
									)
								);
						$client->replyMessage1($event['replyToken'],$a);


				}

				else if(preg_match('(#ใครสอน|#ใครสอนคำว่า)', $msg) === 1) {

						$pieces = explode("|", $msg);
						$_sel = $pieces[1];

						$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";

						$msg_encode = urlencode($_sel);
						$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/meter_gis?apiKey='.$api_key.'&q={"question":"'.$msg_encode.'"}');
						$q_msg = json_decode($json_cmsg); 
				 
						if($q_msg){
							foreach($q_msg as $rec){
								$a = array(
											array(
												'type' => 'text',
												'text' => $rec->name     
												//'text' => $rec->originalContentUrl 					
											),
											array(
													'type' => 'image',
													'originalContentUrl' => $rec->originalContentUrl ,
													'previewImageUrl' => $rec->originalContentUrl 
												)
										);
								$client->replyMessage1($event['replyToken'],$a);
							}
						}

				}


                else if (preg_match('(เสียใจ|ร้องไห้|ไม่ต้องร้อง|ผิดหวัง)', $msg) === 1) {
                    $a = array(
                                array(
                                    'type' => 'sticker',
                                    'packageId' => 2,
                                    'stickerId' => 152
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
 
                else if (preg_match('(ปวดขี้)', $msg) === 1) {
 
                    $a = array(
                                array(
                                    'type' => 'sticker',
                                    'packageId' => 1,
                                    'stickerId' => 115
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }

                else if (preg_match('(นอนละ|ไปนอน|นอนแล้ว|ฝันดี)', $msg) === 1) {
 
                    $a = array(
                                array(
                                    'type' => 'sticker',
                                    'packageId' => 3,
                                    'stickerId' => 239
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
 
                }
 
                else if (preg_match('(ด่า|เลว|นิสัยไม่ดี|โดนว่า|น่าเบื่อ|รำคาญ|ชั่ว|สันดาน|บ่น|ถูกว่า)', $msg) === 1) {
 
                    $t = 'การบ่นไม่ใช่การแก้ปัญหา และ การด่าก็ไม่ใช่วิธีการแก้ไข';  
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $t . ''               
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }

                else if (preg_match('(กอล์ฟอยู่ไหน|กอล์ฟมายัง)', $msg) === 1) {
 
					$sticker=array("2,502","2,512","4,290");
					$random_keys=array_rand($sticker,1);
					$txt = $sticker[$random_keys];

					$split = explode(",", $txt);
					$p = $split[0];
					$s = $split[1];
					//echo $split[0];

					$locat=array("13.891447,100.565528,ศูนย์ราชการ แจ้งวัฒนะ","13.785380,100.573617,Poseidon Entertainment Complex","13.7677596,100.5992513,THE PIMP CLUB BANGKOK","13.756688,100.541259,เจ้าพระยา 2","13.759238, 100.482953,โรงเรียนวัดอมรินทราราม");
					$rand_keys=array_rand($locat,1);
					$txt1 = $locat[$random_keys];

					$split1 = explode(",", $txt1);
					$lat = $split1[0];
					$lng = $split1[1];
					$add = $split1[2];


					$client->replyMessage1($event['replyToken'],
						array(
							array(
								'type' => 'sticker',
								'packageId' => $p,
								'stickerId' => $s
							),
							array(
									"type"=> "location",
									"title"=> "ตำแหน่งปัจจุบันของกอล์ฟ",
									"address"=> $add,
									"latitude"=> $lat,
									"longitude"=> $lng		
								)

						)
					);

                }
 



                else if (preg_match('(น่ารัก|น่ารักนะ|น่ารักจัง)', $msg) === 1) {
 
                    $t=array("ขอบคุณสำหรับคำชม","เขินจุง","ลอยแล้วๆ");
                    $random_keys=array_rand($t,1);
                    $txt = $t[$random_keys];
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $txt          
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
 
 
                else if (preg_match('(เหงา|เหงาจัง|เหงาอ่ะ)', $msg) === 1) {
 
                    $t=array("เราพร้อมจะเป็นเพื่อนคุณนะ","เหงาเหมือนกันเลย","ให้ช่วยแก้เหงามั้ย");
                    $random_keys=array_rand($t,1);
                    $txt = $t[$random_keys];
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $txt          
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
 
                else if (preg_match('(วิธีใช้งาน|สอนยังไง|วิธีสอน)', $msg) === 1) {
 
                    $t = 'คุณสามารถสอนผมให้ฉลาดได้ เพียงพิมพ์: สอนบอท[คำถาม|คำตอบ]';    
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $t . ''               
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
 
                }
 

				else if (preg_match('(#อัพโหลดภาพ|#Gps|#เช็คgps|#เช็คGps|#เช็ค Gps)', $msg) === 1) {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

					$url = 'https://api.line.me/v2/bot/profile/'.$uid;
					//$url ='https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
					$profile = get_profile($url);
					$obj = json_decode($profile);

					$nameid = urlencode($obj->displayName);
						//$obj->statusMessage
						//$obj->pictureUrl	
					

		 			$id = "";
					if ($gid){
						$id = $gid;
					}
					else{
						$id = $uid;
					}

					$client->replyMessage1($event['replyToken'],array(
						   array(
							  "type"=> "template",
							   "altText"=> "this is a buttons template",
							   "template"=> 
								array(
								"type"=> "buttons",
								"thumbnailImageUrl"=> "https://gisbott.herokuapp.com/Chatbot.png",
								"title"=> "Menu",
								"text"=> "Please select",
								"actions"=>          
							   array ( 
							    array(
									"type"=> "uri",
									"label"=> "CheckGPS_uri_p",
									"uri"=> "https://gisweb1.pwa.co.th/lineservice/location/index.html?id=".$id."&nameid=".$nameid."&type=line"
									//"uri"=> "https://gisweb1.pwa.co.th/lineservice/location/index.html?id=".$id."&nameid=&type=line"
								 )
								)
								)
							)
						));

                }
 
                else if (preg_match('(วันนี้|วันอะไร)', $msg) === 1) {

					$today = date("Y-m-d");
					//$today = "2018-07-01";
					$txt = "";
					$DayOfWeek = date("w", strtotime($today));
					if($DayOfWeek == 0 )  // 0 = Sunday, 6 = Saturday;
					{
						$txt = "วันนี้เป็นวันหยุด(วันอาทิตย์)";
						//echo "$today = <font color=red>Holiday(Sunday)</font><br>";
					}

					else if($DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
					{
						$txt = "วันนี้เป็นวันหยุด(วันเสาร์)";
						echo "$today = <font color=red>Holiday(Saturday)</font><br>";
					}


					else{
						$txt = "วันนี้ก็คือวันนี้";
						//echo "$today = <font color=blue>No Holiday</font><br>";

					}


                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $txt          
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }


				else if (preg_match('(#ระบบที่พัฒนาโดยกภส.|#ระบบที่พัฒนาโดยกภส)', $msg) === 1) {


					$a = array(
							array(
								'type' => 'flex',
								'altText' => 'ระบบกภส.',
								'contents'=> array(

								/* เอามาจากflex*/

								  "type"=> "bubble",
								  "header"=> array(
									"type"=> "box",
									"layout"=> "horizontal",
									"contents"=> array(
									  array(
										"type"=> "text",
										"text"=> "ระบบที่พัฒนาโดย กภส.",
										"size"=> "lg",
										"weight"=> "bold",
										"align"=> "center",
										"gravity"=> "center",
										"wrap"=> true,
										"style"=> "normal"
										//"color"=> "#414141",
									  )
									)
								  ),
								  "body"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "สนับสนุนงานกปภ.",
											"weight"=> "bold",
											"size"=> "xs",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "ติดตามมาตรวัดน้ำ",
													'uri'=> 'https://gisweb1.pwa.co.th/meterstat/'
													)
										   )
										  )
										
									  ),          
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "ศักยภาพด้านการตลาด",
													'uri'=> 'https://gisweb1.pwa.co.th/potential_service/'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "พื้นที่ให้บริการของ กปภ.",
													'uri'=> 'https://gisweb1.pwa.co.th/gis_servicearea/'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "สนับสนุน GIS.",
											"weight"=> "bold",
											"size"=> "xs",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "GISWEB",
													'uri'=> 'https://gisweb1.pwa.co.th/gisweb/'
													)
										   )
										  )
										
									  ),          
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "สรุปความยาวท่อ กปภ.",
													'uri'=> 'https://gisweb1.pwa.co.th/gis4manager/'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "สถานะอัพโหลด GIS",
													'uri'=> 'https://gisweb1.pwa.co.th/upload_status_commit/'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "ค้นหาผู้ใช้น้ำด้วยเส้นท่อ (demo)",
													'uri'=> 'https://gisweb1.pwa.co.th/search_customer/'
													)
										   )
										  )
										
									  ),    
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "อื่นๆ",
											"weight"=> "bold",
											"size"=> "xs",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "ระบบคัดสำเนา",
													'uri'=> 'https://gisweb1.pwa.co.th/dga/'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  )

									)
								  ),
								  "footer"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "เว็บไซต์ กภส.",
													'uri'=> 'https://gis.pwa.co.th/home.php'
													)
										   )
										  )
										
									  )

									)
								  ),
								  "styles"=> array(
									"header"=> array(
									  "backgroundColor"=> "#ffffff"
									),
									"body"=> array(
									  "backgroundColor"=> "#464F69"
									)
								  )

								/* เอามาจากflex*/

								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }

				else if (preg_match('(#status|#status)', $msg) === 1) {


					$a = array(
							array(
								'type' => 'flex',
								'altText' => 'upload.',
								'contents'=> array(

								/* เอามาจากflex*/

								  "type"=> "bubble",
								  "header"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "GIS DATABASE",
											"size"=> "sm",
											"weight"=> "bold",
											"color"=> "#1DB446"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "กปภ.สาขาพระนครศรีอยุธยา",
											"weight"=> "bold",
											"size"=> "md",
											"margin"=> "xs"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "ข้อมูล ณ วันที่ 20 พฤษภาคม 2563",
											"size"=> "xs",
											"color"=> "#aaaaaa",
											"wrap"=> true
										  )
										)
									  )


									)
								  ),
								  "body"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										   array(
												"type"=> "separator",
												"color"=> "#000000"
										   )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "LAYER",
											"size"=> "sm",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "bold",
											"style"=> "normal",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "OC",
											"size"=> "sm",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "bold",
											"style"=> "normal",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "PG",
											"size"=> "sm",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "bold",
											"style"=> "normal",
											"align"=> "end"
										  )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										   array(
												"type"=> "separator",
												"color"=> "#000000"
										   )
										)
									  ),


									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "METER",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "24,000",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "24,000",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "PIPE",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "7,500",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "7,450",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "BLDG",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "45,000",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "42,000",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "VALVE",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "200",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "200",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "LEAKPOINT",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "640",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "640",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "FIREHYDRANT",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "200",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "180",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "PWA_WATERWORK",
											"size"=> "xxs",
											"color"=> "#555555",
											"flex"=> 6,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "7",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  ),
										  array(
											"type"=> "text",
											"text"=> "5",
											"size"=> "xs",
											"color"=> "#555555",
											"flex"=> 3,
											"weight"=> "regular",
											"style"=> "normal",
											"decoration"=> "none",
											"align"=> "end"
										  )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										   array(
												"type"=> "separator",
												"color"=> "#000000"
										   )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										   array(
												"type"=> "separator",
												"color"=> "#000000"
										   )
										)
									  ),


									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "RESULT",
											"size"=> "xs",
											"color"=> "#000000",
											"flex"=> 6,
											"align"=> "start",
											"weight"=> "bold",
											"gravity"=> "center"
										  ),
										  array(
											"type"=> "text",
											"text"=> "PASS",
											"color"=> "#1DB446",
											"size"=> "xs",
											"align"=> "end",
											"flex"=> 6,
											"weight"=> "bold",
											"gravity"=> "center"
										  )
										),
										"spacing"=> "none",
										"margin"=> "sm"
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										   array(
												"type"=> "separator",
												"color"=> "#000000",
												"margin"=> "sm"
										   )
										)
									  )


									)
								  ),
								  /*
								  "footer"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "เว็บไซต์ กภส.",
													'uri'=> 'https://gis.pwa.co.th/home.php'
													)
										   )
										  )
										
									  )

									)
								  ),
								  */
								  "styles"=> array(
									"header"=> array(
									  "backgroundColor"=> "#ffffff"
									  //"paddingTop": "10px",
									  //"paddingBottom": "10px"
									),
									"body"=> array(
									  "backgroundColor"=> "#ffffff"
									)
								  )

								/* เอามาจากflex*/

								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }

				else if (preg_match('(#ช่วยเหลือ|#ช่วยเหลือ)', $msg) === 1) {


					$a = array(
							array(
								'type' => 'flex',
								'altText' => '#วิธีการใช้งานไลน์บอท.',
								'contents'=> array(

								/* เอามาจากflex*/

								  "type"=> "bubble",
								  "header"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(
									  array(
										"type"=> "text",
										"text"=> "#วิธีการใช้งานไลน์บอท",
										"size"=> "lg",
										"weight"=> "bold",
										"align"=> "center",
										"gravity"=> "center",
										"wrap"=> true,
										"style"=> "normal"
										//"color"=> "#414141",
									  )
									)
								  ),
								  "body"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "separator"
										  ),
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "SYSTEM",
											"weight"=> "bold",
											"size"=> "sm",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "message",
													'label'=> "ระบบที่พัฒนาโดยกภส. (URL)",
													'text'=> '#ระบบที่พัฒนาโดยกภส.'
													)
										   )
										  )
										
									  ),          
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  /*
									  array(
										"type"=> "box",
										"layout"=> "horizontal",
										"contents"=> array(
										  array(
											"type"=> "image",
											"url"=> "https://www.iqair.com/assets/aqi/ic-face-green.svg",
											"size"=> "md",
											"align"=> "start"
										  ),
										  array(
											"type"=> "text",
											"text"=> "Moderate",
											"wrap"=> true,
											"size"=> "lg",
											"color"=> "#a57f23",
											"gravity"=> "center"
										  )
										),
										"margin"=> "xxl"
									  ),
									  */

									  array(
										'type'=> "box",
										'layout'=> "horizontal",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "ติดตามมาตร",
													'text'=> '#คำสั่งmeterstat'
													)
										   ),
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "คัดสำเนา",
													'text'=> '#คำสั่งdga'
													)
										   )
										  )
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "horizontal",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "ข้อมูล GIS",
													'text'=> '#คำสั่งgisdb'
													)
										   ),
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "ลงทะเบียน",
													'text'=> '#คำสั่งลงทะเบียน'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  ),
										  array(
											"type"=> "separator"
										  ),
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "GIS",
											"weight"=> "bold",
											"size"=> "sm",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "message",
													'label'=> "ตรวจสอบพื้นที่ให้บริการ",
													'text'=> '#คำสั่งservicearea'
													)
										   )
										  )
										
									  ),          
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "message",
													'label'=> "ค้นหาตำแหน่ง กปภ.",
													'text'=> '#คำสั่งsearchpwa'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  ),
										  array(
											"type"=> "separator"
										  ),
										  array(
											"type"=> "spacer"
										  )
										)
									  ),

									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "OTHER",
											"weight"=> "bold",
											"size"=> "sm",
											"align"=> "start",
											"color"=> "#ffffffcc"
										  )
										)
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "horizontal",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "สภาพอากาศ",
													'text'=> '#สภาพอากาศ'
													)
										   ),
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "โควิด 19",
													'text'=> '#คำสั่งโควิด'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  )
										)
									  ),
									  array(
										'type'=> "box",
										'layout'=> "horizontal",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "สอนบอท",
													'text'=> '#คำสั่งbot'
													)
										   ),
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											//'flex'=> "6",
											'margin'=> "md",
											//"gravity"=> "center",
											'action'=> array(
													'type'=> "message",
													'label'=> "นัดหมาย",
													'text'=> '#คำสั่งนัดหมาย'
													)
										   )
										  )
										
									  ),
									  array(
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> array(
										  array(
											"type"=> "spacer"
										  ),
										  array(
											"type"=> "separator"
										  )
										)
									  )
									)
								  )/*,
								  "footer"=> array(
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> array(

									  array(
										'type'=> "box",
										'layout'=> "vertical",
										'contents'=> array(
										   array(
											'type'=> "button",
											'style'=> "primary",
											'height'=> "sm",
											'action'=> array(
													'type'=> "uri",
													'label'=> "เว็บไซต์ กภส.",
													'uri'=> 'https://gis.pwa.co.th/home.php'
													)
										   )
										  )
										
									  )

									)
								  )*/,
								  "styles"=> array(
									"header"=> array(
									  "backgroundColor"=> "#ffff22"
									),
									"body"=> array(
									  "backgroundColor"=> "#464F69"
									)
								  )

								/* เอามาจากflex*/

								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }



				else if (preg_match('(#ลงทะเบียน|#register|#Register|#REGISTER)', $msg) === 1) {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

					if (chk_friend($uid) == false){

						$a = array(
									array(
										'type' => 'text',
										'text' => 'โปรดเพิ่มบอทเป็นเพื่อนก่อนลงทะเบียน'          
									)
								);
						$client->replyMessage1($event['replyToken'],$a);

					}
					else if (chk_friend($uid) == true){
						
						//$gid = $event['source']['groupId'];
						$uid = $event['source']['userId'];


						$url = 'https://api.line.me/v2/bot/profile/'.$uid;
						//$url ='https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
						$profile = get_profile($url);
						$obj = json_decode($profile);

						$nameid = $obj->displayName;
						$status = $obj->statusMessage;
						$pathpic = explode("cdn.net/", $obj->pictureUrl);
						$iconUrl = 'https://obs.line-apps.com/'.$pathpic[1];
						
						if($nameid != ''){

							$urllink = 'https://gispwa.herokuapp.com/gis-pwa.php?send=register&nameid='.$nameid.'&iconUrl='.$iconUrl.'&id='.$uid;
							//$urllink = urlencode($urllink);
							$res = get_url($urllink); 

							$a = array(
									   array(
										   'type' => 'text',
										   'text' => 'เราได้ส่งข้อความให้ '.$nameid.' แล้ว โปรดตรวจสอบและลงทะเบียน'         
									   )
									);
							$client->replyMessage1($event['replyToken'],$a);

						}
						else{
							$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
							$a = array(
									array(
										'type' => 'flex',
										'altText' => 'ลงทะเบียน',
										'contents'=> array(

										/* เอามาจากflex*/

										  "type"=> "bubble",
										  "header"=> array(
											"type"=> "box",
											"layout"=> "horizontal",
											"contents"=> array(
											  array(
												"type"=> "text",
												"text"=> "ผูกบัญชีไลน์กับข้อมูลพนักงาน",
												"color"=> "#414141",
												"gravity"=> "center",
												"size"=> "lg",
												"wrap"=> true,
												"align"=> "center"
											  )
											)
										  ),
										  "body"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(
											  array(
												"type"=> "box",
												"layout"=> "horizontal",
												"contents"=> array(
												  array(
													"type"=> "image",
													"url"=> $iconUrl,
													"size"=> "md",
													"align"=> "start",
													"gravity"=> "center"
												  ),
												  array(
													"type"=> "text",
													"text"=> $nameid,
													"wrap"=> true,
													"size"=> "lg",
													"color"=> "#a57f23",
													"gravity"=> "center"
													//"flex" => 3 // for auto size image+name more(image<) less(image>)
												  )
												)
											  )

											)
										  ),
										  "footer"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(

											  array(
												'type'=> "box",
												'layout'=> "vertical",
												'contents'=> array(
												   array(
													'type'=> "button",
													'style'=> "primary",
													"gravity"=> "center",
													"margin"=> "sm",
													'height'=> "sm",
													'action'=> array(
															'type'=> "uri",
															'label'=> "ลงทะเบียน",
															'uri'=> $str
															)
												   )
												  )
											  )


											)
										  ),

										  "styles"=> array(

												"header"=> array(
												  "backgroundColor"=> "#fdd74a"
												),
												"body"=> array(
												  "backgroundColor"=> "#fffcf2"
												),
												"footer"=> array(
												  "separator"=> true
												)

										  )

										/* เอามาจากflex*/

										)
									)
							);
							$client->replyMessage1($event['replyToken'],$a);
						}



												
					}
                }

                else if (preg_match('(#ช่วยเหลือมาตร|#ช่วยเหลือmeterstat|helpmeterstat)', $msg) === 1) {
 
					$t = "คำสั่งการใช้งาน ระบบติดตามมาตรฯ 
					\n 1.การเพิ่ม/ลบ สิทธิ์
					\n #เพิ่มสิทธิ์ หรือ #เพิ่มสิทธิ์มาตร หรือ #เพิ่มสิทธิ์ระบบมาตร หรือ #เพิ่มสิทธิ์ระบบมาตรฯ 
					\n (เพิ่มสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
					\n ตัวอย่าง
					\n  1.1.1 กรณีเพิ่มสิทธิ์ 1 คน => #เพิ่มสิทธิ์ 12974
					\n  1.1.2 กรณีเพิ่มสิทธิ์ มากกว่า 1 คน => #เพิ่มสิทธิ์ 12974 12975 12976
					\n #ลบสิทธิ์ หรือ #ลบสิทธิ์มาตร หรือ #ลบสิทธิ์ระบบมาตร หรือ #ลบสิทธิ์ระบบมาตรฯ 
					\n (ลบสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
					\n  ตัวอย่าง
					\n  1.2.1 กรณีลบสิทธิ์ 1 คน => #ลบสิทธิ์ 12974
					\n  1.2.2 กรณีลบสิทธิ์ มากกว่า 1 คน => #ลบสิทธิ์ 12974 12975 12976

					\n  2.ตรวจสอบข้อมูล GIS
					\n  2.1 ตรวจสอบเป็น layer #อัพโหลด [layer]
					\n  2.2 ตรวจสอบเป็น สาขา #อัพโหลด [สาขา]
						
					";					
					
					/*
					$text_reply = "
					
					วิธีการเพิ่มสิทธิ์ระบบติดตามมาตรวัดน้ำ 
					\n ใช้คีย์เวิร์ดในการเพิ่ม ดังนี้ #เพิ่มสิทธิ์ หรือ #เพิ่มสิทธิ์มาตร หรือ #เพิ่มสิทธิ์ระบบมาตร หรือ #เพิ่มสิทธิ์ระบบมาตรฯ 
					\n ***(เพิ่มสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
					\n ตัวอย่างการเพิ่มสิทธิ์
					\n  1.กรณีเพิ่มสิทธิ์ 1 คน => #เพิ่มสิทธิ์ 12974
					\n  2.กรณีเพิ่มสิทธิ์ มากกว่า 1 คน => #เพิ่มสิทธิ์ 12974 12975 12976

					\n ใช้คีย์เวิร์ดในการลบ ดังนี้ #ลบสิทธิ์ หรือ #ลบสิทธิ์มาตร หรือ #ลบสิทธิ์ระบบมาตร หรือ #ลบสิทธิ์ระบบมาตรฯ 
					\n ***(ลบสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
					\n  ตัวอย่างการลบสิทธิ์
					\n  1.กรณีลบสิทธิ์ 1 คน => #ลบสิทธิ์ 12974
					\n  2.กรณีลบสิทธิ์ มากกว่า 1 คน => #ลบสิทธิ์ 12974 12975 12976
					"; 
					*/

					/*
					$text_reply = "คำสั่งของไลน์บอทต่างๆ 
					\n  1.ค้นหาข้อมูลความยาวท่อ => ท่อ [ชนิด] [ขนาด] [อายุ]
					\n  2.ค้นหาข้อมูลมาตรฯ => มาตรฯ [    ]
					\n  3.ค้นหาตำแหน่ง => location
					\n  4.เช็คสถานะDBระบบติดตามมาตร => meterstat 
					\n  5.ค้นหาตำแหน่งกปภ.สาขา => #ไป [กปภ.สาขา] 
					\n  6.555, sticker, รูป, พื้นที่ให้บริการ 
					";
					*/

                    //$t = 'ช่วยเหลือ';    
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $t . ''               
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
 
                }
                else if (preg_match('(#ช่วยเหลือdga|ช่วยเหลือdga|#helpdga)', $msg) === 1) {
 
					$t = "คำสั่งการใช้งาน ระบบคัดสำเนา
					\n 1.ตรวจสอบจำนวนโควต้าของคนออเทนในปัจจุบัน
					\n #dga

					";					
					
					/*
					$text_reply = "คำสั่งของไลน์บอทต่างๆ 
					\n  1.ค้นหาข้อมูลความยาวท่อ => ท่อ [ชนิด] [ขนาด] [อายุ]
					\n  2.ค้นหาข้อมูลมาตรฯ => มาตรฯ [    ]
					\n  3.ค้นหาตำแหน่ง => location
					\n  4.เช็คสถานะDBระบบติดตามมาตร => meterstat 
					\n  5.ค้นหาตำแหน่งกปภ.สาขา => #ไป [กปภ.สาขา] 
					\n  6.555, sticker, รูป, พื้นที่ให้บริการ 
					";
					*/

                    //$t = 'ช่วยเหลือ';    
                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $t . ''               
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
 
                }


				else if (preg_match('(#flex|#flex)', $msg) === 1) {


					$a = array(
							array(
								'type' => 'flex',
								'altText' => '#วิธีการใช้งานไลน์บอท.',
								'contents'=> array(


										  "type"=> "bubble",
										  "body"=> array(
											"type"=> "box",
											"layout"=> "horizontal",
											"contents"=> array(
											  array(
												"type"=> "box",
												"layout"=> "vertical",
												"contents"=> array(
												  array(
													"type"=> "image",
													"url"=> "https://gispwa.herokuapp.com/image/sally.jpg",
													"aspectRatio"=> "1:2",
													"aspectMode"=> "cover"
												  )
												)
											  ),
											  array(
												"type"=> "box",
												"layout"=> "vertical",
												"contents"=> array(
												  array(
													"type"=> "text",
													"text"=> "flex=1",
													"flex"=> 1,
													"gravity"=> "center"
												  ),
												  array(
													"type"=> "separator"
												  ),
												  array(
													"type"=> "text",
													"text"=> "flex=1",
													"flex"=> 1,
													"gravity"=> "center"
												  )
												)
											  )
											)
										  )


								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }





				else if (preg_match('(#slide|#slide)', $msg) === 1) {


					$a = array(
							array(
								'type' => 'flex',
								'altText' => '#วิธีการใช้งานไลน์บอท.',
								'contents'=> array(

								/* เอามาจากflex*/
/*
array(
  "type"=> "carousel",
  "contents"=> array(

		array(
		  "type"=> "bubble",
		  "body"=> array(
			"type"=> "box",
			"layout"=> "vertical",
			"contents"=> array(
				  array(
					"type"=> "text",
					"text"=> "SYSTEM"
				  )
			)
		  )
		),
		array(
		  "type"=> "bubble",
		  "body"=> array(
			"type"=> "box",
			"layout"=> "vertical",
			"contents"=> array(
				  array(
					"type"=> "text",
					"text"=> "SYSTEM"
				  )
			)
		  )
		)

  )
)
*/

/*
array(
  "type"=> "bubble",
  "styles"=> array(
    "footer"=> array(
      "backgroundColor"=> "#42b3f4"
    )
  ),
  "header"=> array(
    "type"=> "box",
    "layout"=> "horizontal",
    "contents"=> array(
      array(
        "type"=> "box",
        "layout"=> "baseline",
        "contents"=> array(
          array(
            "type"=> "icon",
            "size"=> "xxl",
            "url"=> "https=>//scontent.fbkk7-2.fna.fbcdn.net/v/t1.0-1/p200x200/22814542_1962234637127047_1607260544847069468_n.png?_nc_cat=0&oh=2a303227c24dfab9e71a405b6d594d50&oe=5BC3965D"
          )
        )
      ),
      array(
        "type"=> "box",
        "layout"=> "vertical",
        "flex"=> 5,
        "contents"=> array(
          array(
            "type"=> "text",
            "text"=> "โรงพยาบาลอ่างทอง",
            "weight"=> "bold",
            "color"=> "#aaaaaa",
            "size"=> "md",
            "gravity"=> "top"
          ),
          array(
            "type"=> "text",
            "text"=> "ขอขอบพระคุณ",
            "weight"=> "bold",
            "color"=> "#aaaaaa",
            "size"=> "lg",
            "gravity"=> "top"
          )
        )
      )
    )
  ),
  "hero"=> array(
    "type"=> "image",
    "url"=> "https=>//scontent.fbkk7-2.fna.fbcdn.net/v/t1.0-9/35076722_2227987830551725_330757188106584064_n.jpg?_nc_cat=0&oh=0f5fa137c5bd65f109a40439afcd59eb&oe=5BB566B6",
    "size"=> "full",
    "aspectRatio"=> "16:9",
    "aspectMode"=> "cover",
    "action"=> array(
      "type"=> "uri",
      "uri"=> "http=>//bit.ly/2JGBRKv"
    )
  ),
  "body"=> array(
    "type"=> "box",
    "layout"=> "vertical",
    "contents"=> array(
      array(
        "type"=> "text",
        "margin"=> "sm",
        "text"=> "คุณกานต์สินี ไหลสงวนงาม",
        "weight"=> "bold",
        "size"=> "md",
        "wrap"=> true
      ),
      array(
        "type"=> "box",
        "layout"=> "vertical",
        "margin"=> "xs",
        "contents"=> array(
          array(
            "type"=> "box",
            "layout"=> "baseline",
            "spacing"=> "sm",
            "contents"=> array(
              array(
                "type"=> "text",
                "text"=> "บริจาคเงินจำนวน ๑๘๐,๐๐๐ บาท เพื่อซื้อครุภัณฑ์ทางการแพทย์ ใช้ในโรงพยาบาลอ่างทอง โดยมีนายแพทย์พงษ์นรินทร์ ชาติรังสรรค์ผู้อำนวยการโรงพยาบาลอ่างทอง เป็นผู้รับมอบ",
                "wrap"=> true,
                "color"=> "#666666",
                "size"=> "sm",
                "flex"=> 6
              )
            )
          )
        )
      ),
      array(
        "type"=> "text",
        "margin"=> "md",
        "text"=> "วันที่ 12 มิ.ย. 2561",
        "size"=> "sm",
        "color"=> "#adadad"
      )
    )
  ),
  "footer"=> array(
    "type"=> "box",
    "layout"=> "vertical",
    "spacing"=> "sm",
    "contents"=> array(
      array(
        "type"=> "button",
        "style"=> "link",
        "color"=> "#FFFFFF",
        "height"=> "sm",
        "action"=> array(
          "type"=> "uri",
          "label"=> "อ่านต่อ...",
          "uri"=> "http=>//bit.ly/2JGBRKv"
        )
      )
    )
  )
)
*/


  "type"=> "carousel",
  "contents"=> array(
										array(
										  "type"=> "bubble",
										  "header"=> array(
											"type"=> "box",
											"layout"=> "horizontal",
											"contents"=> array(
											  array(
												"type"=> "text",
												"text"=> "ผูกบัญชีไลน์กับข้อมูลพนักงาน",
												"color"=> "#414141",
												"gravity"=> "center",
												"size"=> "lg",
												"wrap"=> true,
												"align"=> "center"
											  )
											)
										  ),
										  "hero"=> array(
											"type"=> "image",
											"url"=> "https://gispwa.herokuapp.com/image/kpi.jpg",
											"size"=> "full",
											"aspectRatio"=> "16:9",
											"aspectMode"=> "cover",
											"action"=> array(
											  "type"=> "uri",
											  "uri"=> "http://bit.ly/2JGBRKv"
											)
										  ),
										  "body"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(
											  array(
												"type"=> "box",
												"layout"=> "horizontal",
												"contents"=> array(
												  array(
													"type"=> "image",
													"url"=> 'https://gispwa.herokuapp.com/image/ic-face-red.png',
													"size"=> "md",
													"align"=> "start",
													"gravity"=> "center"
												  ),
												  array(
													"type"=> "text",
													"text"=> 'หนังสือเล่มนี้ดี',
													"wrap"=> true,
													"size"=> "lg",
													"color"=> "#a57f23",
													"gravity"=> "center"
													//"flex" => 3 // for auto size image+name more(image<) less(image>)
												  )
												)
											  )

											)
										  ),
										  "footer"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(

											  array(
												'type'=> "box",
												'layout'=> "vertical",
												'contents'=> array(
												   array(
													'type'=> "button",
													'style'=> "link",
													"gravity"=> "center",
													"margin"=> "sm",
													'height'=> "sm",
													'action'=> array(
															'type'=> "uri",
															'label'=> "ลงทะเบียน",
															'uri'=> "http://bit.ly/2JGBRKv"
															)
												   )
												  )
											  )


											)
										  ),

										  "styles"=> array(

												"header"=> array(
												  "backgroundColor"=> "#fdd74a"
												),
												"body"=> array(
												  "backgroundColor"=> "#fffcf2"
												),
												"footer"=> array(
												  "separator"=> true
												)

										  )
										),
										array(
										  "type"=> "bubble",
										  "header"=> array(
											"type"=> "box",
											"layout"=> "horizontal",
											"contents"=> array(
											  array(
												"type"=> "text",
												"text"=> "ผูกบัญชีไลน์กับข้อมูลพนักงาน",
												"color"=> "#414141",
												"gravity"=> "center",
												"size"=> "lg",
												"wrap"=> true,
												"align"=> "center"
											  )
											)
										  ),
										  "hero"=> array(
											"type"=> "image",
											"url"=> "https://gispwa.herokuapp.com/image/kpi.jpg",
											"size"=> "full",
											"aspectRatio"=> "16:9",
											"aspectMode"=> "cover",
											"action"=> array(
											  "type"=> "uri",
											  "uri"=> "http://bit.ly/2JGBRKv"
											)
										  ),
										  "body"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(
											  array(
												"type"=> "box",
												"layout"=> "horizontal",
												"contents"=> array(
												  array(
													"type"=> "image",
													"url"=> 'https://gispwa.herokuapp.com/image/ic-face-red.png',
													"size"=> "md",
													"align"=> "start",
													"gravity"=> "center"
												  ),
												  array(
													"type"=> "text",
													"text"=> 'หนังสือเล่มนี้ดี',
													"wrap"=> true,
													"size"=> "lg",
													"color"=> "#a57f23",
													"gravity"=> "center"
													//"flex" => 3 // for auto size image+name more(image<) less(image>)
												  )
												)
											  )

											)
										  ),
										  "footer"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(

											  array(
												'type'=> "box",
												'layout'=> "vertical",
												'contents'=> array(
												   array(
													'type'=> "button",
													'style'=> "primary",
													"gravity"=> "center",
													"margin"=> "sm",
													'height'=> "sm",
													'action'=> array(
															'type'=> "uri",
															'label'=> "ลงทะเบียน",
															'uri'=> "http://bit.ly/2JGBRKv"
															)
												   )
												  )
											  )


											)
										  ),

										  "styles"=> array(

												"header"=> array(
												  "backgroundColor"=> "#fdd74a"
												),
												"body"=> array(
												  "backgroundColor"=> "#fffcf2"
												),
												"footer"=> array(
												  "separator"=> true
												)

										  )
										)

  )


								/* เอามาจากflex*/

								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }



				else if ($msg == '#ตรวจสอบพื้นที่ให้บริการ') {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

					$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
					$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;


					//count-question---------//
					$json_c = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}&c=true');
					$count = json_decode($json_c);  //จำนวนที่นับได้
					//count-question---------//


					if ($count == 1){


						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}

						//update-----------------------------------//
						//$_id = '59fb2268bd966f7657da67cc';
						$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

						$newupdate = json_encode(
							array(
								//'$set' => array('lineid'=> $uid),
								//'$set' => array('name'=> $obj->displayName),
								//'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

								//'$set' => array('user_id'=> '-'),
								//'$set' => array('pwacode'=> '-'),
								//'$set' => array('manage_db'=> 'no'),
								//'$set' => array('chk_db'=> 'no'),

								//'$set' => array('pwaarea'=> 'no'),
								//'$set' => array('weather'=> 'no'),
								//'$set' => array('other'=> 'no'),

								//'$set' => array('lat'=> '-'),
								//'$set' => array('lng'=> '-'),


								'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
								//'$set' => array('status'=> 'add_friend'),
								'$set' => array('pwaarea'=> 'yes')
							)
						);

						$optsu = array(
							'http' => array(
								'method' => "PUT",
								'header' => "Content-type: application/json",
								'content' => $newupdate
							)
						);

						$contextu = stream_context_create($optsu);
						$returnValup = file_get_contents($url_up, false, $contextu);
						


						$urllink = 'https://gisweb1.pwa.co.th/lineservice/line_register/check.php?id='.$uid; 
						$res = get_url($urllink); 
						$str = trim($res); 

						if ($str == 'found'){
							$a = array(
										array(
											'type' => 'text',
											'text' => 'โปรดแชร์ Location เพื่อตรวจสอบพื้นที่ให้บริการ'      
										)
									);
							$client->replyMessage1($event['replyToken'],$a);
						}
						else if ($str == 'notfound'){
							$a = array(
										array(
											'type' => 'text',
											'text' => 'กรุณาลงทะเบียนก่อนใช้บริการนี้'       
										)
									);
							$client->replyMessage1($event['replyToken'],$a);
						}
						else{
							$a = array(
										array(
											'type' => 'text',
											'text' => $str         
										)
									);
							$client->replyMessage1($event['replyToken'],$a);
						}

					}
					else{
						$a = array(
									array(
										'type' => 'text',
										'text' => 'โปรดเพิ่มบอทเป็นเพื่อนก่อนครับ'         
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
					}








				}

				else if ($msg == '#สภาพอากาศ') {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

					$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
					$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;


					//count-question---------//
					$json_c = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}&c=true');
					$count = json_decode($json_c);  //จำนวนที่นับได้
					//count-question---------//


					if ($count == 1){


						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}

						//update-----------------------------------//
						//$_id = '59fb2268bd966f7657da67cc';
						$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

						$newupdate = json_encode(
							array(
								//'$set' => array('lineid'=> $uid),
								//'$set' => array('name'=> $obj->displayName),
								//'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

								//'$set' => array('user_id'=> '-'),
								//'$set' => array('pwacode'=> '-'),
								//'$set' => array('manage_db'=> 'no'),
								//'$set' => array('chk_db'=> 'no'),

								//'$set' => array('pwaarea'=> 'no'),
								//'$set' => array('weather'=> 'no'),
								//'$set' => array('other'=> 'no'),

								//'$set' => array('lat'=> '-'),
								//'$set' => array('lng'=> '-'),


								'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
								//'$set' => array('status'=> 'add_friend'),
								'$set' => array('weather'=> 'yes')
							)
						);

						$optsu = array(
							'http' => array(
								'method' => "PUT",
								'header' => "Content-type: application/json",
								'content' => $newupdate
							)
						);

						$contextu = stream_context_create($optsu);
						$returnValup = file_get_contents($url_up, false, $contextu);
						
							$a = array(
										array(
											'type' => 'text',
											'text' => 'โปรดแชร์ Location เพื่อตรวจสอบคุณภาพอากาศ'      
										)
									);
							$client->replyMessage1($event['replyToken'],$a);


					}
					else{
						$a = array(
									array(
										'type' => 'text',
										'text' => 'โปรดเพิ่มบอทเป็นเพื่อนก่อนครับ'         
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
					}








				}

				else if (preg_match('(#track |#track )', $msg) === 1) {
					
					$split = explode("#track ", $msg);

					$id = $split[1];


					if(strlen($id) != 13){
						//echo 'โปรดระบุเลขพัสดุให้ถูกต้อง';
						$a = array(
									array(
										'type' => 'text',
										'text' => 'โปรดระบุเลขพัสดุให้ถูกต้อง'
									)
								);
						$client->replyMessage1($event['replyToken'],$a);

					}
					else if(substr($id,0,-12) == 'P'){
						//echo 'พัสดุธรรมดา ไม่สามารถตรวจสอบสถานะได้  ตรวจสอบสถานะได้ที่ Call Center 1545';
						$a = array(
									array(
										'type' => 'text',
										'text' => 'พัสดุธรรมดา ไม่สามารถตรวจสอบสถานะได้  ตรวจสอบสถานะได้ที่ Call Center 1545'
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
					}
					else if(is_numeric(substr($id,11,13) == true )){
						//echo 'เลขพัสดุของท่านไม่ถูกต้อง';
						$a = array(
									array(
										'type' => 'text',
										'text' => 'เลขพัสดุของท่านไม่ถูกต้อง'
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
					}
					else if(substr($id,0,-12) == 'E' || substr($id,0,-12) == 'R'){

						if(substr($id,0,-12) == 'E'){
							//echo 'พัสดุลงทะเบียน EMS';
							//echo '<br>';
						}
						if(substr($id,0,-12) == 'R'){
							//echo 'พัสดุแบบลงทะเบียน';
							//echo '<br>';
						}

						$obj =tp_get_token($id);
						//EB315050240TH


						if($obj->status == 1 || $obj->message == 'successfull'){

							/*
							echo '<br>';
							echo 'status: '.$obj->status; //1 = true, 0 = false
							echo '<br>';
							echo 'message: '.$obj->message; //successfull
							echo '<br>';
							*/

							foreach($obj->response->items as $key=>$value)
							{
								if($value[count($value)-1]->barcode == ''){
									//echo '<br>';
									//echo 'ไม่พบเลขพัสด ุ'.$id_.' โปรดตรวจสอบอีกครั้ง';
									$a = array(
												array(
													'type' => 'text',
													'text' => 'ไม่พบเลขพัสด ุ'.$id.' โปรดตรวจสอบอีกครั้ง'
												)
											);
									$client->replyMessage1($event['replyToken'],$a);

								}
								else{
									/*
									//echo $key;
									//echo '<br>';
									//echo count($value);
									//echo $value[5];

									//แสดงแบบเป็นtext
									//echo json_encode($value[count($value)-1]);
									echo '<br>';
									echo 'เลขพัสดุ: '.$value[count($value)-1]->barcode;
									echo '<br>';
									echo 'สถานะ: '.$value[count($value)-1]->status_description;
									echo '<br>';
									echo 'สถานที่: '.$value[count($value)-1]->location;
									echo '<br>';
									echo 'วันที่: '.$value[count($value)-1]->status_date;
									echo '<br>';

									if($value[count($value)-1]->status == 501 || $value[count($value)-1]->delivery_status == 'S'){
										echo '<br>';
										echo 'สถานะการรับ: '.$value[count($value)-1]->delivery_description;
										echo '<br>';
										echo 'วันที่รับ: '.$value[count($value)-1]->delivery_datetime;
										echo '<br>';
										echo 'ผู้รับ: '.$value[count($value)-1]->receiver_name;
										echo '<br>';
										echo 'ลายเซ็น: '.$value[count($value)-1]->signature;
									 }
									 else{

									 }
									*/

									$txt =	'เลขพัสดุ: '.$value[count($value)-1]->barcode.'\n'.
											'สถานะ: '.$value[count($value)-1]->status_description.'\n'.
											'สถานที่: '.$value[count($value)-1]->location.'\n'.
											'วันที่: '.$value[count($value)-1]->status_date.'\n'.
											'สถานะการรับ: '.$value[count($value)-1]->delivery_description.'\n'.
											'วันที่รับ: '.$value[count($value)-1]->delivery_datetime.'\n'.
											'ผู้รับ: '.$value[count($value)-1]->receiver_name;
											
									//$link = 'https://trackimage.thailandpost.co.th/f/signature/QDUwMjQwYjVzMGx1VDMz/QGI1c0VCMGx1VDMx/QGI1czBsVEh1VDM0/QGI1czBsdTMxNTBUMzI';
									$a = array(
												array(
													'type' => 'text',
													'text' => $txt
												),
												array(
													'type' => 'image',
													'originalContentUrl' => $value[count($value)-1]->signature,
													'previewImageUrl' => $value[count($value)-1]->signature   
												)
											);
									$client->replyMessage1($event['replyToken'],$a);


								}


							}



						}
						else{

							//ไม่พบ

						}


					}
					else{



					}




				}

                else{
 
//                    $api_="H3f4tWEBNwW1yyBxhzLr8L02U14jQP6Z";
//                    $urladd = 'https://api.mlab.com/api/1/databases/meter_gis/collections/chatbot?apiKey='.$api_;
// 
//                    //Post New Data--------------------------//
//                    $newDataad = json_encode(
//                      array(
//                        'question' => $msg,
//                        'answer'=> '-'
//                      )
//                    );
// 
//                    $optsad = array(
//                      'http' => array(
//                          'method' => "POST",
//                          'header' => "Content-type: application/json",
//                          'content' => $newDataad
//                       )
//                    );
//                    $contextad = stream_context_create($optsad);
//                    $returnValuead = file_get_contents($urladd,false,$contextad);
//                    //Post New Data--------------------------//
// 
// 
// 
// 
// 
// 
// 
//                    $t=array("คืออะไร ไม่เข้าใจ","ต้องการจะสื่ออะไร?","อืม...ไงดีล่ะ");
//                    $random_keys=array_rand($t,1);
//                    $txt = $t[$random_keys];
//                    $a = array(
//                                array(
//                                    'type' => 'text',
//                                    'text' => $txt          
//                                )
//                            );
//                    $client->replyMessage1($event['replyToken'],$a);
// 
                }
                 
            }
 
        }
    }
    //----------------------------จบเงื่อนไขข้อความtext-----------------------------------//
     //-----ถ้ามีการส่งimage------------------------------------------------------------//
    elseif ($event['type'] == 'message' && $event['message']['type'] == 'image') {

		$message = $event['message'];
		//$url = $_SERVER['HTTP_HOST'];
		 
		//$imagepath = 'img/';  
		$imagename = 'img_'.date('Ymdhis').'.jpg';
		//$imageData = $client->getImage($event['message']['id']);
		//$save_result = file_put_contents($imagepath.$imagename, $imageData);
		

		/*
        $client->replyMessage1($event['replyToken'],array(
                array(
                    'type' => 'text',
                    'text' => $event['message']['type']
                ),
                array(
                    'type' => 'text',
                    'text' => $event['message']['id']
                ),      
                array(
                    'type' => 'sticker',
                    'packageId' => 3,
                    'stickerId' => 232
                )
        ));
		*/
    }
    //----------------------------จบเงื่อนไขimage------------------------------------//
 
     //-----ถ้ามีการส่งvideo------------------------------------------------------------//
    elseif ($event['type'] == 'message' && $event['message']['type'] == 'video') {
		/*
		  "message": {
			"id": "325708",
			"type": "video",
			"duration": 60000,
			"contentProvider": {
			  "type": "external",
			  "originalContentUrl": "https://example.com/original.mp4",
			  "previewImageUrl": "https://example.com/preview.jpg"
			}
		*/

		$sticker=array("2,149","2,23","3,239","2,154","2,161","3,232","2,24","1,115","2,152","4,616","4,296","2,165","4,279","2,525","2,19","2,527");
		$random_keys=array_rand($sticker,1);
		$txt = $sticker[$random_keys];

		$split = explode(",", $txt);
		$p = $split[0];
		$s = $split[1];
		//echo $split[0];

		/*
        $client->replyMessage1($event['replyToken'],array(
                array(
                    'type' => 'text',
                    'text' => $event['message']['type']
                ),
                array(
                    'type' => 'text',
                    'text' => $event['message']['contentProvider']['type']
                ),

                array(
                    'type' => 'sticker',
                    'packageId' => $p,
                    'stickerId' => $s
                )

        ));
		*/
    }
    //----------------------------จบเงื่อนไขvideo------------------------------------//
 
 
    //-----ถ้ามีการส่งสติ๊กเกอร์------------------------------------------------------------//
    elseif ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {

		$sticker=array("2,149","2,23","3,239","2,154","2,161","3,232","2,24","1,115","2,152","4,616","4,296","2,165","4,279","2,525","2,19","2,527","11538,51626498","11538,51626525","11537,52002771");
		$random_keys=array_rand($sticker,1);
		$txt = $sticker[$random_keys];

		$split = explode(",", $txt);
		$p = $split[0];
		$s = $split[1];
		//echo $split[0];

        $client->replyMessage1($event['replyToken'],array(
                array(
                    'type' => 'sticker',
                    'packageId' => $p,
                    'stickerId' => $s
                )
             
                /*,
                array(
                    'type' => 'sticker',
                    'packageId' => 3,
                    'stickerId' => 232
                ),
                    array(
                    'type' => 'sticker',
                    'packageId' => 3,
                    'stickerId' => 233
                )       
                */
         
        )
            );
    }
    //----------------------------จบเงื่อนไขสติ๊กเกอร์------------------------------------//
 
	/*
   //-----ถ้ามีการแชร์ location-------------------------------------------------------//
   elseif ($event['type'] == 'message' && $event['message']['type'] == 'location') {
        $latitude = $event['message']['latitude'];
        $longitude = $event['message']['longitude'];
        $title = $event['message']['title'];
        $address = $event['message']['address'];
 
               $client->replyMessage1($event['replyToken'],array(
 
 
                        array(
                                'type' => 'text',
                                'text' => 'มีการแชร์ตำแหน่ง'
                        ),
 
                        array(
                                "type"=> "location",
                                "title"=> "ตำแหน่งของท่าน",
                                "address"=> $address,
                                "latitude"=> $latitude,
                                "longitude"=> $longitude
                        )
                   )
                );
    }
    //----------------------------จบเงื่อนไขแชร์ location------------------------------------//
	*/
   elseif ($event['type'] == 'message' && $event['message']['type'] == 'location') {


		$latitude = $event['message']['latitude'];
		$longitude = $event['message']['longitude'];
		$title = $event['message']['title'];
		$address = $event['message']['address'];
		$uid = $event['source']['userId'];
		$gid = $event['source']['groupId'];




		$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
		$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

		//$lineid_encode = urlencode($uid);
		$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
		$q_msg = json_decode($json_cmsg); 
		if($q_msg){
			foreach($q_msg as $rec){



				if($rec->chk_db != 'no'){



				}
				if($rec->pwaarea != 'no'){


					$urllink = 'https://gisweb1.pwa.co.th/lineservice/line_register/check.php?id='.$uid; 
						$res = get_url($urllink); 
						$str = trim($res); 

					if ($str == 'found'){
						/*
						$text = [
								"type"=> "location",
								"title"=> 'ตำแหน่งของท่าน',
								"address"=> $address,
								"latitude"=> $latitude,
								"longitude"=> $longitude
								];       
						$uid = $event['replyToken']; // id reply
						$client->replyMessage($uid, $text);
						*/

					   /*
						$client->replyMessage1($event['replyToken'],array(
										array(
											'type' => 'text',
											'text' => 'GPS'				
										)
									)
						);
						*/

						if ($gid){
							$t = 'กำลังตรวจสอบตำแหน่งของท่าน โปรดรอสักครู่ ...';	
							$client->pushMessage1($gid,array(
										array(
											'type' => 'text',
											'text' => $t 
										) 
									)
							);
						}

						else if ($uid){
							$t = 'กำลังตรวจสอบตำแหน่งของท่าน โปรดรอสักครู่ ...';	
							$client->pushMessage1($uid,array(
										array(
											'type' => 'text',
											'text' => $t 
										) 
									)
							);
						}


						$urllink = 'https://gisweb1.pwa.co.th/lineservice/servicearea/check_area.php?latitude='.$latitude.'&longitude='.$longitude; 
						$str = get_url($urllink); 
						//$str = iconv("win-874","utf-8",$convert);
						//$json = json_decode($str);
						$split = explode(",", $str);
						//echo $split[0];
						//echo $split[1];
						//echo $split[2];

						if ($split[0] == 'in'){

						   $client->replyMessage1($event['replyToken'],array(
									array(
											"type"=> "location",
											"title"=> "ตำแหน่งของท่าน",
											"address"=> $address,
											"latitude"=> $latitude,
											"longitude"=> $longitude
									),
									array(
											'type' => 'text',
											'text' => 'ตำแหน่งของท่านอยู่ในพื้นที่ให้บริการของกปภ.สาขา'.	$split[2].' ('.$split[1].')'
									),
									array(
										'type' => 'flex',
										'altText' => 'ขอใช้น้ำประปา กปภ.',
										'contents'=> array(
													'type'=> 'bubble',
													'body'=> array(
															 'type'=> "box",
															 'layout'=> "vertical",
															 'contents'=> array(
																			  array(
																			   'type'=> "button",
																			   'style'=> "primary",
																			   'height'=> "sm",
																			   'action'=> array(
																							'type'=> "uri",
																							'label'=> "ขอใช้น้ำประปา กปภ.",
																							'uri'=> 'https://customer-application.pwa.co.th/register-service/add'
																						   )
																			  )
															 )
													)
										)
									)
									/*
									array(
									  "type"=> "template",
									  "altText"=> "this is a confirm template",
									  "template"=> array(
										  "type"=> "confirm",
										  "text"=> "ท่านต้องการขอใช้น้ำประปา(รายใหม่)?",
										  "actions"=> 

												  array(
													"type"=> "message",
													"label"=> "ใช่",
													"text"=> "#ขอใช้น้ำประปากปภ."
												  ),
												  array(
													"type"=> "message",
													"label"=> "ไม่",
													"text"=> "ไม่"
												  )
												  
											  )
									  )
									)
									*/

							   )
							);
						}

						else if ($split[0] == 'out'){

						   $client->replyMessage1($event['replyToken'],array(
									array(
											"type"=> "location",
											"title"=> "ตำแหน่งของท่าน",
											"address"=> $address,
											"latitude"=> $latitude,
											"longitude"=> $longitude
									),
									array(
											'type' => 'text',
											'text' => 'ไม่อยู่ในพื้นที่ให้บริการของกปภ.'		
									)

							   )
							);
						}


						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}

						//update-----------------------------------//
						//$_id = '59fb2268bd966f7657da67cc';
						$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

						$newupdate = json_encode(
							array(
								//'$set' => array('lineid'=> $uid),
								//'$set' => array('name'=> $obj->displayName),
								//'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

								//'$set' => array('user_id'=> '-'),
								//'$set' => array('pwacode'=> '-'),
								//'$set' => array('manage_db'=> 'no'),
								//'$set' => array('chk_db'=> 'no'),

								//'$set' => array('pwaarea'=> 'no'),
								//'$set' => array('weather'=> 'no'),
								//'$set' => array('other'=> 'no'),

								//'$set' => array('lat'=> '-'),
								//'$set' => array('lng'=> '-'),


								'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
								//'$set' => array('status'=> 'add_friend'),
								'$set' => array('pwaarea'=> 'no')
							)
						);

						$optsu = array(
							'http' => array(
								'method' => "PUT",
								'header' => "Content-type: application/json",
								'content' => $newupdate
							)
						);

						$contextu = stream_context_create($optsu);
						$returnValup = file_get_contents($url_up, false, $contextu);
						






					}

					else if ($str == 'notfound'){

					}


				}
				if($rec->weather != 'no'){


						$url = 'https://api.airvisual.com/v2/nearest_city?lat='.$latitude.'&lon='.$longitude.'&key=271d36a7-3efd-4a54-9864-554ea6203750';
						
						//$url = 'https://api.airvisual.com/v2/nearest_city?lat=13.829582090333&lon=100.69883982127&key=271d36a7-3efd-4a54-9864-554ea6203750';

						//$url = 'https://api.airvisual.com/v2/nearest_city?key=271d36a7-3efd-4a54-9864-554ea6203750';
						//$url = 'https://api.airvisual.com/v2/city?city=Mueang%20Nonthaburi&state=Nonthaburi&country=Thailand&key=271d36a7-3efd-4a54-9864-554ea6203750';

						//$url = 'https://api.airvisual.com/v2/city?city=Mueang Nonthaburi&state=Nonthaburi&country=Thailand&key=271d36a7-3efd-4a54-9864-554ea6203750';

						$ch = curl_init();
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_URL, $url);
						$result = curl_exec($ch);
						curl_close($ch);
						$obj = json_decode($result);



						$city = $obj->data->city;
						$temp = $obj->data->current->weather->tp;
						$aqi =  intval($obj->data->current->pollution->aqius);
						$icon = "https://gispwa.herokuapp.com/image/".$obj->data->current->weather->ic.".png";

						$level;
						$face;
						$color;
						$bgcolor;
							if ($aqi < 50) {
								$level = "Good";
								$face = "https://gispwa.herokuapp.com/image/ic-face-green.png"; 
								$color = "#718b3a";
								$bgcolor = "#a8e05f";
							} 
							
							else if ($aqi < 100) {
								$level = "Moderate";
								$face = "https://gispwa.herokuapp.com/image/ic-face-yellow.png";
								$color = "#a57f23";
								$bgcolor = "#fdd74b";
							} 
							
							else if ($aqi < 150) {
								$level = "Unhealthy for Sensitive Groups";
								$face = "https://gispwa.herokuapp.com/image/ic-face-orange.png";
								$color = "#b25826";
								$bgcolor = "#fe9b57";
							} 
							
							else if ($aqi < 200) {
								$level = "Unhealthy";
								$face = "https://gispwa.herokuapp.com/image/ic-face-red.png";
								$color = "#af2c3b";
								$color = "#fe6a69";
							} 
							
							else if ($aqi < 300) {
								$level = "Very Unhealthy";
								$face = "https://gispwa.herokuapp.com/image/ic-face-purple.png";
								$color = "#634675";
								$bgcolor = "#a97abc";
							} 
							
							else {
								$level = "Hazardous";
								$face = "https://gispwa.herokuapp.com/image/ic-face-maroon.png";
								$color = "#683e51";
								$bgcolor = "#a87383";
							}



						//const city = $res.data.city;
						//const temp = $res.data.current.weather.tp;
						//const AQI = $res.data.current.pollution.aqius;

						
						//				var level = "";
						//					if (AQI < 50) {
						//					  level = "Good";  //https://www.iqair.com/assets/aqi/ic-face-green.svg 
						//					} else if (AQI < 100) {
						//					  level = "Moderate"; //https://www.iqair.com/assets/aqi/ic-face-yellow.svg
						//					} else if (AQI < 150) {
						//					  level = "Unhealthy for Sensitive Groups"; //https://www.iqair.com/assets/aqi/ic-face-orange.svg
						//					} else if (AQI < 200) {
						//					  level = "Unhealthy"; //https://www.iqair.com/assets/aqi/ic-face-red.svg
						//					} else if (AQI < 300) {
						//					  level = "Very Unhealthy"; //https://www.iqair.com/assets/aqi/ic-face-purple.svg
						//					} else {
						//					  level = "Hazardous"; //https://www.iqair.com/assets/aqi/ic-face-maroon.svg
						//					}
							

						//				.aqi-green{color:#718b3a;background:#a8e05f}
						//				.aqi-yellow{color:#a57f23;background:#fdd74b}
						//				.aqi-orange{color:#b25826;background:#fe9b57}
						//				.aqi-red{color:#af2c3b;background:#fe6a69}
						//				.aqi-opera-mauve{color:#634675;background:#a97abc}
						//				.aqi-mauve-taupe{color:#683e51;background:#a87383}
						//				.aqi-who-blue{color:#375c70;background:#60accb}


						//				.aqi-bg-light-green{background:#b0e867}
						//				.aqi-bg-light-yellow{background:#ffdf58}
						//				.aqi-bg-light-orange{background:#ffa968}
						//				.aqi-bg-light-red{background:#ff7978}
						//				.aqi-bg-light-opera-mauve{background:#b283c5}
						//				.aqi-bg-light-mauve-taupe{background:#b17c8c}

						//				.aqi-bg-light-who-blue{background:#6cb4d2}
						


						//Description			Name		Icon
						//clear sky (day)		01d.png		https://airvisual.com/images/01d.png
						//clear sky (night)		01n.png		https://airvisual.com/images/01n.png
						//few clouds (day)		02d.png		https://airvisual.com/images/02d.png
						//few clouds (night)	02n.png		https://airvisual.com/images/02n.png
						//scattered clouds		03d.png		https://airvisual.com/images/03d.png
						//broken clouds			04d.png		https://airvisual.com/images/04d.png
						//shower rain			09d.png		https://airvisual.com/images/09d.png
						//rain (day time)		10d.png		https://airvisual.com/images/10d.png
						//rain (night time)		10n.png		https://airvisual.com/images/10n.png
						//thunderstorm			11d.png		https://airvisual.com/images/11d.png
						//snow					13d.png		https://airvisual.com/images/13d.png
						//mist					50d.png		https://airvisual.com/images/50d.png

						//const message = `City: ${city}\nTemperature: ${temp}\nAQI: ${AQI}\nLevel: ${level}`;
						
						
						
						//				{"status":"success","data":{"city":"Bangkok","state":"Bangkok","country":"Thailand","location":{"type":"Point","coordinates":[100.4888394,13.7292915]},"current":{"weather":{"ts":"2020-03-29T08:00:00.000Z","tp":35,"pr":1007,"hu":50,"ws":5.1,"wd":200,"ic":"02d"},"pollution":{"ts":"2020-03-29T08:00:00.000Z","aqius":102,"mainus":"p2","aqicn":51,"maincn":"p2"}}}}
						//
						//{"status":"success","data":{"city":"Mueang Nonthaburi","state":"Nonthaburi","country":"Thailand","location":{"type":"Point","coordinates":[100.51477,13.86075]},"current":{"weather":{"ts":"2020-03-29T08:00:00.000Z","tp":35,"pr":1007,"hu":50,"ws":5.1,"wd":200,"ic":"02d"},"pollution":{"ts":"2020-03-29T09:00:00.000Z","aqius":111,"mainus":"p2","aqicn":56,"maincn":"p2"}}}}
						


						
						//				"ts": "2017-02-01T03:00:00.000Z",  //timestamp
						//				"aqius": 21, //AQI value based on US EPA standard
						//				"aqicn": 7, //AQI value based on China MEP standard
						//				"tp": 8, //temperature in Celsius
						//				"tp_min": 6, //minimum temperature in Celsius
						//				"pr": 976,  //atmospheric pressure in hPa
						//				"hu": 100, //humidity %
						//				"ws": 3, //wind speed (m/s)
						//				"wd": 313, //wind direction, as an angle of 360° (N=0, E=90, S=180, W=270)
						//				"ic": "10n" //weather icon code, see below for icon index
						//
						//				"units": { //object containing units information
						//				  "p2": "ugm3", //pm2.5
						//				  "p1": "ugm3", //pm10
						//				  "o3": "ppb", //Ozone O3
						//				  "n2": "ppb", //Nitrogen dioxide NO2 
						//				  "s2": "ppb", //Sulfur dioxide SO2 
						//				  "co": "ppm" //Carbon monoxide CO 
						//				}

						/*
						$a = array(
									array(
										'type' => 'text',
										'text' => 'อยู่ระหว่างปรับปรุงระบบครับ'.$obj->data->city       
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
						*/		

						$a = array(
									/*array(
										'type' => 'text',
										'text' => $city.$temp.$aqi.$icon.$level.$face			

									),*/
									array(
										'type' => 'flex',
										'altText' => 'Air Quality',
										'contents'=> array(
										
										  "type"=> "bubble",
										  "header"=> array(
											"type"=> "box",
											"layout"=> "horizontal",
											"contents"=> array(
											  array(
												"type"=> "text",
												"text"=> $city,
												"color"=> "#414141",
												"gravity"=> "center",
												"size"=> "xl",
												"wrap"=> true,
												"flex"=> 3
											  ),
											  array(
												"type"=> "image",
												"url"=> $icon,
												"size"=> "xs",
												"flex"=> 1
											  ),
											  array(
												"type"=> "text",
												"text"=> "22 °C",
												"color"=> "#414141",
												"size"=> "lg",
												"align"=> "end",
												"gravity"=> "center",
												"flex"=> 1
											  )
											)
										  ),
										  "body"=> array(
											"type"=> "box",
											"layout"=> "vertical",
											"contents"=> array(
											  array(
												"type"=> "box",
												"layout"=> "horizontal",
												"contents"=> array(
												  array(
													"type"=> "image",
													"url"=> $face,
													"size"=> "md",
													"align"=> "start"
												  ),
												  array(
													"type"=> "text",
													"text"=> $level,
													"wrap"=> true,
													"size"=> "lg",
													"color"=> $color,
													"gravity"=> "center"
												  )
												),
												"margin"=> "xxl"
											  ),
											  array(
												"type"=> "box",
												"layout"=> "baseline",
												"contents"=> array(
												  array(
													"type"=> "text",
													"text"=> strval($aqi),
													"color"=> $color,
													"size"=> "5xl",
													"align"=> "center"
												  ),
												  array(
													"type"=> "text",
													"text"=> "US AQI",
													"color"=> $color,
													"size"=> "xs",
													"margin"=> "sm"
												  )
												)
											  )
											)
										  ),
										  "styles"=> array(
											"body"=> array(
											  "backgroundColor"=> $bgcolor
											)
										  )
										

										)
									)
									
						);
						$client->replyMessage1($event['replyToken'],$a);
						
	

						
						//				$text_reply = $obj->status.'\n'.$obj->data->city.'\n'.$obj->data->current->weather->tp.'\n'.$obj->data->current->pollution->aqius;
						//
						//				$messages = [
						//				'type' => 'text',
						//				'text' => $text_reply
						//				];
						









						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}

						//update-----------------------------------//
						//$_id = '59fb2268bd966f7657da67cc';
						$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

						$newupdate = json_encode(
							array(
								//'$set' => array('lineid'=> $uid),
								//'$set' => array('name'=> $obj->displayName),
								//'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

								//'$set' => array('user_id'=> '-'),
								//'$set' => array('pwacode'=> '-'),
								//'$set' => array('manage_db'=> 'no'),
								//'$set' => array('chk_db'=> 'no'),

								//'$set' => array('pwaarea'=> 'no'),
								//'$set' => array('weather'=> 'no'),
								//'$set' => array('other'=> 'no'),

								//'$set' => array('lat'=> '-'),
								//'$set' => array('lng'=> '-'),


								'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
								//'$set' => array('status'=> 'add_friend'),
								'$set' => array('weather'=> 'no')
							)
						);

						$optsu = array(
							'http' => array(
								'method' => "PUT",
								'header' => "Content-type: application/json",
								'content' => $newupdate
							)
						);

						$contextu = stream_context_create($optsu);
						$returnValup = file_get_contents($url_up, false, $contextu);
						






				}
				if($rec->other != 'no'){


						//query-คำถามที่เคยถามในdb----------------------------------//
						$json_f = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
						$q_json_f = json_decode($json_f); 
						$q_json_id = $q_json_f[0]->_id;
						$q_json_oid = '';
						foreach ($q_json_id as $k=>$v){
							$q_json_oid = $v; // etc.
						}

						//update-----------------------------------//
						//$_id = '59fb2268bd966f7657da67cc';
						$url_up = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line/'.$q_json_oid.'?apiKey='.$api_key;

						$newupdate = json_encode(
							array(
								//'$set' => array('lineid'=> $uid),
								//'$set' => array('name'=> $obj->displayName),
								//'$set' => array('originalContentUrl'=> 'https://obs.line-apps.com/'.$pathpic[1]),

								//'$set' => array('user_id'=> '-'),
								//'$set' => array('pwacode'=> '-'),
								//'$set' => array('manage_db'=> 'no'),
								//'$set' => array('chk_db'=> 'no'),

								//'$set' => array('pwaarea'=> 'no'),
								//'$set' => array('weather'=> 'no'),
								//'$set' => array('other'=> 'no'),

								//'$set' => array('lat'=> '-'),
								//'$set' => array('lng'=> '-'),


								'$set' => array('datetime'=> date("Y-m-d h:i:sa")),
								//'$set' => array('status'=> 'add_friend'),
								'$set' => array('other'=> 'no')
							)
						);

						$optsu = array(
							'http' => array(
								'method' => "PUT",
								'header' => "Content-type: application/json",
								'content' => $newupdate
							)
						);

						$contextu = stream_context_create($optsu);
						$returnValup = file_get_contents($url_up, false, $contextu);
						


				}

			}
		}
		else{

		}





    }


  //}//endif group
}
//----------------------------จบฟังก์ชั่น ReplyMessage----------------------------------//
 
 
 
 
//------listen--$client->parseEvents()----และเข้าฟังก์ชั่น replyMsg--------//
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    replyMsg($event, $client);                  
                    break;
                case 'image':
                    replyMsg($event, $client);                  
                    break;
                case 'sticker':
                    replyMsg($event, $client);                  
                    break;
                case 'location':
                    replyMsg($event, $client);                  
                    break;
                case 'video':
                    replyMsg($event, $client);                  
                    break;
                case 'audio':
                    replyMsg($event, $client);                  
                    break;
                case 'file':
                    replyMsg($event, $client);                  
                    break;

                default:
                    //error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
		case 'follow':
			replyMsg1($event, $client);                  
			break;
		case 'unfollow':
			replyMsg1($event, $client);                  
			break;
		case 'join':
			replyMsg1($event, $client);                  
			break;
		case 'leave':
			replyMsg1($event, $client);                  
			break;
		case 'memberJoined':
			replyMsg1($event, $client);                  
			break;
		case 'memberLeft':
			replyMsg1($event, $client);                  
			break;
		case 'postback':
			replyMsg1($event, $client);                  
			break;
		case 'beacon':
			replyMsg1($event, $client);                  
			break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
//----------------------------------------------------------//
 










function tp_get_token($id) 
{

		$fullurl = 'https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token';

        $AccessToken = 'BwGlN2OsLJCMUF/YoAdKJR5GwQYCxU3BLTIPkMLLPC1IjVPH-S2LhD_P0R~GiPKA=JOP8N7MeY1U1ArA3X$LAQ0XfOiVsVxVUO2';
 
        $header = array(
            "Content-Type: application/json",
            'Authorization: Token '.$AccessToken,
        );
 
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt( $ch, CURLOPT_POST, 1); //POST 
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$token = json_decode($returned);

		//echo $id;
		//echo '<br>';
		//echo  $token->token;
		//echo '<br>';
        //return($token->token);

		$res = tp_get_track($token->token,$id);
		return $res;
}

function tp_get_track($token_,$id_) 
{
		/*
		echo 'Id: '.$id_;
		echo '<br>';
		echo 'token: '.$token_;
		echo '<br>';
		*/


		$fullurl = 'https://trackapi.thailandpost.co.th/post/api/v1/track';

		//$token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJzZWN1cmUtYXBpIiwiYXVkIjoic2VjdXJlLWFwcCIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJleHAiOjE1OTM0OTY5ODAsInJvbCI6WyJST0xFX1VTRVIiXSwiZCpzaWciOnsicCI6InpXNzB4IiwicyI6bnVsbCwidSI6Ijg2OTYwNzY1MWI3YzMyNjQ1YjBiZmE3ZGFjZDA0ZmUzIiwiZiI6InhzeiM5In19.34nYYgfNSySA7cBsRomI7nO97FsPZEs7lB-Am-u3iQBXno4Bbk7T9YVGX8bIiRh8XaoZzTqQUIHt2o7OwpuAvA';

        $header = array(
            "Content-Type: application/json",
            'Authorization: Token '.$token_
        );
 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1); //POST 
        //curl_setopt($ch, CURLOPT_FAILONERROR, 0);

		//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
		//curl_setopt($ch, CURLOPT_TIMEOUT, 6000); //timeout in seconds

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$data_string = json_encode(array(
									'status' => 'all',
									'language' => 'TH',
									'barcode' => array($id_)
									//'barcode' => array("EB315050240TH","EB315050240TH")
						));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$obj = json_decode($returned);
		return $obj;




			//return($returned);

			/*
				{
					"response": {
						"items": {
							"EB315050240TH": [{
								"barcode": "EB315050240TH",
								"status": "103",
								"status_description": "รับฝาก",
								"status_date": "28/05/2563 14:36:00+07:00",
								"location": "สมุทรปราการ",
								"postcode": "10270",
								"delivery_status": null,
								"delivery_description": null,
								"delivery_datetime": null,
								"receiver_name": null,
								"signature": null
							}, {
								"barcode": "EB315050240TH",
								"status": "201",
								"status_description": "อยู่ระหว่างการขนส่ง",
								"status_date": "28/05/2563 16:31:23+07:00",
								"location": "สมุทรปราการ",
								"postcode": "10270",
								"delivery_status": null,
								"delivery_description": null,
								"delivery_datetime": null,
								"receiver_name": null,
								"signature": null
							}, {
								"barcode": "EB315050240TH",
								"status": "201",
								"status_description": "อยู่ระหว่างการขนส่ง",
								"status_date": "29/05/2563 00:30:59+07:00",
								"location": "ศป.EMS",
								"postcode": "10020",
								"delivery_status": null,
								"delivery_description": null,
								"delivery_datetime": null,
								"receiver_name": null,
								"signature": null
							}, {
								"barcode": "EB315050240TH",
								"status": "206",
								"status_description": "ถึงที่ทำการไปรษณีย์",
								"status_date": "29/05/2563 09:19:37+07:00",
								"location": "จรเข้บัว",
								"postcode": "10230",
								"delivery_status": null,
								"delivery_description": null,
								"delivery_datetime": null,
								"receiver_name": null,
								"signature": null
							}, {
								"barcode": "EB315050240TH",
								"status": "301",
								"status_description": "อยู่ระหว่างการนำจ่าย",
								"status_date": "29/05/2563 09:34:54+07:00",
								"location": "จรเข้บัว",
								"postcode": "10230",
								"delivery_status": null,
								"delivery_description": null,
								"delivery_datetime": null,
								"receiver_name": null,
								"signature": null
							}, {
								"barcode": "EB315050240TH",
								"status": "501",
								"status_description": "นำจ่ายสำเร็จ",
								"status_date": "29/05/2563 10:23:23+07:00",
								"location": "จรเข้บัว",
								"postcode": "10230",
								"delivery_status": "S",
								"delivery_description": "ผู้รับได้รับสิ่งของเรียบร้อยแล้ว",
								"delivery_datetime": "29/05/2563 10:23:23+07:00",
								"receiver_name": "40 ราม 14 /ผู้รับรับเอง",
								"signature": "https://trackimage.thailandpost.co.th/f/signature/QDUwMjQwYjVzMGx1VDMz/QGI1c0VCMGx1VDMx/QGI1czBsVEh1VDM0/QGI1czBsdTMxNTBUMzI="
							}]
						},
						"track_count": {
							"track_date": "30/05/2563",
							"count_number": 6,
							"track_count_limit": 1000
						}
					},
					"message": "successful",
					"status": true
				}


			       รหัส	สถานะ
			  101	เตรียมการฝากส่ง
			  102	รับฝากผ่านตัวแทน
			  103	รับฝาก
			  201	อยู่ระหว่างการขนส่ง
			  202	ดำเนินพิธีการศุลกากร
			  203	ส่งคืนต้นทาง
			  301	อยู่ระหว่างการนำจ่าย
			  302	นำจ่าย ณ จุดรับสิ่งของ
			  401	นำจ่ายไม่สำเร็จ
			  501	นำจ่ายสำเร็จ
			  204	ถึงที่ทำการแลกปลี่ยนระหว่างประเทศขาออก
			  205	ถึงที่ทำการแลกปลี่ยนระหว่างประเทศขาเข้า
			  206	ถึงที่ทำการไปรษณีย์
			  207	เตรียมการขนส่ง




			status					String	สถานะ
			status_description		String	คำอธิบายสถานะ
			status_date				String	สถานะของวันที่
			location				String	สถานที่ตั้ง
			postcode				String	รหัสไปรษณีย์
			delivery_status			Int		สถานะการจัดส่ง

			delivery_description	Int		คำอธิบายการจัดส่ง
			delivery_datetime		Int		วันที่จัดส่ง
			receiver_name			Int		ชื่อผู้รับ
			signature				Int		ลายเซ็น
			barcode					String	หมายเลขสิ่งของ
			message					String	ข้อความตอบกลับ

			*/
}


















?>
