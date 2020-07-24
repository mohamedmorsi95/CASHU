<?php
/**
 * developed by mohamed Elznary
 * 23/7/2020
*/

require_once("headers.php");
require_once("config.php");
require_once("helperFun.php");

//providers objects
require_once("providers/BestHotels.php");
require_once("providers/TopHotels.php");



//----------------------------------------------------------------
//TODO Perform login checking 
/* 
    Perform login checking
    if not Athorized http_response(401);
*/
//----------------------------------------------------------------
//get Params 
$params = getPostedInputs();


//providers object instantiations
$BestHotels = new BestHotels($params);
$TopHotels  = new TopHotels($params);

//get Hotels from providers
$BestHotelsArray = $BestHotels->getHotels();
$TopHotelsArray  = $TopHotels->getHotels();

$Hotels = array_merge(
    $BestHotelsArray,
    $TopHotelsArray
);

//arrange hotels according its rate
usort($Hotels,"hotelsSort");

//remove any unnecessary data 
foreach($Hotels as $key=>$hotel){
  unset($Hotels[$key][HOTEL_RATE]);
}


echo json_encode($Hotels,JSON_UNESCAPED_UNICODE);

?>