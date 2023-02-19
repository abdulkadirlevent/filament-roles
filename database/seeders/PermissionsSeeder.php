<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['id' => 1, 'name' => 'list caris', 'guard_name' => 'web'],
            ['id' => 2, 'name' => 'view caris', 'guard_name' => 'web'],
            ['id' => 3, 'name' => 'create caris', 'guard_name' => 'web'],
            ['id' => 4, 'name' => 'update caris', 'guard_name' => 'web'],
            ['id' => 5, 'name' => 'delete caris', 'guard_name' => 'web'],

            ['id' => 11, 'name' => 'list projeler', 'guard_name' => 'web'],
            ['id' => 12, 'name' => 'view projeler', 'guard_name' => 'web'],
            ['id' => 13, 'name' => 'create projeler', 'guard_name' => 'web'],
            ['id' => 14, 'name' => 'update projeler', 'guard_name' => 'web'],
            ['id' => 15, 'name' => 'delete projeler', 'guard_name' => 'web'],

            ['id' => 21, 'name' => 'list roles', 'guard_name' => 'web'],
            ['id' => 22, 'name' => 'view roles', 'guard_name' => 'web'],
            ['id' => 23, 'name' => 'create roles', 'guard_name' => 'web'],
            ['id' => 24, 'name' => 'update roles', 'guard_name' => 'web'],
            ['id' => 25, 'name' => 'delete roles', 'guard_name' => 'web'],

            ['id' => 31, 'name' => 'list permissions', 'guard_name' => 'web'],
            ['id' => 32, 'name' => 'view permissions', 'guard_name' => 'web'],
            ['id' => 33, 'name' => 'create permissions', 'guard_name' => 'web'],
            ['id' => 34, 'name' => 'update permissions', 'guard_name' => 'web'],
            ['id' => 35, 'name' => 'delete permissions', 'guard_name' => 'web'],

            ['id' => 41, 'name' => 'list users', 'guard_name' => 'web'],
            ['id' => 42, 'name' => 'view users', 'guard_name' => 'web'],
            ['id' => 43, 'name' => 'create users', 'guard_name' => 'web'],
            ['id' => 44, 'name' => 'update users', 'guard_name' => 'web'],
            ['id' => 45, 'name' => 'delete users', 'guard_name' => 'web'],

            ['id' => 51, 'name' => 'list kategoriler', 'guard_name' => 'web'],
            ['id' => 52, 'name' => 'view kategoriler', 'guard_name' => 'web'],
            ['id' => 53, 'name' => 'create kategoriler', 'guard_name' => 'web'],
            ['id' => 54, 'name' => 'update kategoriler', 'guard_name' => 'web'],
            ['id' => 55, 'name' => 'delete kategoriler', 'guard_name' => 'web'],

            ['id' => 61, 'name' => 'list sertifikalar', 'guard_name' => 'web'],
            ['id' => 62, 'name' => 'view sertifikalar', 'guard_name' => 'web'],
            ['id' => 63, 'name' => 'create sertifikalar', 'guard_name' => 'web'],
            ['id' => 64, 'name' => 'update sertifikalar', 'guard_name' => 'web'],
            ['id' => 65, 'name' => 'delete sertifikalar', 'guard_name' => 'web'],

            ['id' => 71, 'name' => 'list egitmenler', 'guard_name' => 'web'],
            ['id' => 72, 'name' => 'view egitmenler', 'guard_name' => 'web'],
            ['id' => 73, 'name' => 'create egitmenler', 'guard_name' => 'web'],
            ['id' => 74, 'name' => 'update egitmenler', 'guard_name' => 'web'],
            ['id' => 75, 'name' => 'delete egitmenler', 'guard_name' => 'web'],

            ['id' => 81, 'title' => 'list blog_tag', 'guard_name' => 'web'],
            ['id' => 82, 'title' => 'view blog_tag', 'guard_name' => 'web'],
            ['id' => 83, 'title' => 'create blog_tag', 'guard_name' => 'web'],
            ['id' => 84, 'title' => 'update blog_tag', 'guard_name' => 'web'],
            ['id' => 85, 'title' => 'delete blog_tag', 'guard_name' => 'web'],

            ['id' => 91, 'title' => 'list blog_kategori', 'guard_name' => 'web'],
            ['id' => 92, 'title' => 'view blog_kategori', 'guard_name' => 'web'],
            ['id' => 93, 'title' => 'create blog_kategori', 'guard_name' => 'web'],
            ['id' => 94, 'title' => 'update blog_kategori', 'guard_name' => 'web'],
            ['id' => 95, 'title' => 'delete blog_kategori', 'guard_name' => 'web'],

            ['id' => 101, 'title' => 'list blog', 'guard_name' => 'web'],
            ['id' => 102, 'title' => 'view blog', 'guard_name' => 'web'],
            ['id' => 103, 'title' => 'create blog', 'guard_name' => 'web'],
            ['id' => 104, 'title' => 'update blog', 'guard_name' => 'web'],
            ['id' => 105, 'title' => 'delete blog', 'guard_name' => 'web'],

            ['id' => 111, 'title' => 'list comment', 'guard_name' => 'web'],
            ['id' => 112, 'title' => 'view comment', 'guard_name' => 'web'],
            ['id' => 113, 'title' => 'create comment', 'guard_name' => 'web'],
            ['id' => 114, 'title' => 'update comment', 'guard_name' => 'web'],
            ['id' => 115, 'title' => 'delete comment', 'guard_name' => 'web'],

        ];
        // Create default permissions
        Permission::insert($permissions);

        $adminRole = Role::create(['id' => 1, 'name' => 'super-admin']);
        $userRole = Role::create(['id' => 2, 'name' => 'user']);

        $allPermissions = Permission::all();
        $userPermissions = Permission::whereIn('id', array(1, 2, 11, 12, 41, 42, 51, 52, 61, 62, 71, 72, 81, 82, 91, 92, 101, 102, 111, 112,))->get();

        $adminRole->givePermissionTo($allPermissions);
        $userRole->givePermissionTo($userPermissions);

        $admin = User::whereEmail('abdulkadirlevent@hotmail.com')->first();
        if ($admin) {
            $admin->assignRole($adminRole);
        }

        $userYahoo = User::whereEmail('abdulkadirlevent@yahoo.com')->first();
        if ($userYahoo) {
            $userYahoo->assignRole($userRole);
        }

        $userGmail = User::whereEmail('abdulkadirlevent@gmail.com')->first();
        if ($userGmail) {
            $userGmail->assignRole($userRole);
        }

    }
}
