//<?php
//echo "hello i'm teresa"
//$json_str=file_get_contents('php://input');//接收request的body
//$json_obj=json_decode($json_str); //轉json格式

//?>
<?php
 $json_str = file_get_contents('php://input'); //�𦻖�𤣰REQUEST��BODY
 $json_obj = json_decode($json_str); //頧�JSON�聢撘�

 //�𤩎��笔�𧼮�喟策line server���聢撘�
 $sender_userid = $json_obj->events[0]->source->userId;
 $sender_txt = $json_obj->events[0]->message->text;
 $response = array (
				"to" => $sender_userid,
				"messages" => array (
					array (
						"type" => "text",
						"text" => "Hello, YOU SAY ".$sender_txt
					)
				)
		);

 $myfile = fopen("log.txt","w+") or die("Unable to open file!"); //閮剖�帋��嚯og.txt �鍂靘��㫲閮𦠜��
 fwrite($myfile, "\xEF\xBB\xBF".json_encode($response)); //�銁摮𦯀葡��滚�惩�功xEF\xBB\xBF頧㗇�鈎tf8�聢撘�
 fclose($myfile);

 //��𧼮�喟策line server
 $header[] = "Content-Type: application/json";
 $header[] = "Authorization: Bearer n4mZIQp9UqWXhCEgIg1fLmyjUeDMgCe/bF+4EOBDZ7fGscOgNGFsHTr3fGco/E7A5hq7A7jiDszSCk/j3pVVPbx7nf0E+FKe5jX6syQGOxO7kwp5lmZ3zRES1qxceq/N+/E9Qy5gSDbBx56l8sScTwdB04t89/1O/w1cDnyilFU=";
 $ch = curl_init("https://api.line.me/v2/bot/message/push");                                                                      
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
 curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));                                                                  
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                                                   
 $result = curl_exec($ch);
 curl_close($ch); 

?>
