<?php

$ipaddress = $_SERVER['REMOTE_ADDR'];
$page = "http://" . $_SERVER['HTTP_HOST'] . "" . $_SERVER['PHP_SELF'];
$useragent = $_SERVER['HTTP_USER_AGENT'];

DbOperations::insertIntoDB("INSERT INTO stats VALUES('$ipaddress', '$page', '$useragent');");
