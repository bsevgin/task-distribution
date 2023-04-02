<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static int $hourLimitPerWeek = 45;
    public static int $maxDifficultyRate = 5;

    public function index()
    {
        $developers = Developer::all();
        $tasks = Task::all();

        $weeklySprint = [];
        $taskNonList = [];
        $taskDevelopers = $developers->keyBy('id')->map(function($item){
            $item['task'] = [];
            return $item;
        })->toArray();

        $i = 1;
        foreach($tasks as $task){
            if($task->duration > self::$hourLimitPerWeek){
                $taskNonList[] = $task;
                continue;
            }

            $weekName = 'Sprint ' . $i;
            if(!isset($weeklySprint[$weekName])){
                $weeklySprint[$weekName] = collect($taskDevelopers);
            }

            $developer = $this->findAvailableDeveloper($weeklySprint[$weekName], $task->difficulty_rate, $task->duration);
            if(!$developer){
                $i++;
                $weekName = 'Sprint ' . $i;
                $weeklySprint[$weekName] = collect($taskDevelopers);
                $developer = $this->findAvailableDeveloper($weeklySprint[$weekName], $task->difficulty_rate, $task->duration);
            }

            $developer['task'][] = $task->toArray();

            $weeklySprint[$weekName][$developer['id']] = $developer;
        }

        return view('home', compact('weeklySprint', 'taskNonList'));
    }

    private function findAvailableDeveloper($developers, $difficultyRate, $taskDuration)
    {
        $developer = $developers->firstWhere('difficulty_rate', $difficultyRate);
        if(!$developer
            || ((collect($developer['task'])->sum('duration') + $taskDuration) > self::$hourLimitPerWeek)){
            if($difficultyRate + 1 > self::$maxDifficultyRate){
                return false;
            }

            $developer = $this->findAvailableDeveloper($developers, $difficultyRate + 1, $taskDuration);
        }

        return $developer;
    }

    //
}
