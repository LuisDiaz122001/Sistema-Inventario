<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::create(['name' => 'Administrador']);
        $employeeRole = Role::create(['name' => 'Empleado']);

        // Crear usuario administrador
        $admin = User::factory()->create([
            'name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Administrador');

        $user = User::factory()->create([
            'name' => 'Luis',
            'last_name' => 'Diaz',
            'username' => 'Luis_Diaz',
            'email' => 'luguigamerpro@gmail.com',
            'password' => bcrypt('LuisDiaz2001*'),
        ]);
        $user->assignRole('Administrador');

        // Crear categorías
        $categories = [
            Category::create(['name' => 'Electrónicos', 'location' => 'Pasillo 1']),
            Category::create(['name' => 'Muebles', 'location' => 'Pasillo 2']),
            Category::create(['name' => 'Oficina', 'location' => 'Estante A']),
        ];

        // Crear productos
        for ($i = 1; $i <= 20; $i++) {
            Product::create([
                'code' => 'PROD-00' . $i,
                'name' => 'Producto de Prueba ' . $i,
                'price' => rand(100, 1000) * 100,
                'stock' => rand(0, 100),
                'category_id' => $categories[array_rand($categories)]->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
