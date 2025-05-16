<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $commenterRole = Role::create(['name' => RolesEnum::Commenter->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);

        $manageFeaturesPermission = Permission::create(['name' => PermissionsEnum::ManageFeatures->value]);
        $manageUsersPermission = Permission::create(['name' => PermissionsEnum::ManageUsers->value]);
        $manageCommentsPermission = Permission::create(['name' => PermissionsEnum::ManageComments->value]);
        $managePostsPermission = Permission::create(['name' => PermissionsEnum::ManagePosts->value]);
        $manageDownVotesPermission = Permission::create(['name' => PermissionsEnum::ManageDownVotes->value]);

        $userRole->syncPermissions([$manageDownVotesPermission]);
        $commenterRole->syncPermissions([$manageDownVotesPermission, $manageCommentsPermission]);
        $adminRole->syncPermissions([$manageCommentsPermission, $manageFeaturesPermission, $managePostsPermission, $manageDownVotesPermission, $manageUsersPermission]);

        User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular@example.com',
        ])->assignRole(RolesEnum::User);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ])->assignRole(RolesEnum::Admin);

        User::factory()->create([
            'name' => 'Commenter User',
            'email' => 'commenter@example.com',
        ])->assignRole(RolesEnum::Commenter);

    }
}
