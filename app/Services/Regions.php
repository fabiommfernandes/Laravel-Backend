<?php

namespace App\Services;

use Analytics;
use Spatie\Analytics\Period;

class Regions
{
    public function regions()
    {
        $time = Period::days(30);
        $metrics = "ga:uniquePageviews"; 
        $others = ['dimensions' => 'ga:country'];

        $results  = Analytics::performQuery($time, $metrics, $others  )->rows; 
    
        return $results; 
    }

}