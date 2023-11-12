<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command is used to create user roles';

    /**
     * Execute the console command.
     */

    public function handle()
    {
        $role = Role::create(['name' => 'admin']);
        
        $permission = Permission::create(['name' => 'manage admin']);
        $permission->assignRole($role);
        $this->info('Roles and permissions creation completed.');
    }
}
