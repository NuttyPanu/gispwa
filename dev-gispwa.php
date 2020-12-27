<?php

//---------------bot--------------------///
$access_token = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';

$channelAccessToken = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';

$channelSecret = '011df6d8948d564b5c2550d9c4c15a8e';

//---------------bot--------------------///


date_default_timezone_set('Asia/Bangkok');
header('Content-Type: text/html; charset=utf-8');

@ini_set('display_errors', '0'); //ไม่แสดงerror



// for test debug file
require_once('LINEBotTiny.php');


$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$botName = "BOT";

emoji('รู้สึกดีมากๆเลยครับ');

function emoji($input){

    $fullurl = "https://api.aiforthai.in.th/emoji?text=".urlencode($input);

    $header = array(
        "Apikey: NUCyyo4koUbIFFkqxYehuyB4YSJsxFEP"
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

        echo $returned;
        return($returned);	
	
}






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

function get_profile($fullurl) 
{
        $channelAccessToken2 = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';
 
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
if ( $_GET['send'] == 'text' )
{
	$text = array(
			'type' => 'text',
			'text' => $_GET['text']
		);
	$uid = $_GET['id'];
	$client->pushMessage($uid, $text);
}
//-----------auto send----push message------------------//


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

			if (preg_match('(#สถานการณ์โควิด|#สรุปโควิด)', $text) === 1) {

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

			else if (preg_match('(ทดสอบ|เพื่อน|เพื่อนกัน)', $text) === 1) {
				//$gid = $event['source']['groupId'];
				$uid = $event['source']['userId'];

				$url = 'https://api.line.me/v2/bot/profile/'.$uid;
				//$url ='https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
				$profile = get_profile($url);
				$obj = json_decode($profile);

				$nameid = $obj->displayName;
				$status = $obj->statusMessage;
				$pathpic = explode("cdn.net/", $obj->pictureUrl);

				if ($nameid){

					$messages = [
					'type' => 'text',
					'text' => 'เพื่อนกันตลอดไป',
					'sender' => [
						'name' => $nameid,
						'iconUrl' => 'https://obs.line-apps.com/'.$pathpic[1]
					]
					];

				}
				else{
					$messages = [
					'type' => 'text',
					'text' => 'ใครอ่ะๆ ไม่เห็นรู้จัก'
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

			else if(preg_match('(สวัสดี|สวัสดีครับ|สวัสดีค่ะ)', $text) === 1) {	

					$gid = $event['source']['groupId'];
					$uid = $event['source']['userId'];


					//$url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid; //กลุ่ม
					$url = 'https://api.line.me/v2/bot/profile/'.$uid;			//user
					$channelAccessToken2 = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';

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


//----------------------------จบฟังก์ชั่น ReplyMessage----------------------------------//
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


			/*
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
			*/

	}
	else if ($event['type'] == 'unfollow') {

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
	else if ($event['type'] == 'join') {

		$a = array(
					array(
						'type' => 'text',
						'text' => 'ขอบคุณที่รับผมเข้ากลุ่มครับ'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'leave') {

		$a = array(
					array(
						'type' => 'text',
						'text' => 'โดนถีบออกจากกลุ่ม'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'memberJoined') {

		$a = array(
					array(
						'type' => 'text',
						'text' => 'ฮัลโหลๆ แนะนำตัวหน่อย สมาชิกใหม่'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'memberLeft') {

		$a = array(
					array(
						'type' => 'text',
						'text' => 'RIP. เสียใจด้วย คุณไม่ได้ไปต่อ'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'postback') {

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
 

            $ty = $event['source']['type']; //user,group
 

                if (preg_match('(เสียใจ|ร้องไห้|ไม่ต้องร้อง|ผิดหวัง)', $msg) === 1) {
                    $a = array(
                                array(
                                    'type' => 'sticker',
                                    'packageId' => 2,
                                    'stickerId' => 152
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
                }
 
                else if (preg_match('(ขี้|อึ|ห้องน้ำ)', $msg) === 1) {
 
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
 
			    else if (preg_match('(#ดุ๊กดิ๊ก|#ดุ้กดิ้ก|#ดุกดิก|#ดุ๊กดิ้ก|#ดุ้กดิ๊ก)', $msg) === 1) {

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


                else if (preg_match('(บอทครับ|บอทคะ|บอทคับ|ดีบอท|สวัสดีครับบอท|สวัสดีบอท|หวัดดีบอท)', $msg) === 1) {
 
                    if ($ty == 'user'){
 
                        $url = 'https://api.line.me/v2/bot/profile/'.$uid;
                        $channelAccessToken2 = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';
 
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
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $ty. ' '.$uid. ' '. $gid. ' '.$profile
                          //    )
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => 'สวัสดีคุณ '.$obj->displayName.' type='.$ty.' uid='.$uid.' gid='.$gid
                          //    )
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $obj->statusMessage
                          //    ),
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $obj->pictureUrl
                          //    )
                            );
                        $client->replyMessage1($event['replyToken'],$a);
 
                    }
 
                    else if ($ty == 'group'){
 
 
                        $gid = $event['source']['groupId'];
                        $uid = $event['source']['userId'];
 
                        $url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
                        //$url = 'https://api.line.me/v2/bot/profile/'.$uid;
                        $channelAccessToken2 = 'pSlitTchKOu193nO2l8NaHhu+qRmGliLz05YWFaUr1/2Qlj3zMKJhmDnXJN272zI14TrsxanzahU9cd45SBJC0Yf+onQIveOUQtlrk2YSilIzq3u+MlIhZZvN0XdWPA2plt1Ks4rfo4SoCNR6is9ewdB04t89/1O/w1cDnyilFU=';
 
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
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $ty. ' '.$uid. ' '. $gid. ' '.$profile
                          //    )
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => 'สวัสดีคุณ '.$obj->displayName.' type='.$ty.' uid='.$uid.' gid='.$gid
                          //    )
                          //,
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $obj->statusMessage
                          //    ),
                          //    array(
                          //        'type' => 'text',
                          //        'text' => $obj->pictureUrl
                          //    )
                            );
                        $client->replyMessage1($event['replyToken'],$a);
 
                    }
 
                }
 

				else if (preg_match('(#forcast|#forcast)', $msg) === 1) {

					$stat = 0;

					$split = explode("#forcast", $msg);

					$prv = trim($split[1]);

					if(!$prv || $prv ==''){
						$t = "โปรดระบุชื่อ จังหวัด เช่น
						\n #forcast กรุงเทพมหานคร'
						";
						
						$a = array(
									array(
										'type' => 'text',
										'text' => $t
									)
								);
						$client->replyMessage1($event['replyToken'],$a);
					}

					else {

						$fullurl = 'https://data.tmd.go.th/api/WeatherForecast7Days/V1/';
						 
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

							//if(preg_match('(กรุงเทพ|กรุงเทพมหานคร)', $key->ProvinceNameTh) === 1){
							if(preg_match("'".$prv."'", $key->ProvinceNameTh) === 1){
								$stat =1;

								$d1='-';$w1='-';$ma1='-';$mi1='-';$r1='-';
								$d2='-';$w2='-';$ma2='-';$mi2='-';$r2='-';
								$d3='-';$w3='-';$ma3='-';$mi3='-';$r3='-';
								$d4='-';$w4='-';$ma4='-';$mi4='-';$r4='-';
								$d5='-';$w5='-';$ma5='-';$mi5='-';$r5='-';
								$d6='-';$w6='-';$ma6='-';$mi6='-';$r6='-';
								$d7='-';$w7='-';$ma7='-';$mi7='-';$r7='-';

								$count = count($key->SevenDaysForecast);


								/*
								for ($x = 0; $x < $count; $x++) {
								  //echo "The number is: $x <br>";
									"$d".($x+1) = $key->SevenDaysForecast[$x]->Date; 
									"$w".($x+1) = $key->SevenDaysForecast[$x]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									"$ma".($x+1) = $key->SevenDaysForecast[$x]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									"$mi".($x+1) = $key->SevenDaysForecast[$x]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									"$r".($x+1) = $key->SevenDaysForecast[$x]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
								}							
								
								if($count < 7){

									for ($x = $count+1; $x <= 7; $x++) {
									  //echo "The number is: $x <br>";
										"$d".$x = '-'; 
										"$w".$x = '-'; 
										//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
										"$ma".$x = '-'; 
										//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
										"$mi".$x = '-'; 
										//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
										"$r".$x = '-'; 
										//$key->SevenDaysForecast[0]->Rain->Unit; 
									}	

								}
								*/

								if($count >= 7){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
									$d3 = $key->SevenDaysForecast[2]->Date; 
									$w3 = $key->SevenDaysForecast[2]->WeatherDescription; 
									//$key->SevenDaysForecast[2]->WeatherDescriptionEn; 
									$ma3 = $key->SevenDaysForecast[2]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[2]->MaxTemperature->Unit; 
									$mi3 = $key->SevenDaysForecast[2]->MinTemperature->Value; 
									//$key->SevenDaysForecast[2]->MinTemperature->Unit; 
									$r3 = $key->SevenDaysForecast[2]->Rain->Value; 
									//$key->SevenDaysForecast[2]->Rain->Unit;
									$d4 = $key->SevenDaysForecast[3]->Date; 
									$w4 = $key->SevenDaysForecast[3]->WeatherDescription; 
									//$key->SevenDaysForecast[3]->WeatherDescriptionEn; 
									$ma4 = $key->SevenDaysForecast[3]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[3]->MaxTemperature->Unit; 
									$mi4 = $key->SevenDaysForecast[3]->MinTemperature->Value; 
									//$key->SevenDaysForecast[3]->MinTemperature->Unit; 
									$r4 = $key->SevenDaysForecast[3]->Rain->Value; 
									//$key->SevenDaysForecast[3]->Rain->Unit;
									$d5 = $key->SevenDaysForecast[4]->Date; 
									$w5 = $key->SevenDaysForecast[4]->WeatherDescription; 
									//$key->SevenDaysForecast[4]->WeatherDescriptionEn; 
									$ma5 = $key->SevenDaysForecast[4]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[4]->MaxTemperature->Unit; 
									$mi5 = $key->SevenDaysForecast[4]->MinTemperature->Value; 
									//$key->SevenDaysForecast[4]->MinTemperature->Unit; 
									$r5 = $key->SevenDaysForecast[4]->Rain->Value; 
									//$key->SevenDaysForecast[4]->Rain->Unit;
									$d6 = $key->SevenDaysForecast[5]->Date; 
									$w6 = $key->SevenDaysForecast[5]->WeatherDescription; 
									//$key->SevenDaysForecast[5]->WeatherDescriptionEn; 
									$ma6 = $key->SevenDaysForecast[5]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[5]->MaxTemperature->Unit; 
									$mi6 = $key->SevenDaysForecast[5]->MinTemperature->Value; 
									//$key->SevenDaysForecast[5]->MinTemperature->Unit; 
									$r6 = $key->SevenDaysForecast[5]->Rain->Value; 
									//$key->SevenDaysForecast[5]->Rain->Unit;
									$d7 = $key->SevenDaysForecast[6]->Date; 
									$w7 = $key->SevenDaysForecast[6]->WeatherDescription; 
									//$key->SevenDaysForecast[6]->WeatherDescriptionEn; 
									$ma7 = $key->SevenDaysForecast[6]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[6]->MaxTemperature->Unit; 
									$mi7 = $key->SevenDaysForecast[6]->MinTemperature->Value; 
									//$key->SevenDaysForecast[6]->MinTemperature->Unit; 
									$r7 = $key->SevenDaysForecast[6]->Rain->Value; 
									//$key->SevenDaysForecast[6]->Rain->Unit;
								}	
								else if($count == 6){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
									$d3 = $key->SevenDaysForecast[2]->Date; 
									$w3 = $key->SevenDaysForecast[2]->WeatherDescription; 
									//$key->SevenDaysForecast[2]->WeatherDescriptionEn; 
									$ma3 = $key->SevenDaysForecast[2]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[2]->MaxTemperature->Unit; 
									$mi3 = $key->SevenDaysForecast[2]->MinTemperature->Value; 
									//$key->SevenDaysForecast[2]->MinTemperature->Unit; 
									$r3 = $key->SevenDaysForecast[2]->Rain->Value; 
									//$key->SevenDaysForecast[2]->Rain->Unit;
									$d4 = $key->SevenDaysForecast[3]->Date; 
									$w4 = $key->SevenDaysForecast[3]->WeatherDescription; 
									//$key->SevenDaysForecast[3]->WeatherDescriptionEn; 
									$ma4 = $key->SevenDaysForecast[3]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[3]->MaxTemperature->Unit; 
									$mi4 = $key->SevenDaysForecast[3]->MinTemperature->Value; 
									//$key->SevenDaysForecast[3]->MinTemperature->Unit; 
									$r4 = $key->SevenDaysForecast[3]->Rain->Value; 
									//$key->SevenDaysForecast[3]->Rain->Unit;
									$d5 = $key->SevenDaysForecast[4]->Date; 
									$w5 = $key->SevenDaysForecast[4]->WeatherDescription; 
									//$key->SevenDaysForecast[4]->WeatherDescriptionEn; 
									$ma5 = $key->SevenDaysForecast[4]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[4]->MaxTemperature->Unit; 
									$mi5 = $key->SevenDaysForecast[4]->MinTemperature->Value; 
									//$key->SevenDaysForecast[4]->MinTemperature->Unit; 
									$r5 = $key->SevenDaysForecast[4]->Rain->Value; 
									//$key->SevenDaysForecast[4]->Rain->Unit;
									$d6 = $key->SevenDaysForecast[5]->Date; 
									$w6 = $key->SevenDaysForecast[5]->WeatherDescription; 
									//$key->SevenDaysForecast[5]->WeatherDescriptionEn; 
									$ma6 = $key->SevenDaysForecast[5]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[5]->MaxTemperature->Unit; 
									$mi6 = $key->SevenDaysForecast[5]->MinTemperature->Value; 
									//$key->SevenDaysForecast[5]->MinTemperature->Unit; 
									$r6 = $key->SevenDaysForecast[5]->Rain->Value; 
									//$key->SevenDaysForecast[5]->Rain->Unit;
								}
								else if($count == 5){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
									$d3 = $key->SevenDaysForecast[2]->Date; 
									$w3 = $key->SevenDaysForecast[2]->WeatherDescription; 
									//$key->SevenDaysForecast[2]->WeatherDescriptionEn; 
									$ma3 = $key->SevenDaysForecast[2]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[2]->MaxTemperature->Unit; 
									$mi3 = $key->SevenDaysForecast[2]->MinTemperature->Value; 
									//$key->SevenDaysForecast[2]->MinTemperature->Unit; 
									$r3 = $key->SevenDaysForecast[2]->Rain->Value; 
									//$key->SevenDaysForecast[2]->Rain->Unit;
									$d4 = $key->SevenDaysForecast[3]->Date; 
									$w4 = $key->SevenDaysForecast[3]->WeatherDescription; 
									//$key->SevenDaysForecast[3]->WeatherDescriptionEn; 
									$ma4 = $key->SevenDaysForecast[3]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[3]->MaxTemperature->Unit; 
									$mi4 = $key->SevenDaysForecast[3]->MinTemperature->Value; 
									//$key->SevenDaysForecast[3]->MinTemperature->Unit; 
									$r4 = $key->SevenDaysForecast[3]->Rain->Value; 
									//$key->SevenDaysForecast[3]->Rain->Unit;
									$d5 = $key->SevenDaysForecast[4]->Date; 
									$w5 = $key->SevenDaysForecast[4]->WeatherDescription; 
									//$key->SevenDaysForecast[4]->WeatherDescriptionEn; 
									$ma5 = $key->SevenDaysForecast[4]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[4]->MaxTemperature->Unit; 
									$mi5 = $key->SevenDaysForecast[4]->MinTemperature->Value; 
									//$key->SevenDaysForecast[4]->MinTemperature->Unit; 
									$r5 = $key->SevenDaysForecast[4]->Rain->Value; 
									//$key->SevenDaysForecast[4]->Rain->Unit;
								}
							
								else if($count == 4){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
									$d3 = $key->SevenDaysForecast[2]->Date; 
									$w3 = $key->SevenDaysForecast[2]->WeatherDescription; 
									//$key->SevenDaysForecast[2]->WeatherDescriptionEn; 
									$ma3 = $key->SevenDaysForecast[2]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[2]->MaxTemperature->Unit; 
									$mi3 = $key->SevenDaysForecast[2]->MinTemperature->Value; 
									//$key->SevenDaysForecast[2]->MinTemperature->Unit; 
									$r3 = $key->SevenDaysForecast[2]->Rain->Value; 
									//$key->SevenDaysForecast[2]->Rain->Unit;
									$d4 = $key->SevenDaysForecast[3]->Date; 
									$w4 = $key->SevenDaysForecast[3]->WeatherDescription; 
									//$key->SevenDaysForecast[3]->WeatherDescriptionEn; 
									$ma4 = $key->SevenDaysForecast[3]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[3]->MaxTemperature->Unit; 
									$mi4 = $key->SevenDaysForecast[3]->MinTemperature->Value; 
									//$key->SevenDaysForecast[3]->MinTemperature->Unit; 
									$r4 = $key->SevenDaysForecast[3]->Rain->Value; 
									//$key->SevenDaysForecast[3]->Rain->Unit;
								}
								else if($count == 3){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
									$d3 = $key->SevenDaysForecast[2]->Date; 
									$w3 = $key->SevenDaysForecast[2]->WeatherDescription; 
									//$key->SevenDaysForecast[2]->WeatherDescriptionEn; 
									$ma3 = $key->SevenDaysForecast[2]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[2]->MaxTemperature->Unit; 
									$mi3 = $key->SevenDaysForecast[2]->MinTemperature->Value; 
									//$key->SevenDaysForecast[2]->MinTemperature->Unit; 
									$r3 = $key->SevenDaysForecast[2]->Rain->Value; 
									//$key->SevenDaysForecast[2]->Rain->Unit;
								}
								else if($count == 2){
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
									$d2 = $key->SevenDaysForecast[1]->Date; 
									$w2 = $key->SevenDaysForecast[1]->WeatherDescription; 
									//$key->SevenDaysForecast[1]->WeatherDescriptionEn; 
									$ma2 = $key->SevenDaysForecast[1]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[1]->MaxTemperature->Unit; 
									$mi2 = $key->SevenDaysForecast[1]->MinTemperature->Value; 
									//$key->SevenDaysForecast[1]->MinTemperature->Unit; 
									$r2 = $key->SevenDaysForecast[1]->Rain->Value; 
									//$key->SevenDaysForecast[1]->Rain->Unit; 
								}

								else if($count == 1){							
									//$key->ProvinceNameTh;
									//$key->ProvinceNameEnglish;
									$d1 = $key->SevenDaysForecast[0]->Date; 
									$w1 = $key->SevenDaysForecast[0]->WeatherDescription; 
									//$key->SevenDaysForecast[0]->WeatherDescriptionEn; 
									$ma1 = $key->SevenDaysForecast[0]->MaxTemperature->Value; 
									//$key->SevenDaysForecast[0]->MaxTemperature->Unit; 
									$mi1 = $key->SevenDaysForecast[0]->MinTemperature->Value; 
									//$key->SevenDaysForecast[0]->MinTemperature->Unit; 
									$r1 = $key->SevenDaysForecast[0]->Rain->Value; 
									//$key->SevenDaysForecast[0]->Rain->Unit; 
								}

								

						
								$a = array(
										array(
											'type' => 'text',
											//'text' => $count.'|'.$d1.'|'.$d2.'|'.$d3.'|'.$d4.'|'.$d5.'|'.$d6.'|'.$d7

											'text' => "โปรดรอสักครู่ ระบบกำลังประมวลผล..."
											//'text' => $key->SevenDaysForecast[0]->Date.'-'.$key->SevenDaysForecast[1]->Date.'-'.$key->SevenDaysForecast[2]->Date.'-'.$key->SevenDaysForecast[3]->Date.'-'.$key->SevenDaysForecast[4]->Date.'-'.$key->SevenDaysForecast[5]->Date.'-'.$key->SevenDaysForecast[6]->Date
								
										),
										array(
											'type' => 'flex',
											'altText' => 'weather_forcast',
											'contents'=> array(

													  "type"=> "bubble",
													  "size"=> "giga",
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
																"text"=> "จังหวัด".$key->ProvinceNameTh,
																"align"=> "start",
																"gravity"=> "center",
																"weight"=> "bold",
																"size"=> "lg"
															  )
															),
															"paddingStart"=> "10px",
															"paddingTop"=> "5px"
														  ),
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "image",
																"url"=> "https://gispwa.herokuapp.com/image/weather.jpg",
																"size"=> "full",
																"aspectRatio"=> "3:1",
																"aspectMode"=> "cover",
																"align"=> "center",
																"gravity"=> "center"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> "7 days",
																	"size"=> "sm",
																	"color"=> "#ffffff",
																	"align"=> "start",
																	"gravity"=> "center"
																  )
																),
																"backgroundColor"=> "#EC3D44",
																"paddingAll"=> "2px",
																"paddingStart"=> "10px",
																"paddingEnd"=> "10px",
																"position"=> "absolute",
																"offsetStart"=> "18px",
																"cornerRadius"=> "50px",
																"height"=> "20px",
																"width"=> "62px",
																"offsetTop"=> "18px"
															  )
															),
															"offsetTop"=> "5px"
														  )
														),
														"paddingAll"=> "0px"
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
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> "วันที่",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> "สภาพอากาศ",
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> "อุณหภูมิ",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> "ฝน",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	),
																	"paddingTop"=> "3px"
																  )
																)
															  )
															),
															"backgroundColor"=> "#000000"
														  ),
						
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d1,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w1,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma1."/".$mi1."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r1."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d2,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w2,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma2."/".$mi2."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r2."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),								  
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d3,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w3,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma3."/".$mi3."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r3."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),													  
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d4,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w4,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma4."/".$mi4."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r4."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d5,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w5,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma5."/".$mi5."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r5."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d6,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w6,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma6."/".$mi6."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r6."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),
														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "box",
																"layout"=> "horizontal",
																"contents"=> array(
																  array(
																	"type"=> "box",
																	"layout"=> "horizontal",
																	"contents"=> array(
																	  array(
																		"type"=> "text",
																		"text"=> $d7,
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $w7,
																		"flex"=> 3,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $ma7."/".$mi7."°C",
																		"flex"=> 2,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  ),
																	  array(
																		"type"=> "text",
																		"text"=> $r7."%",
																		"flex"=> 1,
																		"color"=> "#ffffff",
																		"align"=> "center"
																	  )
																	)
																  )
																)
															  )
															)
														  ),

														  array(
															"type"=> "box",
															"layout"=> "vertical",
															"contents"=> array(
															  array(
																"type"=> "text",
																"text"=> " ss",
																"color"=> "#000000"
															  )
															),
															"backgroundColor"=> "#000000",
															"height"=> "10px"
														  ),
														
														  array(
															"type"=> "box",
															"layout"=> "horizontal",
															"contents"=> array(
															  
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d1,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma1."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi1."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r1."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d2,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma2."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi2."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r2."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),														  
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d3,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma3."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi3."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r3."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d4,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma4."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi4."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r4."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d5,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma5."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi5."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r5."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d6,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma6."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi6."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r6."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  ),
															  array(
																"type"=> "box",
																"layout"=> "vertical",
																"contents"=> array(
																  array(
																	"type"=> "text",
																	"text"=> $d7,
																	"size"=> "xxs",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"gravity"=> "center",
																	"wrap"=> true
																  ),
																  array(
																	"type"=> "image",
																	"url"=> "https://gispwa.herokuapp.com/image/icon_w.png",
																	"size"=> "xs"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $ma7."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $mi7."°C",
																	"color"=> "#ffffff",
																	"align"=> "center",
																	"size"=> "xxs",
																	"gravity"=> "center"
																  ),
																  array(
																	"type"=> "text",
																	"text"=> $r7."%",
																	"color"=> "#ffffff",
																	"size"=> "xxs",
																	"align"=> "center",
																	"gravity"=> "center"
																  )
																),
																"spacing"=> "xs"
															  )
															),
															"paddingTop"=> "10px"
														  )
														  
														),
														"backgroundColor"=> "#464F69",
														"paddingEnd"=> "2px",
														"paddingStart"=> "2px",
														"paddingTop"=> "10px"
													  )

											)
										)
										
								);
								$client->replyMessage1($event['replyToken'],$a);
								


								break;


							}
							else{
								continue;
							}




						}

						if ($stat == 0){

							$a = array(
										array(
											'type' => 'text',
											'text' => 'โปรดระบุชื่อจังหวัดให้ถูกต้อง'
										)
									);
							$client->replyMessage1($event['replyToken'],$a);

						}

					}


				}

				else if ($msg == '#คุณภาพอากาศ') {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];

							$a = array(
										array(
											'type' => 'text',
											'text' => 'โปรดแชร์ Location เพื่อตรวจสอบคุณภาพอากาศ'      
										)
									);
							$client->replyMessage1($event['replyToken'],$a);


				}
				else if (preg_match('(#track|#track)', $msg) === 1) {

					$split = explode("#track", $msg);

					$id = trim($split[1]);


					if(strlen($id) != 13){

						$t = "โปรดระบุเลขพัสดุให้ถูกต้อง
						\n #track EN123456789TH
						";

						$a = array(
									array(
										'type' => 'text',
										'text' => $t
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

									$txt =	'เลขพัสดุ: '.$value[count($value)-1]->barcode.'
									 '.'สถานะ: '.$value[count($value)-1]->status_description.'
									 '.'สถานที่: '.$value[count($value)-1]->location.'
									 '.'วันที่: '.$value[count($value)-1]->status_date.'
									 '.'สถานะการรับ: '.$value[count($value)-1]->delivery_description.'
									 '.'วันที่รับ: '.$value[count($value)-1]->delivery_datetime.'
									 '.'ผู้รับ: '.$value[count($value)-1]->receiver_name;
											
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


				// ยังไม่เสร็จ-----------------------------//
				else if (preg_match('(#เตือน|#เตือน)', $msg) === 1) {
					$ugid;
					if($event['source']['groupId']){
									   $ugid = $event['source']['groupId'];
					}
					else{
									   $ugid = $event['source']['userId'];
					}
					
					$message = '';
					$memo_=array(
						"29-05-2020"=>"เงินเดือนออกนะครับ (29 ธ.ค. 63) ",
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

                    $a = array(
                                array(
                                    'type' => 'text',
                                    'text' => $message          
                                )
                            );
                    $client->replyMessage1($event['replyToken'],$a);
				}


                else{
 

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

		$weather ='y';

			//improve

				if($weather == 'y'){
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
										  "size"=> "mega",// giga,mega,kilo,macro,nano defult:mega
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
						
					$weather ='n';

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
//------listen--$client->parseEvents()----และเข้าฟังก์ชั่น replyMsg--------//
 

?>




