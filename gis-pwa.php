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

			if ($text == 'EGA' || $text == 'ega') {

				$messages = [
				'type' => 'text',
				'text' => 'สำนักงานรัฐบาลอิเล็กทรอนิกส์ (องค์การมหาชน) : EGA เปลี่ยนชื่อเป็น สำนักงานพัฒนารัฐบาลดิจิทัล (องค์การมหาชน) (ใช้ชื่อย่อ "สพร.") และเปลี่ยนชื่อภาษาอังกฤษเป็น "Digital Government Development Agency (Public Organization)" (ย่อว่า "DGA")'
				];

			}



			else if (preg_match('(ทดสอบ|ทดสอบ)', $text) === 1) {

				if (chk_friend($uid) == true){
					$gid = $event['source']['groupId'];
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
					'text' => 'แน่นอน เราเพื่อนกัน-'.chk_friend($uid),
					'sender' => [
						'name' => $nameid,
						'iconUrl' => 'https://obs.line-apps.com/'.$pathpic[1]
					]
					];

				}
				else{
					$messages = [
					'type' => 'text',
					'text' => 'โปรดเพิ่มผมเป็นเพื่อนก่อนนะครับ-'.chk_friend($uid),
					];

				}





			}
			else if ($text == 'วัน') {
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
			else if ($text == 'ลงทะเบียน') {
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

			else if (preg_match('(เช็ค|check)', $text) === 1) {

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
 



			else if($event['source']['groupId'] == 'pwa_GIS' || $event['source']['groupId'] == 'GIS' || $event['source']['groupId'] == 'Dev'){
				if (preg_match('(หิวจัง|หิวแล้ว|หิวมาก|หิวจุง|หิว)', $text) === 1) {

					$messages = [
					'type' => 'text',
					'text' => 'หิวหรอ ... พี่ต๊อบครับ ลูกชิ้น หมู:5 เนื้อ:5 ไส้กรอกชีส(เยิ้มๆ):5 ให้ไวนะครับ...มีคนหิว เก็บเงินหัวหน้าได้เลยครับ'
					];

				}
			}

			else if ($text == 'ตรวจสอบพื้นที่ให้บริการ') {

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
	


			else if (preg_match('(วิธีการเพิ่มสิทธิ์|วิธีเพิ่มสิทธิ์)', $text) === 1) {
				$text_reply = "วิธีการเพิ่มสิทธิ์ระบบติดตามมาตรวัดน้ำ 
				\n ใช้คีย์เวิร์ดในการเพิ่ม ดังนี้ #เพิ่มสิทธิ์ หรือ #เพิ่มสิทธิ์มาตร หรือ #เพิ่มสิทธิ์ระบบมาตร หรือ #เพิ่มสิทธิ์ระบบมาตรฯ 
				\n ***(เพิ่มสิทธิ์ได้มากสุด ครั้งละไม่เกิน 59 user)
				\n ตัวอย่างการเพิ่มสิทธิ์
				\n  1.กรณีเพิ่มสิทธิ์ 1 คน => #เพิ่มสิทธิ์ 12974
				\n  2.กรณีเพิ่มสิทธิ์ มากกว่า 1 คน => #เพิ่มสิทธิ์ 12974 12975 12976
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


			else if ($text == 'ลงทะเบียน') {
					$str ='https://gis4manager.herokuapp.com/bot/register.php?id='.$uid;
					$messages = [
						"type"=> "text",
						"text"=> $str
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




			else if ($text == 'id') {
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


			$t=array("Unfriendเราทำไม","โดนบล็อคแล้ว");
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
						'text' => 'ขอบคุณที่รับผมเข้ากลุ่ม'            
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

}


function replyMsg($event, $client)
{
  //if($event['source']['groupId'] == 'Cbb266cca8a0e0b7ae940dec7f3dc15dc' || $event['source']['groupId'] == 'C0258185eadd1aef77466dfb30d189e56' || $event['source']['userId'] == 'Ud28e6a312cb9816218fc44edef9c2f3d'){
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
 
 
                if (preg_match('(หวัดดี|หวัดดีค่ะ|หวัดดีครับ|ดีค่ะ|ดีคับ|ดีครับ|สวัสดีบอท|หวัดดีบอท|บอท)', $msg) === 1) {
 
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




					$urllink = 'https://gisweb1.pwa.co.th/meterstat/service/user_line.php';
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

				else if(preg_match('(#ลบสิทธิ|#เพิ่มสิทธิ์|#ลบสิทธิ์มาตร|#ลบสิทธิ์ระบบมาตร|#ลบสิทธิ์ระบบมาตรฯ)', $msg) === 1) {

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




					$urllink = 'https://gisweb1.pwa.co.th/meterstat/service/user_line.php';
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

				elseif( $msg == '#ลงทะเบียน'){ 
				 
					$uid = $event['source']['userId'];
					$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
		 
					$a = array(
							 array(
                       "type"=> "imagemap",
                       "baseUrl"=> "https://gispwasys.herokuapp.com/image/register/rich",
                       "altText"=> "this is an imagemap",
                       "baseSize"=> array(
                         "height"=> 1040,
                         "width"=> 1040
                        ),
                       "actions"=> array ( 
                           array(
                            "type"=> "uri",
                            "linkUri"=> $str,
                            "area"=> 
                            array(
                             "x"=> 0,
                             "y"=> 520,
                             "width"=> 1040,
                             "height"=> 520
                            )
                           ),
                           array(
                            "type"=> "message",
                            "text"=> "hello",
                            "area"=> 
                                array(
                             "x"=> 0,
                             "y"=> 0,
                             "width"=> 1040,
                             "height"=> 520
									)
								   )	  
						   )     
						)
							 
					);

					$client->replyMessage1($event['replyToken'],$a);
						 
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
 

				else if (preg_match('(อัพโหลดภาพ|Gps|เช็คgps|เช็คGps|เช็ค Gps)', $msg) === 1) {

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
 
 
 
    //-----ถ้ามีการส่งสติ๊กเกอร์------------------------------------------------------------//
    elseif ($event['type'] == 'message' && $event['message']['type'] == 'sticker') {


		$sticker=array("2,149","2,23","3,239","2,154","2,161","3,232","2,24","1,115","2,152","4,616","4,296","2,165","4,279","2,525","2,19","2,527");
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
							  "type"=> "template",
							  "altText"=> "this is a confirm template",
							  "template"=> array(
								  "type"=> "confirm",
								  "text"=> "ท่านต้องการขอใช้น้ำประปา(รายใหม่)?",
								  "actions"=> 

									  array (
										  array(
											"type"=> "message",
											"label"=> "ใช่",
											"text"=> "ใช่"
										  ),
										  array(
											"type"=> "message",
											"label"=> "ไม่",
											"text"=> "ไม่"
										  )
									  )
							  )
							)

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

			}

			else if ($str == 'notfound'){

			}


    }


  //}//endif
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

        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};
//----------------------------------------------------------//
 
 





?>
