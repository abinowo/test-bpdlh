<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DataInstallation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Data installation for first time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('starting installation...');

        $this->info('starting wipe database...');
        Artisan::call('db:wipe');
        $this->info('database wiped successfully.');

        $this->info('linking storage...');
        Artisan::call('storage:link');
        $this->info('linking storage finished.');

        $this->info('delete all media uploads');
        onDeleteDirectoryAndFiles(base_path('storage/app/public/uploads'));
        $this->info('delete all media uploads finished.');

        $this->info('refresh database');
        Artisan::call('migrate:refresh --seed');
        $this->info('refresh database finished.');
        $this->info('installation finished.');
    }
}
