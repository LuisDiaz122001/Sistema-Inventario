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

    public function run(): void
    {
        // ─── Roles ───────────────────────────────────────────────────────────
        $adminRole    = Role::firstOrCreate(['name' => 'Administrador']);
        $employeeRole = Role::firstOrCreate(['name' => 'Empleado']);

        // ─── Usuarios ────────────────────────────────────────────────────────
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name'      => 'Admin',
                'last_name' => 'User',
                'username'  => 'admin',
                'password'  => bcrypt('password'),
            ]
        );
        $admin->assignRole('Administrador');

        $luis = User::firstOrCreate(
            ['email' => 'luguigamerpro@gmail.com'],
            [
                'name'      => 'Luis',
                'last_name' => 'Diaz',
                'username'  => 'Luis_Diaz',
                'password'  => bcrypt('LuisDiaz2001*'),
            ]
        );
        $luis->assignRole('Administrador');

        // ─── Categorías ──────────────────────────────────────────────────────
        $catMap = [];
        $categorias = [
            ['name' => 'Tecnologia',  'location' => 'Pasillo 1'],
            ['name' => 'Mobiliario',  'location' => 'Pasillo 2'],
            ['name' => 'Papeleria',   'location' => 'Estante A'],
            ['name' => 'Limpieza',    'location' => 'Estante B'],
            ['name' => 'Herramientas','location' => 'Pasillo 3'],
        ];

        foreach ($categorias as $cat) {
            $catMap[$cat['name']] = Category::firstOrCreate(
                ['name' => $cat['name']],
                ['location' => $cat['location']]
            )->id;
        }

        // ─── Productos ───────────────────────────────────────────────────────
        $products = [
            // Audífonos
            ['code' => 'PROD-AUD-APL-AIRPODS-PRO2', 'name' => 'AirPods Pro 2da Generacion',       'price' => 1100000, 'stock' => 15, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-AUD-SON-WH1000XM5',    'name' => 'Audifonos Sony WH-1000XM5',        'price' => 1500000, 'stock' => 10, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-AUD-JBL-TUNE510BT',    'name' => 'Audifonos JBL Tune 510BT',         'price' => 220000,  'stock' => 18, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-AUD-LOG-H390',          'name' => 'Audifonos Logitech H390',          'price' => 180000,  'stock' => 25, 'categoria' => 'Tecnologia'],

            // Celulares
            ['code' => 'PROD-PHN-APL-IP17PM-NC',    'name' => 'iPhone 17 Pro Max Naranja Cosmico', 'price' => 6200000, 'stock' => 8,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP17PM-AI',    'name' => 'iPhone 17 Pro Max Azul Intenso',   'price' => 6200000, 'stock' => 5,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP17PM-PT',    'name' => 'iPhone 17 Pro Max Plata Natural',  'price' => 6200000, 'stock' => 5,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP16PM-TB',    'name' => 'iPhone 16 Pro Max Titanio Blanco', 'price' => 5800000, 'stock' => 8,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP16PM-TN',    'name' => 'iPhone 16 Pro Max Titanio Natural', 'price' => 5800000, 'stock' => 11, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP16PM-NT',    'name' => 'iPhone 16 Pro Max Titanio Negro',   'price' => 5800000, 'stock' => 11, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP16PM-TD',    'name' => 'iPhone 16 Pro Max Titanio del Desierto', 'price' => 5800000, 'stock' => 8,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-S24U-NT',      'name' => 'Samsung Galaxy S24 Ultra Titanio',  'price' => 5800000, 'stock' => 7,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-XIA-16PRO',        'name' => 'Xiaomi 16 Pro',                     'price' => 3200000, 'stock' => 16, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IPSE20-256',   'name' => 'iPhone SE 2020 256GB',                'price' => 900000,  'stock' => 25, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP15P-256',    'name' => 'iPhone 15 Pro 256GB',               'price' => 4800000, 'stock' => 30, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-A05-64',       'name' => 'Samsung Galaxy A05 64GB',             'price' => 550000,  'stock' => 45, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-A14-128',      'name' => 'Samsung Galaxy A14 128GB',            'price' => 750000,  'stock' => 38, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-A54-128',      'name' => 'Samsung Galaxy A54 128GB',            'price' => 1100000, 'stock' => 22, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-XIA-13T-256',      'name' => 'Xiaomi 13T 256GB',                  'price' => 2200000, 'stock' => 18, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-XIA-REDMI12-256',  'name' => 'Xiaomi Redmi 12 256GB',               'price' => 850000,  'stock' => 40, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-XIA-NOTE13-256',   'name' => 'Xiaomi Note 13 256GB',               'price' => 950000,  'stock' => 35, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-S25U-256',     'name' => 'Samsung Galaxy S25 Ultra 256GB',     'price' => 5900000, 'stock' => 12, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-SAM-M34-128',      'name' => 'Samsung Galaxy M34 128GB',           'price' => 950000,  'stock' => 32, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IP16-64',      'name' => 'iPhone 16 64GB',                     'price' => 4200000, 'stock' => 28, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-PHN-APL-IPSE3-64',     'name' => 'iPhone SE 3ra Gen 64GB',             'price' => 800000,  'stock' => 35, 'categoria' => 'Tecnologia'],

            // Periféricos
            ['code' => 'PROD-TEC-LOG-G305',         'name' => 'Mouse Logitech G305',              'price' => 150000,  'stock' => 30, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-LOG-G502',         'name' => 'Mouse Logitech G502',              'price' => 220000,  'stock' => 0,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-LOG-M185',         'name' => 'Mouse Logitech M185',              'price' => 60000,   'stock' => 40, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-RED-K552',         'name' => 'Teclado Redragon Kumara K552',     'price' => 180000,  'stock' => 20, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-LOG-K120',         'name' => 'Teclado Logitech K120',            'price' => 50000,   'stock' => 35, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-HP-KB100',         'name' => 'Teclado HP KB100',                 'price' => 70000,   'stock' => 22, 'categoria' => 'Tecnologia'],

            // Almacenamiento
            ['code' => 'PROD-TEC-KIN-SSD240',       'name' => 'SSD Kingston 240GB',               'price' => 90000,   'stock' => 40, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-KIN-SSD480',       'name' => 'SSD Kingston 480GB',               'price' => 120000,  'stock' => 35, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-KIN-SSD1TB',       'name' => 'SSD Kingston 1TB',                 'price' => 250000,  'stock' => 20, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-SAN-USB32',        'name' => 'USB Sandisk 32GB',                 'price' => 20000,   'stock' => 80, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-SAN-USB64',        'name' => 'USB Sandisk 64GB',                 'price' => 30000,   'stock' => 60, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-SAN-USB128',       'name' => 'USB Sandisk 128GB',                'price' => 50000,   'stock' => 50, 'categoria' => 'Tecnologia'],

            // Monitores
            ['code' => 'PROD-TEC-MON-SAM-24',       'name' => 'Monitor Samsung 24 pulgadas',      'price' => 800000,  'stock' => 9,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-MON-LG-27',        'name' => 'Monitor LG 27 pulgadas',           'price' => 1100000, 'stock' => 6,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-MON-ASUS-24',      'name' => 'Monitor Asus 24 pulgadas',         'price' => 900000,  'stock' => 7,  'categoria' => 'Tecnologia'],

            // Laptops
            ['code' => 'PROD-TEC-LAP-LEN-E14',      'name' => 'Laptop Lenovo E14',                'price' => 3200000, 'stock' => 5,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-LAP-HP-15',        'name' => 'Laptop HP 15',                     'price' => 2800000, 'stock' => 7,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-LAP-DELL-I5',      'name' => 'Laptop Dell Core i5',              'price' => 3000000, 'stock' => 6,  'categoria' => 'Tecnologia'],

            // Mobiliario
            ['code' => 'PROD-MOB-SILLA-ERG-NEG',    'name' => 'Silla Ergonomica Negra',           'price' => 450000,  'stock' => 10, 'categoria' => 'Mobiliario'],
            ['code' => 'PROD-MOB-SILLA-ERG-GRI',    'name' => 'Silla Ergonomica Gris',            'price' => 450000,  'stock' => 8,  'categoria' => 'Mobiliario'],
            ['code' => 'PROD-MOB-SILLA-GAMER',      'name' => 'Silla Gamer',                      'price' => 650000,  'stock' => 6,  'categoria' => 'Mobiliario'],
            ['code' => 'PROD-MOB-ESCR-120',         'name' => 'Escritorio 120cm',                 'price' => 350000,  'stock' => 6,  'categoria' => 'Mobiliario'],
            ['code' => 'PROD-MOB-ESCR-150',         'name' => 'Escritorio 150cm',                 'price' => 420000,  'stock' => 5,  'categoria' => 'Mobiliario'],
            ['code' => 'PROD-MOB-ARCH-4CAJ',        'name' => 'Archivador 4 Cajones',             'price' => 500000,  'stock' => 4,  'categoria' => 'Mobiliario'],

            // Papelería
            ['code' => 'PROD-PAP-RESMA-CARTA',      'name' => 'Resma Papel Carta',                'price' => 18000,   'stock' => 120,'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-RESMA-OFICIO',     'name' => 'Resma Papel Oficio',               'price' => 20000,   'stock' => 100,'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-CUAD-100',         'name' => 'Cuaderno 100 hojas',               'price' => 8000,    'stock' => 90, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-CUAD-200',         'name' => 'Cuaderno 200 hojas',               'price' => 12000,   'stock' => 70, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-BIC-AZUL',         'name' => 'Boligrafo Azul',                   'price' => 1500,    'stock' => 200,'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-BIC-NEGRO',        'name' => 'Boligrafo Negro',                  'price' => 1500,    'stock' => 180,'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-MARC-RESALT',      'name' => 'Resaltador',                       'price' => 3000,    'stock' => 150,'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-CARP-AZUL',        'name' => 'Carpeta Azul',                     'price' => 5000,    'stock' => 90, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-PAP-CARP-NEG',         'name' => 'Carpeta Negra',                    'price' => 5000,    'stock' => 85, 'categoria' => 'Papeleria'],

            // Limpieza
            ['code' => 'PROD-LIMP-ALC-70',          'name' => 'Alcohol 70% 1L',                   'price' => 12000,   'stock' => 50, 'categoria' => 'Limpieza'],
            ['code' => 'PROD-LIMP-DET-2L',          'name' => 'Detergente 2L',                    'price' => 18000,   'stock' => 40, 'categoria' => 'Limpieza'],
            ['code' => 'PROD-LIMP-GUANTES',         'name' => 'Guantes Latex Caja',               'price' => 25000,   'stock' => 60, 'categoria' => 'Limpieza'],
            ['code' => 'PROD-LIMP-CLORO',           'name' => 'Cloro 1L',                         'price' => 8000,    'stock' => 55, 'categoria' => 'Limpieza'],
            ['code' => 'PROD-LIMP-TRAPERO',         'name' => 'Trapero',                          'price' => 12000,   'stock' => 35, 'categoria' => 'Limpieza'],

            // Herramientas
            ['code' => 'PROD-HERR-TAL-BOSCH',       'name' => 'Taladro Bosch 550W',               'price' => 280000,  'stock' => 7,  'categoria' => 'Herramientas'],
            ['code' => 'PROD-HERR-DEST-KIT',        'name' => 'Kit Destornilladores',             'price' => 90000,   'stock' => 15, 'categoria' => 'Herramientas'],
            ['code' => 'PROD-HERR-MARTILLO',        'name' => 'Martillo',                         'price' => 30000,   'stock' => 25, 'categoria' => 'Herramientas'],
            ['code' => 'PROD-HERR-LLAVE-ING',       'name' => 'Llave Inglesa',                    'price' => 45000,   'stock' => 20, 'categoria' => 'Herramientas'],

            // Accesorios tecnología
            ['code' => 'PROD-TEC-CAM-LOG-C920',     'name' => 'Camara Logitech C920',             'price' => 350000,  'stock' => 9,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-MIC-HYPERX',       'name' => 'Microfono HyperX',                 'price' => 500000,  'stock' => 5,  'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-PAD-MOUSE',        'name' => 'Mouse Pad Gamer',                  'price' => 40000,   'stock' => 60, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-CARG-USB-C',       'name' => 'Cargador USB-C',                   'price' => 60000,   'stock' => 45, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-CABLE-HDMI',       'name' => 'Cable HDMI',                       'price' => 25000,   'stock' => 70, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-CABLE-USB',        'name' => 'Cable USB',                        'price' => 15000,   'stock' => 80, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-ROUTER-TP',        'name' => 'Router TP-Link',                   'price' => 120000,  'stock' => 20, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-SWITCH-8P',        'name' => 'Switch 8 Puertos',                 'price' => 90000,   'stock' => 18, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-DISCO-EXT1TB',     'name' => 'Disco Duro Externo 1TB',           'price' => 300000,  'stock' => 12, 'categoria' => 'Tecnologia'],
            ['code' => 'PROD-TEC-DISCO-EXT2TB',     'name' => 'Disco Duro Externo 2TB',           'price' => 450000,  'stock' => 10, 'categoria' => 'Tecnologia'],

            // Extras papelería
            ['code' => 'PROD-EXTRA-001',            'name' => 'Producto Extra 1',                 'price' => 10000,   'stock' => 10, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-002',            'name' => 'Producto Extra 2',                 'price' => 12000,   'stock' => 12, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-003',            'name' => 'Producto Extra 3',                 'price' => 14000,   'stock' => 14, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-004',            'name' => 'Producto Extra 4',                 'price' => 16000,   'stock' => 16, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-005',            'name' => 'Producto Extra 5',                 'price' => 18000,   'stock' => 18, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-006',            'name' => 'Producto Extra 6',                 'price' => 20000,   'stock' => 20, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-007',            'name' => 'Producto Extra 7',                 'price' => 22000,   'stock' => 22, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-008',            'name' => 'Producto Extra 8',                 'price' => 24000,   'stock' => 24, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-009',            'name' => 'Producto Extra 9',                 'price' => 26000,   'stock' => 26, 'categoria' => 'Papeleria'],
            ['code' => 'PROD-EXTRA-010',            'name' => 'Producto Extra 10',                'price' => 28000,   'stock' => 28, 'categoria' => 'Papeleria'],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['code' => $p['code']],
                [
                    'name'        => $p['name'],
                    'price'       => $p['price'],
                    'stock'       => $p['stock'],
                    'category_id' => $catMap[$p['categoria']],
                    'user_id'     => $luis->id,
                ]
            );
        }
    }
}