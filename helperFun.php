<?php
/**
 * developed by mohamed Elznary
 * 23/7/2020
*/

/**
 * function getPostedInputs()
 * function hotelsSort($hotel1,$hotel2)
*/
////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * @return object $PostedObj, the read posted data from caller 
 */
function getPostedInputs(){
    $postedObj = $_GET;
    foreach($postedObj as $key=>$value){
    
        $value = stripslashes($value);
        $value = trim($value);
        $value = str_replace("`","",$value);//remove single quote mark, reserved for sql statement  
        $postedObj[$key] = $value;
    }
    return $postedObj;    
}//end of function getPostedInputs()
////////////////////////////////////////////////////////////////////////////////////////////////
/**
 * 
 * sort function to sort hotels according to its rate  
 */
function hotelsSort($hotel1,$hotel2){
    return $hotel1[HOTEL_RATE] - $hotel2[HOTEL_RATE];
}//end of function hotelsSort($hotel1,$hotel2)

?>