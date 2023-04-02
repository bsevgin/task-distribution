<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Services\ApiDataProvider;
use App\Services\ApiOne;
use App\Services\ApiTwo;
use Illuminate\Console\Command;

class GetTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull task list from API providers';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try{
            $apiDataProvider = app(ApiDataProvider::class);
            $data = $apiDataProvider->getData();
            if(!$data){
                $this->warn('There is no task in ApiOne.');
            }

            Task::insert($data);

            $this->info('Tasks inserted successfully.');
        }
        catch (\Exception $e){
            $this->error($e->getMessage());
        }

        //
    }
}
