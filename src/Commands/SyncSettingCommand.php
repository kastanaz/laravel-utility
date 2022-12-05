<?php

namespace Kastanaz\LaravelUtility\Commands;

use Illuminate\Console\Command;
use Kastanaz\LaravelUtility\Models\Setting;

class SyncSettingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:sync-setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (config('setting.list') as $config => $value) {
            Setting::firstOrCreate(['name' => $config], [
                'value' => $value
            ]);
        }
        return Command::SUCCESS;
    }
}
