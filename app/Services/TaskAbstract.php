<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

abstract class TaskAbstract
{
    public function request($url)
    {
        return Http::get($url)->json();
    }
}
