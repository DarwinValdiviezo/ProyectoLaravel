<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'secre']);
        Role::create(['name' => 'bodega']);
        Role::create(['name' => 'cajera']);

        // Crear el usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'email' => 'admin@espe.edu.ec',
                'password' => Hash::make('admin@espe.edu.ec'),
            ]
        );

        // Asignar el rol de admin al usuario
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUser->assignRole($adminRole);
        }

        $secreUser = User::firstOrCreate(
            ['email' => 'secre@espe.edu.ec'],
            [
                'name' => 'Secretaria',
                'email' => 'secre@espe.edu.ec',
                'password' => Hash::make('secre@espe.edu.ec'),
            ]
        );
        // Asignar el rol de secre al usuario
        $secreRole = Role::where('name', 'secre')->first();
        if ($secreRole) {
            $secreUser->assignRole($secreRole);
        }

        $bodegaUser = User::firstOrCreate(
            ['email' => 'bodega@espe.edu.ec'],
            [
                'name' => 'Bodega',
                'email' => 'bodega@espe.edu.ec',
                'password' => Hash::make('bodega@espe.edu.ec'),
            ]
        );
        // Asignar el rol de bodega al usuario
        $bodegaRole = Role::where('name', 'bodega')->first();
        if ($bodegaRole) {
            $bodegaUser->assignRole($bodegaRole);
        }

        $cajeraUser = User::firstOrCreate(
            ['email' => 'cajero@espe.edu.ec'],
            [
                'name' => 'Cajera',
                'email' => 'cajero@espe.edu.ec',
                'password' => Hash::make('cajero@espe.edu.ec'),	
            ]
        );
        // Asignar el rol de cajera al usuario
        $cajeraRole = Role::where('name', 'cajera')->first();
        if ($cajeraRole) {
            $cajeraUser->assignRole($cajeraRole);
        }
    }

    
}
//COmando para ejecutar el seeder: php artisan db:seed --class=RoleSeeder