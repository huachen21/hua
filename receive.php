<?php
echo "hello i'm teresa"
$json_str=file_get_contents('php://input');//接收request的body
$json_obj=json_decode($json_str); //轉json格式

?>
