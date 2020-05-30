<?php

			else if ($text == '#flex') {

				$messages = [
					'type' => 'flex',
					'altText' => 'This is a Flex Message',
					'contents'=> [

						  "type"=> "bubble",
						  "header"=> [
							"type"=> "box",
							"layout"=> "vertical",
							"contents"=> [
							  [
								"type"=> "box",
								"layout"=> "horizontal",
								"contents"=> [
								  [
									"type"=> "image",
									"url"=> "https=>//scdn.line-apps.com/n/channel_devcenter/img/flexsnapshot/clip/clip4.jpg",
									"size"=> "lg",
									"aspectMode"=> "cover",
									"aspectRatio"=> "150=>66",
									"gravity"=> "center",
									"flex"=> 1
								  ],
								  [
									"type"=> "box",
									"layout"=> "horizontal",
									"contents"=> [
									  [
										"type"=> "text",
										"text"=> "NEW",
										"size"=> "xs",
										"color"=> "#ffffff",
										"align"=> "center",
										"gravity"=> "center"
									  ]
									],
									"backgroundColor"=> "#EC3D44",
									"paddingAll"=> "2px",
									"paddingStart"=> "4px",
									"paddingEnd"=> "4px",
									"flex"=> 0,
									"position"=> "absolute",
									"offsetStart"=> "18px",
									"offsetTop"=> "18px",
									"cornerRadius"=> "100px",
									"width"=> "48px",
									"height"=> "25px"
								  ]
								]
							  ]
							],
							"paddingAll"=> "0px"
						  ],
						  "body"=> [
							"type"=> "box",
							"layout"=> "vertical",
							"contents"=> [
							  [
								"type"=> "box",
								"layout"=> "vertical",
								"contents"=> [
								  [
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> [
									  [
										"type"=> "text",
										"contents"=> [],
										"size"=> "xl",
										"wrap"=> true,
										"text"=> "Cony Residence",
										"color"=> "#ffffff",
										"weight"=> "bold"
									  ],
									  [
										"type"=> "text",
										"text"=> "3 Bedrooms, ¥35,000",
										"color"=> "#ffffffcc",
										"size"=> "sm"
									  ]
									],
									"spacing"=> "sm"
								  ],
								  [
									"type"=> "box",
									"layout"=> "vertical",
									"contents"=> [
									  [
										"type"=> "box",
										"layout"=> "vertical",
										"contents"=> [
										  [
											"type"=> "text",
											"contents"=> [],
											"size"=> "sm",
											"wrap"=> true,
											"margin"=> "lg",
											"color"=> "#ffffffde",
											"text"=> "Private Pool, Delivery box, Floor heating, Private Cinema"
										  ]
										]
									  ]
									],
									"paddingAll"=> "13px",
									"backgroundColor"=> "#ffffff1A",
									"cornerRadius"=> "2px",
									"margin"=> "xl"
								  ]
								]
							  ]
							],
							"paddingAll"=> "20px",
							"backgroundColor"=> "#464F69"
						  ]



					]
				];
				
			}


				else if (preg_match('(#ลงทะเบียน_เก่า|#register_old)', $msg) === 1) {

					$api_key="zCxIftNnbizcCTl61rydbRWUcFevJ5TR";
					$url = 'https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key;

					//$lineid_encode = urlencode($uid);
					$json_cmsg = file_get_contents('https://api.mlab.com/api/1/databases/linedb/collections/db_line?apiKey='.$api_key.'&q={"lineid":"'.$uid.'"}');
					$q_msg = json_decode($json_cmsg); 
					if($q_msg){
						foreach($q_msg as $rec){

							/*
							$messages = [
							'type' => 'text',
							'text' => $rec->status
							];
							*/


							//$uid = $event['source']['userId'];
							$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;

							$a = array(
										array(
											'type' => 'flex',
											'altText' => 'This is a Flex Message',
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
																								'label'=> "Register",
																								'uri'=> $str
																							   )
																				  )
																			)
																)
														)
											)
									);

							$client->replyMessage1($event['replyToken'],$a);


						}
					}
					else{
						/*
						$messages = [
						'type' => 'text',
						'text' => 'ผมไม่ฟังคำสั่งของคนแปลกหน้าหรอกครับ'
						];
						*/

						$a = array(				
									array(
										'type' => 'text',
										'text' => 'ผมไม่ฟังคำสั่งของคนแปลกหน้าหรอกครับ'
									)
							);
						$client->replyMessage1($event['replyToken'],$a);


					}
				}


				/*
				else if( $msg == '#ลงทะเบียน'){ 
				 
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
				*/
 
				else if (preg_match('(#flex0|flex0)', $msg) === 1) {

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
						

						$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
						$a = array(
								array(
									'type' => 'flex',
									'altText' => 'Air Quality',
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
												"align"=> "start"
											  ),
											  array(
												"type"=> "text",
												"text"=> $nameid,
												"wrap"=> true,
												"size"=> "lg",
												"color"=> "#a57f23",
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
												"text"=> "85",
												"color"=> "#a57f23",
												"size"=> "5xl",
												"align"=> "center"
											  ),
											  array(
												"type"=> "text",
												"text"=> "US AQI",
												"color"=> "#a57f23",
												"size"=> "xs",
												"margin"=> "sm"
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
														'label'=> "Register",
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
										)
									  )

									/* เอามาจากflex*/

									)
								)
						);
						$client->replyMessage1($event['replyToken'],$a);

												
					}
                }
				else if (preg_match('(#flex1|flex2)', $msg) === 1) {

					$str ='https://gisweb1.pwa.co.th/lineservice/line_register/register.php?id='.$uid;
					$a = array(
							array(
								'type' => 'flex',
								'altText' => 'Air Quality',
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
									  array(
										"type"=> "box",
										"layout"=> "baseline",
										"contents"=> array(
										  array(
											"type"=> "text",
											"text"=> "85",
											"color"=> "#a57f23",
											"size"=> "5xl",
											"align"=> "center"
										  ),
										  array(
											"type"=> "text",
											"text"=> "US AQI",
											"color"=> "#a57f23",
											"size"=> "xs",
											"margin"=> "sm"
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
													'label'=> "Register",
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
									)
								  )

								/* เอามาจากflex*/

								)
							)
					);
                    $client->replyMessage1($event['replyToken'],$a);
 
                }
				else if (preg_match('(#flex5|flex6)', $msg) === 1) {

                    $gid = $event['source']['groupId'];
                    $uid = $event['source']['userId'];
					$nameid='nutty';
					$iconUrl='https://upload.wikimedia.org/wikipedia/commons/0/05/Facebook_Logo_%282019%29.png';

					/*
					$urllink = 'https://gispwa.herokuapp.com/gis-pwa.php';
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
						'send' => 'register',
						'nameid' => $nameid,
						'uid' => $uid,
						'iconUrl' => $iconUrl
					  );
					$params = http_build_query($values);
					curl_setopt($chl, CURLOPT_POSTFIELDS,$params); 
					$res = curl_exec($chl);		
					curl_close($chl);
					*/

					$urllink = 'https://gispwa.herokuapp.com/gis-pwa.php?send=register&nameid='.$nameid.'&iconUrl='.$iconUrl.'&id='.$uid;
					//$urllink = urlencode($urllink);
					$res = get_url($urllink); 



                }



			else if ($text == 'ลงทะเบียน') {
					$str ='https://gis4manager.herokuapp.com/bot/register.php?id='.$uid;
					$messages = [
						"type"=> "text",
						"text"=> $str
					];
			}


