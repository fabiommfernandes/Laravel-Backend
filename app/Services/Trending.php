<?php

namespace App\Services;

use Analytics;
use Spatie\Analytics\Period;

class Trending
{
    public function week($limit = 15)
    {
        return $this->getResults(7);
    }

    protected function getResults($days, $limit=15)
    {
        
        $trending = Analytics::fetchMostVisitedPages(Period::days($days), $limit + 10);
        $trending = $this->parseResults($trending, $limit); 
        return $trending; 
    }


    /* 
        Parses through URL's, rejects '/' paths or any other specified path (ex:/blog),
        uses unique('url') to prevent duplicates
        and has a transform to remove any text desired from the page titles (Ex: Laravel News)
    
    */
    protected function parseResults($data, $limit)
    {
        return $data->reject(function($item){
            return $item['url'] == '/' or
            $item['url'] == '/blog' or
            starts_with($item['url'], '/category');
        })->unique('url')->transform(function($item){
            $item['pageTitle'] = str_replace(' - Laravel News', '', $item['pageTitle']);
            return $item;
        })->splice(0, $limit);
    }

}