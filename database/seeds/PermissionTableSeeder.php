<?php

use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
          [
             'id' => 1, 
             'title' => 'Permission List', 
             'route_uri' => 'permission', 
             'route_name' => 'permission.index',
             'created_by' => 0,
         ],
         [
             'id' => 2, 
             'title' => 'Create new Permission', 
             'route_uri' => 'permission/create', 
             'route_name' => 'permission.create',
             'created_by' => 0,
         ],
         [
             'id' => 3, 
             'title' => NULL, 
             'route_uri' => 'api/user', 
             'route_name' => NULL,
             'created_by' => 1,
         ],
         [
             'id' => 4, 
             'title' => NULL, 
             'route_uri' => 'admin', 
             'route_name' => NULL,
             'created_by' => 1,
         ],
         [
             'id' => 5, 
             'title' => 'Users', 
             'route_uri' => 'user', 
             'route_name' => 'user.index',
             'created_by' => 1,
         ],
         [
             'id' => 6, 
             'title' => 'Create User', 
             'route_uri' => 'user/create', 
             'route_name' => 'user.create',
             'created_by' => 1,
         ],
         [
             'id' => 7, 
             'title' => 'Store User', 
             'route_uri' => 'store', 
             'route_name' => 'user.store',
             'created_by' => 1,
         ],
         [
             'id' => 8, 
             'title' => 'Update Users', 
             'route_uri' => 'user/{id}/edit', 
             'route_name' => 'user.update',
             'created_by' => 1,
         ],
         [
             'id' => 9, 
             'title' => 'Trash User', 
             'route_uri' => 'user/{id}/trash', 
             'route_name' => 'user.trash',
             'created_by' => 1,
         ],
         [
             'id' => 10, 
             'title' => 'Restore Users', 
             'route_uri' => 'user/{id}/restore', 
             'route_name' => 'user.restore',
             'created_by' => 1,
         ],
         [
             'id' => 11, 
             'title' => 'Delete Users', 
             'route_uri' => 'user/{id}/delete', 
             'route_name' => 'user.delete',
             'created_by' => 1,
         ],
         [
             'id' => 12, 
             'title' => 'Roles', 
             'route_uri' => 'role', 
             'route_name' => 'role.index',
             'created_by' => 1,
         ],
         [
             'id' => 13, 
             'title' => 'Create Roles', 
             'route_uri' => 'role/create', 
             'route_name' => 'role.create',
             'created_by' => 1,
         ],
         [
             'id' => 14, 
             'title' => 'Store Roles', 
             'route_uri' => 'role/store', 
             'route_name' => 'role.store',
             'created_by' => 1,
         ],
         [
             'id' => 15, 
             'title' => 'Update Roles', 
             'route_uri' => 'role/{id}/edit', 
             'route_name' => 'role.update',
             'created_by' => 1,
         ],
         [
             'id' => 16, 
             'title' => 'Trash Roles', 
             'route_uri' => 'role/{id}/trash', 
             'route_name' => 'role.trash',
             'created_by' => 1,
         ],
         [
             'id' => 17, 
             'title' => 'Restore Roles', 
             'route_uri' => 'role/{id}/restore', 
             'route_name' => 'role.restore',
             'created_by' => 1,
         ],
         [
             'id' => 18, 
             'title' => 'Delete Roles', 
             'route_uri' => 'role/{id}/delete', 
             'route_name' => 'role.delete',
             'created_by' => 1,
         ],
         [
             'id' => 19, 
             'title' => 'Role User', 
             'route_uri' => 'role_user/{id}', 
             'route_name' => 'role_user.index',
             'created_by' => 1,
         ],
         [
             'id' => 20, 
             'title' => 'Create Roles User', 
             'route_uri' => 'role_user/{id}/create', 
             'route_name' => 'role_user.create',
             'created_by' => 1,
         ],
         [
             'id' => 21, 
             'title' => 'Store Roles User', 
             'route_uri' => 'role_user/store', 
             'route_name' => 'role_user.store',
             'created_by' => 1,
         ],
         [
             'id' => 22, 
             'title' => 'Trash Roles User', 
             'route_uri' => 'role_user/{id}/trash', 
             'route_name' => 'role_user.trash',
             'created_by' => 1,
         ],
         [
             'id' => 23, 
             'title' => 'Restore Roles User', 
             'route_uri' => 'role_user/{id}/restore', 
             'route_name' => 'role_user.restore',
             'created_by' => 1,
         ],
         [
             'id' => 24, 
             'title' => 'Destroy Roles User', 
             'route_uri' => 'role_user/{id}/delete', 
             'route_name' => 'role_user.delete',
             'created_by' => 1,
         ],
         [
             'id' => 25, 
             'title' => 'Edit Roles User', 
             'route_uri' => 'role_user/{id}/status', 
             'route_name' => 'role_user.status',
             'created_by' => 1,
         ],
         [
             'id' => 26, 
             'title' => 'Role Permission', 
             'route_uri' => 'role_permission/{id}', 
             'route_name' => 'role_permission.index',
             'created_by' => 1,
         ],
         [
             'id' => 27, 
             'title' => 'Create Roles Permission', 
             'route_uri' => 'role_permission/{id}/create', 
             'route_name' => 'role_permission.create',
             'created_by' => 1,
         ],
         [
             'id' => 28, 
             'title' => 'Store Roles Permission', 
             'route_uri' => 'role_permission/store', 
             'route_name' => 'role_permission.store',
             'created_by' => 1,
         ],
         [
             'id' => 29, 
             'title' => 'Trash Roles permission', 
             'route_uri' => 'role_permission/{id}/trash', 
             'route_name' => 'role_permission.trash',
             'created_by' => 1,
         ],
         [
             'id' => 30, 
             'title' => 'Restore Role Permission', 
             'route_uri' => 'role_permission/{id}/restore', 
             'route_name' => 'role_permission.restore',
             'created_by' => 1,
         ],
         [
             'id' => 31, 
             'title' => 'Destroy Roles Permission', 
             'route_uri' => 'role_permission/{id}/delete', 
             'route_name' => 'role_permission.delete',
             'created_by' => 1,
         ],
         [
             'id' => 32, 
             'title' => 'Trash Permission', 
             'route_uri' => 'permission/trash/{id}', 
             'route_name' => 'permission.trash',
             'created_by' => 1,
         ],
         [
             'id' => 33, 
             'title' => 'Restore trashed Permission', 
             'route_uri' => 'permission/restore/{id}', 
             'route_name' => 'permission.restore',
             'created_by' => 1,
         ],
         [
             'id' => 34, 
             'title' => 'Destroy Permission', 
             'route_uri' => 'permission/destroy/{id}', 
             'route_name' => 'permission.destroy',
             'created_by' => 1,
         ],
         [
             'id' => 35, 
             'title' => 'Role wise permissions', 
             'route_uri' => 'role/{id}/permissions', 
             'route_name' => 'role.permissions',
             'created_by' => 1,
         ],

     ]);
$this->command->info("Permissions table seeded :)");
}
}
