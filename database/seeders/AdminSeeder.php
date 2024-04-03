<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('1234light'),
            ]);

            $permissions = Permission::pluck('id','id')->all();
            $role = Role::updateOrCreate(['name' => 'admin']);
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
    }
}
