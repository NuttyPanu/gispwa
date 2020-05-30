<?php

	  $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJzZWN1cmUtYXBpIiwiYXVkIjoic2VjdXJlLWFwcCIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJleHAiOjE1OTM0OTY5ODAsInJvbCI6WyJST0xFX1VTRVIiXSwiZCpzaWciOnsicCI6InpXNzB4IiwicyI6bnVsbCwidSI6Ijg2OTYwNzY1MWI3YzMyNjQ1YjBiZmE3ZGFjZDA0ZmUzIiwiZiI6InhzeiM5In19.34nYYgfNSySA7cBsRomI7nO97FsPZEs7lB-Am-u3iQBXno4Bbk7T9YVGX8bIiRh8XaoZzTqQUIHt2o7OwpuAvA';

function tp_get_token() 
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

		$token = json_decode($AccessToken);
		//echo  $token->token;
        return($token->token);
}

function tp_get_track($token,$code) 
{

		$fullurl = 'https://trackapi.thailandpost.co.th/post/api/v1/track';




	  $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJzZWN1cmUtYXBpIiwiYXVkIjoic2VjdXJlLWFwcCIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJleHAiOjE1OTM0OTY5ODAsInJvbCI6WyJST0xFX1VTRVIiXSwiZCpzaWciOnsicCI6InpXNzB4IiwicyI6bnVsbCwidSI6Ijg2OTYwNzY1MWI3YzMyNjQ1YjBiZmE3ZGFjZDA0ZmUzIiwiZiI6InhzeiM5In19.34nYYgfNSySA7cBsRomI7nO97FsPZEs7lB-Am-u3iQBXno4Bbk7T9YVGX8bIiRh8XaoZzTqQUIHt2o7OwpuAvA';


        $header = array(
            "Content-Type: application/json",
            'Authorization: Token '.$token,
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
									'barcode' => array('EB315050240TH')));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$obj = json_decode($returned);

		echo 'result=';
		echo '<br>';
		echo $obj->status;
		echo '<br>';
		echo $obj->message;

        //return($returned);

		/*
		{
			"response": {
				"items": {
					"ED852942182TH": [
						{
							"barcode": "ED852942182TH",
							"status": "103",
							"status_description": "รับฝาก",
							"status_date": "19/07/2562 18:12:26+07:00",
							"location": "คต.กาดสวนแก้ว",
							"postcode": "00131",
							"delivery_status": null,
							"delivery_description": null,
							"delivery_datetime": null,
							"receiver_name": null,
							"signature": null
						},
						{
							"barcode": "ED852942182TH",
							"status": "201",
							"status_description": "ส่งออกจากที่ทำการกลางทาง",
							"status_date": "20/07/2562 15:12:15+07:00",
							"location": "คต.กาดสวนแก้ว",
							"postcode": "00131",
							"delivery_status": null,
							"delivery_description": null,
							"delivery_datetime": null,
							"receiver_name": null,
							"signature": null
						},...
					]
				},
				"track_count": {
					"track_date": "27/08/2562",
					"count_number": 48,
					"track_count_limit": 1500
				}
			},
			"message": "successful",
			"status": true
		}

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






echo '1. Code:pass';
echo '<br>';

//$tk = tp_get_token();

//tp_get_track($tk,'EB315050240TH');
tp_get_track($token,'EB315050240TH');
echo '<br>';
echo '2. Result: pass';
?>
