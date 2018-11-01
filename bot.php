<?php

date_default_timezone_set('Asia/Bangkok');
header('Content-Type: text/html; charset=utf-8');
//ini_set("log_errors", 1);
//ini_set("error_log", "php-error.txt");
require_once('LINEBotTiny.php');
$access_token = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';
$channelAccessToken = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';
$channelSecret = '1d50de27a0f29d9728c29ba9ccc495b0';
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$botName = "BOT";

if ($_GET['send'] == 'push')
{
	$text = array(
			'type' => 'text',
			'text' => $_GET['text']
		);
	$uid = $_GET['id']; // id auto
	$client->pushMessage($uid, $text);
}

//---------------------------------------------------------//
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		

		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$uid = $event['source']['userId'];
			$gid = $event['source']['groupId'];
			$timestamp = $event['timestamp'];
			if(preg_match('(สวัสดี|หวัดดี|ดีค่ะ|ดีคับ|ดีครับ|ดีคร่า|ดีค่า)', $text) === 1) {	
					$gid = $event['source']['groupId'];
					$uid = $event['source']['userId'];
					//$url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid; //กลุ่ม
					$url = 'https://api.line.me/v2/bot/profile/'.$uid;			//user
					$channelAccessToken2 = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';
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
							"text" =>  "ดีครับ ".$obj->displayName
					];
			}
	
	
			else if ($text == 'id') {
				
				// Build message to reply back
				$messages = [
				'type' => 'text',
				"text" => $uid." || ".$gid
				];
			}
			

			else if(preg_match('(#1|#2)', $text) === 1){ 

				//$lineid = $uid;
				
				$split = explode("#1", $text);
				$p = $split[0];
				$s = $split[1];
				$split1 = explode("#2", $s);
				$namebuild = $split1[0];
				$address = $split1[1];

				$SESSION["namebuild"] = $namebuild;
				$SESSION["address"] = $address;	
				
				$messages = [
				'type' => 'text',
				"text" => $SESSION["namebuild"]." || ".$SESSION["address"]
				];
			}
			
			
		
			else {
			

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
		
	        //get location
	        else if ($event['type'] == 'message' && $event['message']['type'] == 'location') {
         		
		    $latitude = $event['message']['latitude'];
		    $longitude = $event['message']['longitude'];
		    $title = $event['message']['title'];
		    $address = $event['message']['address'];
		    $uid = $event['source']['userId'];

			
			//$id_t = $uid;
		    $id_t = 'Ud28e6a312cb9816218fc44edef9c2f3d';
		    //$id_t = 'C3959e1e52fb0b16f3f9d08c4ad2b0a97';			
			
		    $detail = 'ชื่อสถานที่: '.$title.' พิกัด: '.$latitude.','.$longitude.' ที่อยู่: '.$address.' แชร์ตำแหน่งโดย: '. $uid;	
			
		    $url_line = 'https://pwagis.herokuapp.com/bot.php?send=push&id='.$id_t .'&text='.urlencode($detail);
		    //echo $url_line;
		    $chOne = curl_init(); 
			curl_setopt( $chOne, CURLOPT_URL, $url_line); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt($chOne, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
			//curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
			//curl_setopt($chOne, CURLOPT_AUTOREFERER , true);
			//curl_setopt($chOne, CURLOPT_CONNECTTIMEOUT, 30);
			//curl_setopt($chl, CURLOPT_CONNECTTIMEOUT, 10);
			//curl_setopt($chl, CURLOPT_TIMEOUT , 10);

		    $result = curl_exec( $chOne ); 
		    curl_close( $chOne ); 			
			
			
			/*
		    $messages = [
			"type"=> "location",
			"title"=>  $uid,
			"address"=> $address,
			"latitude"=> $latitude,
			"longitude"=> $longitude
		    ];  
			*/
		/*
		    $messages = [
			'type' => 'text',
			"text" => 'ชื่อสถานที่: '.$title.' พิกัด: '.$latitude.','.$longitude.' ที่อยู่: '.$address.' แชร์ตำแหน่งโดย: '. $uid
		    ];	
			

		    // Get replyToken
		    $replyToken = $event['replyToken'];
		    //$replyToken = "b8d16867c3b0428dad726529876301ef";			
			
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
		*/

		}		
		
	}
}
echo "OK";
?>
