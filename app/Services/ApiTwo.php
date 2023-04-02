<?php

namespace App\Services;

class ApiTwo extends TaskAbstract
{
    public static string $url = "http://www.mocky.io/v2/5d47f24c330000623fa3ebfa";

    public function getList(): array
    {
        $response = $this->request(self::$url);

        return $this->transformer($response);
    }

    public function transformer($data): array
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
