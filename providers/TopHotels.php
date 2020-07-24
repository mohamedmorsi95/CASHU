<?php
/**
 * developed by mohamed Elznary
 * 23/7/2020
*/

class TopHotels{

   //provider consts
   private $providerUrl  = "fakeTopHotels.json";
   private $providerName = "TopHotels";

   //define provider paramter keys 
   private $FROM_DATA_KEY     = "from";
   private $TO_DATA_KEY       = "to";
   private $CITY_KEY          = "city";
   private $ADULTS_NUMBER_KEY = "adultsCount";

   //define provider response Keys
   private $HOTEL_NAME_KEY       = "hotelName";
   private $HOTEL_RATE_KEY       = "rate";
   private $HOTEL_FARE_KEY       = "price";
   private $HOTEL_AMENITIES_KEY  = "amenities";
   private $HOTEL_DISCOUNT_KEY   =  "discount";

   /**
    * @param $parameters  , the parameters and values of ourHotels request 
   */

   private $from_data;
   private $to_data;
   private $city;
   private $number_of_adults;

   function __construct($parameters){

       $this->from_data = $parameters[FROM_DATE];
       $this->to_data   = $parameters[TO_DATE];
       $this->city      = $parameters[CITY];
       $this->number_of_adults = $parameters[ADULTS_NUMBER];

       //$this->convertDate();
   }

   /**
    * @return $hotels array of hotles given by provider 
    */
   public function getHotels(){
       
       $Hotels = array();


       /**
        * TODO use CURL to get call provider on another orgin ;
       */        
       //get hotle by file_get_contans
       $responseString = file_get_contents($this->providerUrl);
       $responseJson   = json_decode($responseString,TRUE);

       //refactor Hotles given by provider 
       foreach($responseJson as $hotel){
           $newHotel = array();

           $newHotel[PROVIDER]         = $this->providerName;
           $newHotel[HOTEL_NAME]       = $hotel[$this->HOTEL_NAME_KEY];
           $newHotel[HOTEL_AMENITIES]  = $hotel[$this->HOTEL_AMENITIES_KEY];

           //get rate in integer 
           $newHotel[HOTEL_RATE]       =    $this->convertRate($hotel[$this->HOTEL_RATE_KEY]);

           //get fare for one night
           if(isset($hotel[$this->HOTEL_DISCOUNT_KEY])){
            $newHotel[HOTEL_FARE]       = $hotel[$this->HOTEL_FARE_KEY]-$hotel[$this->HOTEL_DISCOUNT_KEY];
           }else{
            $newHotel[HOTEL_FARE]       = $hotel[$this->HOTEL_FARE_KEY];
           }
          

           $Hotels[] = $newHotel;
       }
       
       return $Hotels;

   }


   /**
    * @return string paramter string for request 
    */
    private function getParamterString(){
       return $this->FROM_DATA_KEY."=".$this->from_data."&".$this->TO_DATA_KEY."=".$this->to_data."&".$this->CITY_KEY."=".$this->city."&".$this->ADULTS_NUMBER_KEY."=".$this->number_of_adults;
   }


   /**
    * convert date from ISO_LOCAL_DATE to ISO_INSTANT
    */
    private function convertDate(){

        //TODO Convert from ISO_LOCAL_DATE To ISO_INSTANT
    }

   /**
    * convert rate frome "*" to integer
    * @param string $rate rate in "*" format
    * @return integer $rate rate  in integer format
    */
    private function convertRate($rate){
        $ar = explode('*',$rate);
        return count($ar)-1;
    }


}

?>