<?php

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

		tp_get_track($token->token,$id);
}

function tp_get_track($token_,$id_) 
{

		echo 'Id: '.$id_;
		echo '<br>';
		echo 'token: '.$token_;
		echo '<br>';

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
									'barcode' => array("EB315050240TH")
									//'barcode' => array("EB315050240TH","EB315050240TH")
						));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_URL, $fullurl);
         
        $returned =  curl_exec($ch);
        curl_close($ch);

		$obj = json_decode($returned);


		if($obj->status == 1 || $obj->message == 'successfull'){



			//echo 'result'.$obj->response->items->EB315050240TH;
			//echo 'result'.$obj->response->items->[0]->[-1]->barcode;
			echo '<br>';
			echo 'status: '.$obj->status; //1 = true, 0 = false
			echo '<br>';
			echo 'message: '.$obj->message; //successfull

			echo '<br>';


			foreach($obj->response->items as $key=>$value)
			{
			  //echo $key;
			  //echo '<br>';
			  //echo count($value);
			  //echo $value[5];

			  //แสดงแบบเป็นtext
			  //echo json_encode($value[count($value)-1]);

			  echo 'เลขพัสดุุ: '.$value[count($value)-1]->barcode;
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
			}

			//echo 'result: '.json_encode($obj->response->items->EB315050240TH[0]);

			//echo json_encode($obj);

		}
		else{

			//ไม่พบ

		}

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


if(strlen($_REQUEST['id']) != 13){
	echo 'โปรดระบุเลขพัสดุให้ถูกต้อง';
}
else if(substr($_REQUEST['id'],0,-12) == 'P'){
	echo 'พัสดุธรรมดา ไม่สามารถตรวจสอบสถานะได้  ตรวจสอบสถานะได้ที่ Call Center 1545';
}
else if(is_numeric(substr($_REQUEST['id'],11,13) == true )){
	echo 'เลขพัสดุของท่านไม่ถูกต้อง';
}
else if(substr($_REQUEST['id'],0,-12) == 'E' || substr($_REQUEST['id'],0,-12) == 'R'){
	if(substr($_REQUEST['id'],0,-12) == 'E'){
		echo 'พัสดุลงทะเบียน EMS';
	}
	if(substr($_REQUEST['id'],0,-12) == 'R'){
		echo 'พัสดุแบบลงทะเบียน';
	}

	tp_get_token($_REQUEST['id']);
	//EB315050240TH

else{



}



?>
