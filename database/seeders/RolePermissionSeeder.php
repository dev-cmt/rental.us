<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        Permission::create(['name' => 'property.index']);
        Permission::create(['name' => 'property.create']);
        Permission::create(['name' => 'property.show']);
        Permission::create(['name' => 'property.update']);

        // Roles
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);
        $viewer = Role::create(['name' => 'viewer']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $editor->givePermissionTo(['property.index', 'property.create', 'property.update']);
        $viewer->givePermissionTo(['property.index', 'property.show']);

        /**-----------------------------------------------------
         *  USER ASSIGN ROLE
         * -----------------------------------------------------
         */
        $userAdmin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'photo_path' => 'uploads/profile-photo.jpg',
            'password' => Hash::make('admin12345'),
        ]);
        $editorAdmin = User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('editor12345'),
        ]);
        $viewerAdmin = User::factory()->create([
            'name' => 'viewer User',
            'email' => 'viewer@gmail.com',
            'password' => Hash::make('viewer12345'),
        ]);

        $userAdmin->assignRole('admin');
        $editorAdmin->assignRole('editor');
        $viewerAdmin->assignRole('viewer');
    }
}
