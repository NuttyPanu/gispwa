<?php

//---------------bot ilove gis-pwa--------------------///
$access_token = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';

$channelAccessToken = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';

$channelSecret = '1d50de27a0f29d9728c29ba9ccc495b0';

//---------------bot ilove gis-pwa--------------------///


date_default_timezone_set('Asia/Bangkok');
header('Content-Type: text/html; charset=utf-8');
//@ini_set('display_errors', '0'); //ไม่แสดงerror


ini_set("log_errors", 1);
ini_set("error_log", "php-error.txt");


// for test debug file
require_once('LINEBotTiny.php');


$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$botName = "BOT";

$GISPWA= 'C6c9793d99e321e4659397c52365a68d3';
$METER= 'C6cf4977144b0d1c6aa8b5be22b04272c';
$NUT='U87b618904b23471df5c43312458c016b';
$GISDEV= 'C6d63e07eb0065b5019b861f11073fc41';


$key_notify=array("Nutty"=>"OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv","GIS_DEV"=>"gPidZUfXhBA0O2rUL1o0NBUL18EWrzIvZJJhDwOPopE","GIS_PWA"=>"6quJbwJSDQzowDEohK6XNvnrLgVKsVyDYr5x2VvCPns","METER_GIS"=>"MPUAjmRP1bHVZhWsvRsEctt59w2Gx9n0sBV51wfcnaW");


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
	/*
	if($rec->status == 'add_friend'){
		return true;
	}
	else{
		return false;
	}
	*/
	return true;
}

function get_profile($fullurl) 
{
        $channelAccessToken2 = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';
 
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
						  "size"=> "mega",// giga,mega,kilo,macro,nano defult:mega
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

if ($_REQUEST['send'] == 'memo'){
	$id;
	if($_REQUEST['by'] == 'gispwa'){
        $id = "C6c9793d99e321e4659397c52365a68d3"; // gis_pwa
	}
	else if($_REQUEST['by'] == 'meter'){
        $id = "C6cf4977144b0d1c6aa8b5be22b04272c"; // METER
	}
	else if($_REQUEST['by'] == 'gisdev'){
        $id = "C6d63e07eb0065b5019b861f11073fc41"; // $GISDEV
	}
	else if($_REQUEST['by'] == 'nut'){
        $id = "U87b618904b23471df5c43312458c016b"; // $NUT
	}
	else{
		$id = "U87b618904b23471df5c43312458c016b"; // $NUT
	}

	//$key_noti =$key_notify['Nutty'];
	//$key_noti = 'OKJrnIrqpS70Vzey8aw9O3Nfa2GbD1zVgmHvbaUsmNv';//nutty
	$mหg = '';
	$memo_=array(
		"03-06-2020"=>"วันหยุดนะครับวันหยุด (3 มิ.ย. 63)",
		"05-06-2020"=>"หมด เวลา wfh แล้วนะจ๊ะ (5 มิ.ย. 63)",
		"10-06-2020"=>"มีประชุมสายงานนะครับผม (10 มิ.ย. 63) ",
	);				

	$today_ = date("d-m-Y");

	$s7d = date("d-m-Y",strtotime("+7 days",strtotime($today_)));
	$s3d = date("d-m-Y",strtotime("+3 days",strtotime($today_)));
	$s2d = date("d-m-Y",strtotime("+2 days",strtotime($today_)));
	$s1d = date("d-m-Y",strtotime("+1 days",strtotime($today_)));


	if(array_key_exists($s7d, $memo_))  // holiday;
	//else if(in_array($today, $holiday))  // holiday;
	{
		$mหg .= "เหลือเวลาอีก 7 วัน: ".$memo_[$s7d]." ";
	}
	if(array_key_exists($s3d, $memo_))  // holiday;
	//else if(in_array($today, $holiday))  // holiday;
	{
		$mหg .= "เหลือเวลาอีก 3 วัน: ".$memo_[$s3d]." ";
	}
	if(array_key_exists($s2d, $memo_))  // holiday;
	//else if(in_array($today, $holiday))  // holiday;
	{
		$mหg .= "เหลือเวลาอีก 2 วัน: ".$memo_[$s2d]." ";
	}
	if(array_key_exists($s1d, $memo_))  // holiday;
	//else if(in_array($today, $holiday))  // holiday;
	{
		$mหg .= "เหลือเวลาอีก 1 วัน: ".$memo_[$s1d]." ";
	}

	if(array_key_exists($today_, $memo_))
	{
		$mหg .= "อย่าลืมวันนี้นะ : ".$memo_[$today_]." ";
	}				

	notify($id,$mหg);
}

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

			else if (preg_match('(#ทดสอบ|#ทดสอบ)', $text) === 1) {

				if (chk_friend($event['source']['userId']) == true){
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

			//ทดสอบฟังก์ชั่น getprofile --user ต้องอัพเดทlineเป็นversionใหม่
			else if(preg_match('(สวัสดี|สวัสดีครับ|สวัสดีค่ะ)', $text) === 1) {	

					$gid = $event['source']['groupId'];
					$uid = $event['source']['userId'];

					//$uid =  'Uebffb1bffc4ccb8f823238e2c22f11ed';
					//$gid =  'Cd495e0ee56720de9b2b914dff0eabc16';

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



//-gis--
//C0258185eadd1aef77466dfb30d189e56 metergis
//Cbb266cca8a0e0b7ae940dec7f3dc15dc gis+pjoe


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
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'ขอบคุณที่เพิ่มเพื่อน'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
	}
	else if ($event['type'] == 'unfollow') {
	 //U87b618904b23471df5c43312458c016b
		$a = array(
					array(
						'type' => 'text',
						'text' => 'ขอบคุณที่บล๊อคกัน'            
					)
				);
		$client->replyMessage1($event['replyToken'],$a);
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
 

            $ty = $event['source']['type']; //user,group
 
 
			if (preg_match('(บอทครับ|บอทคะ|บอทคับ|ดีบอท|สวัสดีครับบอท|สวัสดีบอท|หวัดดีบอท)', $msg) === 1) {

				if ($ty == 'user'){

					$url = 'https://api.line.me/v2/bot/profile/'.$uid;
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

					//$uid =  'Uebffb1bffc4ccb8f823238e2c22f11ed';
					//$gid =  'Cd495e0ee56720de9b2b914dff0eabc16';
					$url = 'https://api.line.me/v2/bot/group/'.$gid.'/member/'.$uid;
					//$url = 'https://api.line.me/v2/bot/profile/'.$uid;
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




