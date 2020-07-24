<?php
/* comment this code when hosting */
/* un comment in development mode */

ini_set('default_charset','UTF-8');
mb_internal_encoding('UTF-8'); 
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Expose-Headers:  Authorization');
header('Access-Control-Allow-Headers :  Authorization');
header("Content-Type: text/html; application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
?>
