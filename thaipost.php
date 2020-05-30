<?php

	  $token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJzZWN1cmUtYXBpIiwiYXVkIjoic2VjdXJlLWFwcCIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJleHAiOjE1OTM0OTY5ODAsInJvbCI6WyJST0xFX1VTRVIiXSwiZCpzaWciOnsicCI6InpXNzB4IiwicyI6bnVsbCwidSI6Ijg2OTYwNzY1MWI3YzMyNjQ1YjBiZmE3ZGFjZDA0ZmUzIiwiZiI6InhzeiM5In19.34nYYgfNSySA7cBsRomI7nO97FsPZEs7lB-Am-u3iQBXno4Bbk7T9YVGX8bIiRh8XaoZzTqQUIHt2o7OwpuAvA';

function tp_get_token($id) 
{
		//echo $id;

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
		echo  $token->token;
		echo '<br>';
        //return($token->token);


		tp_get_track($token->token,$id);
}

function tp_get_track($accesstoken,$id_) 
{

		echo $id_;
		echo '<br>';
		echo $accesstoken;

		$fullurl = 'https://trackapi.thailandpost.co.th/post/api/v1/track';

		$token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJzZWN1cmUtYXBpIiwiYXVkIjoic2VjdXJlLWFwcCIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJleHAiOjE1OTM0OTY5ODAsInJvbCI6WyJST0xFX1VTRVIiXSwiZCpzaWciOnsicCI6InpXNzB4IiwicyI6bnVsbCwidSI6Ijg2OTYwNzY1MWI3YzMyNjQ1YjBiZmE3ZGFjZDA0ZmUzIiwiZiI6InhzeiM5In19.34nYYgfNSySA7cBsRomI7nO97FsPZEs7lB-Am-u3iQBXno4Bbk7T9YVGX8bIiRh8XaoZzTqQUIHt2o7OwpuAvA';

        $header = array(
            "Content-Type: application/json",
            'Authorization: Token '.$token
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
									'barcode' => array("EB315050240TH")
									//'barcode' => array("EB315050240TH","EB315050240TH")
						));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$obj = json_decode($returned);

		//echo 'result'.$obj->response->items->[0]->[-1]->barcode;
		echo '<br>';
		echo $obj->status;
		echo '<br>';
		echo $obj->message;

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



tp_get_token('EB315050240TH');

?>
