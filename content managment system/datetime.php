<?php
date_default_timezone_get("Asia/delhi");
$currenttime-time();
$datetime = strftime("%B-%d-%y-%H-%M-%S",$currenttime);
echo $datetime;

?>