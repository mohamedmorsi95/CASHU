<?php
/**
 * developed by mohamed Elznary
 * 23/7/2020
*/

class BestHotels{

    //provider consts
    private $providerUrl  = "fakeBestHotels.json";
    private $providerName = "BestHotels";

    //provider paramter keys 
    private $FROM_DATA_KEY     = "fromDate";
    private $TO_DATA_KEY       = "toDate";
    private $CITY_KEY          = "city";
    private $ADULTS_NUMBER_KEY = "numberOfAdults";

    //provider response Keys
    private $HOTEL_NAME_KEY       = "hotel";
    private $HOTEL_RATE_KEY       = "hotelRate";
    private $HOTEL_FARE_KEY       = "hotelFare";
    private $HOTEL_AMENITIES_KEY  = "roomAmenities";

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
    }

    /**
     * @return $hotels array of hotles given by provider 
     */
    public function getHotels(){
        
        $Hotels = array();


        /**
         * TODO use CURL to get call provider on another orgin ;
        */        
        //get hotel by file_get_contans
        $responseString = file_get_contents($this->providerUrl);
        $responseJson   = json_decode($responseString,TRUE);

        //refactor Hotels given by provider 
        foreach($responseJson as $hotel){
            $newHotel = array();

            $newHotel[PROVIDER] = $this->providerName;
            $newHotel[HOTEL_NAME]  = $hotel[$this->HOTEL_NAME_KEY];
            $newHotel[HOTEL_RATE]  = $hotel[$this->HOTEL_RATE_KEY];


            //get fare for one night
            $newHotel[HOTEL_FARE]       = $hotel[$this->HOTEL_FARE_KEY];

            //convert amenities string to array 
            $newHotel[HOTEL_AMENITIES]  =  $this->convertAmenities($hotel[$this->HOTEL_AMENITIES_KEY]);

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
     * @param string amenities string 
     * @return array amenities array 
     */
     private function convertAmenities($amenitiesString){

        $amenitiesArray = array();
        $ar = explode(',',$amenitiesString) ;
        foreach($ar as $key=>$value){
            $amenitiesArray[] = trim($value);
        } 
        
        return $amenitiesArray;
    }
}
?>