/*					
						$messages = [
							'type' => 'flex',
							'altText' => 'Air Quality',
							'contents'=> [
							/* เอามาจากflex*/
							  "type"=> "bubble",
							  "header"=> [
								"type"=> "box",
								"layout"=> "horizontal",
								"contents"=> [
								  [
									"type"=> "text",
									"text"=> "Mung Nonthaburi",
									"color"=> "#414141",
									"gravity"=> "center",
									"size"=> "xl",
									"wrap"=> true,
									"flex"=> 3
								  ],
								  [
									"type"=> "image",
									"url"=> "https://airvisual.com/images/01d.png",
									"size"=> "xs",
									"flex"=> 1
								  ],
								  [
									"type"=> "text",
									"text"=> "22 °C",
									"color"=> "#414141",
									"size"=> "lg",
									"align"=> "end",
									"gravity"=> "center",
									"flex"=> 1
								  ]
								]
							  ],
							  "body"=> [
								"type"=> "box",
								"layout"=> "vertical",
								"contents"=> [
								  [
									"type"=> "box",
									"layout"=> "horizontal",
									"contents"=> [
									  [
										"type"=> "image",
										"url"=> "https://www.iqair.com/assets/aqi/ic-face-green.svg",
										"size"=> "md",
										"align"=> "start"
									  ],
									  [
										"type"=> "text",
										"text"=> "Moderate",
										"wrap"=> true,
										"size"=> "lg",
										"color"=> "#a57f23",
										"gravity"=> "center"
									  ]
									],
									"margin"=> "xxl"
								  ],
								  [
									"type"=> "box",
									"layout"=> "baseline",
									"contents"=> [
									  [
										"type"=> "text",
										"text"=> "85",
										"color"=> "#a57f23",
										"size"=> "5xl",
										"align"=> "center"
									  ],
									  [
										"type"=> "text",
										"text"=> "US AQI",
										"color"=> "#a57f23",
										"size"=> "xs",
										"margin"=> "sm"
									  ]
									]
								  ]
								]
							  ],
							  "styles"=> [
								"body"=> [
								  "backgroundColor"=> "#fdd74b"
								]
							  ]
							/* เอามาจากflex*/

							]
						];
*/


?>
