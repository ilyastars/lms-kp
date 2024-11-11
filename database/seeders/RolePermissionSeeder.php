<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus roles dan permissions yang ada agar tidak duplikat
        Role::truncate();
        Permission::truncate();

        // Buat permissions
        $manageSkema = Permission::create(['name' => 'manage skema']);
        $managePendaftaran = Permission::create(['name' => 'manage pendaftaran']);
        $createPendaftaran = Permission::create(['name' => 'create pendaftaran']);

        // Buat roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions ke roles
        $adminRole->givePermissionTo(['manage skema', 'manage pendaftaran']);
        $userRole->givePermissionTo(['create pendaftaran']);

    }
}
