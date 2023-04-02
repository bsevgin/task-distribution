<?php

namespace App\Services;

class ApiOne extends TaskAbstract
{
    public static string $url = "http://www.mocky.io/v2/5d47f235330000623fa3ebf7";

    public function getList(): array
    {
        $response = $this->request(self::$url);

        return $this->transformer($response);
    }

    public function transformer($data): array
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
}
