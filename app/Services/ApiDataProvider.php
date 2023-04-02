<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiDataProvider
{
    private array $apiUrl;

    public function __construct()
    {
        $this->apiUrl = [
            'apiOne' => 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7',
            'apiTwo' => 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa',
        ];
    }

    public function getData()
    {
        $data = [];
        foreach($this->apiUrl as $apiName => $url){
            $response = Http::get($url)->json();

            $apiTransformMethod = $apiName.'TransformData';
            $transformData = $this->$apiTransformMethod($response);

            $data = array_merge($data, $transformData);
        }

        return $data;
    }

    private function apiOneTransformData($data)
    {
        return array_map(function($item){
            $name = array_key_first($item);

            return [
                'name' => $name,
                'difficulty_rate' => $item[$name]['level'],
                'duration' => $item[$name]['estimated_duration'],
            ];
        }, $data);
    }

    private function apiTwoTransformData($data)
    {
        return array_map(function($item){
            return [
                'name' => $item['id'],
                'difficulty_rate' => $item['zorluk'],
                'duration' => $item['sure'],
            ];
        }, $data);
    }

}
