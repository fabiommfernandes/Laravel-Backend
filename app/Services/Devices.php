<?php

namespace App\Services;

use Analytics;
use Spatie\Analytics\Period;

class Devices
{
    public function devices()
    {
        $time = Period::days(30);
        $metrics = "ga:uniquePageviews"; 
        $others = ['dimensions' => 'ga:deviceCategory' ];
        
        /*
            METRICS CHEATSHEET 

            dimension -> metrics -> sort 

            Dimensions: 
                ga:deviceCategory
                ga:country
                ga:city 
            Metrics: 
                ga:users = users
                ga:newUsers = new users 
                ga:sessions  = unique entries 
                ga:pageviews = pageviews
                ga:uniquePageviews
                ga:timeOnPage (miliseconds )
                ['totalsForAllResults'] -> for results 

        */

        $results  = Analytics::performQuery($time, $metrics, $others  )->rows; 
        $results =  $this->parseResults($results);
     

        return $results; 
    }


    /* 
        Parses through URL's, rejects '/' paths or any other specified path (ex:/blog),
        uses unique('url') to prevent duplicates
        and has a transform to remove any text desired from the page titles (Ex: Laravel News)
    
    */
    protected function parseResults($results)
    {   

        $len = count($results);
        $keysString = ['device', 'pageviews'];
        $z = 0;
            foreach($results as $result){
                for($i=0;$i<2; $i++){
                    $results[$z][$keysString[$i]] = $results[$z][$i];   

                    unset($results[$z][$i]);  
                }
                $z++;
            }   
        
        return $results; 
    }


    public  function devicesUsed($devices){
        $data = Array(); 
        foreach ($devices as $device){
            $data[$device['device']] = $device['pageviews']; 
        }
        return $data; 
    }
}