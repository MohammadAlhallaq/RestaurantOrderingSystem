<?php

namespace App\Console\Commands;

use App\Models\Account;
use Illuminate\Console\Command;

class ChangeRestaurantOpeningStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Account::query()
            ->where('account_type_id', 2)
            ->where('status_id', 1)
            ->where('work_status_id', 1)
            ->where('closing_time', '<', now()->toTimeString())
            ->lazyById()
            ->each(fn($account) => $account->update(['work_status_id' => 2]));
    }
}
