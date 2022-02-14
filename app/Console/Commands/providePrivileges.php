<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Role;
use Illuminate\Console\Command;

class providePrivileges extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'give:privileges {role-slug} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'give permission to the super admin';

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
        $id = $this->argument('id');
        $roleSlug = $this->argument('role-slug');
        $account = Account::where('id', $id)->first();
        if ($account) {
            $role = Role::where('slug', $roleSlug)->first();
            if ($role) {
                $account->role()->sync($role);
                $this->info('The command was successful!');
            } else {
                $this->error('role not found!');
            }
        } else {
            $this->error('account not found!');
        }
    }
}
