<?php



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
        return($returned);
}

function tp_get_track($code) 
{

		$fullurl = 'https://trackapi.thailandpost.co.th/post/api/v1/track';

        $AccessToken = tp_get_token();
 
        $header = array(
            "Content-Type: application/json",
            'Authorization: Token '.$AccessToken,
        );
 
         
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_POST, 1); //POST 
        curl_setopt($ch, CURLOPT_FAILONERROR, 0);

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 6000); //timeout in seconds

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		  $params = array(
			'status' => 'all',
			'language' => 'TH',
			'barcode' => array("EB315050240TH","EB315050240TH")
			//'barcode' => array("EY145587896TH","RC338848854TH")
		  );

		curl_setopt($ch, CURLOPT_POSTFIELDS,$params); 

        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$obj = json_decode($returned);

		
		//echo $obj->response->items->[0]->barcode;
		echo '<br>';
		echo json_encode($obj);

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






echo 'pass';
tp_get_track('EB315050240TH');

?>
