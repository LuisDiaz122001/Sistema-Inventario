# 📦 Sistema de Inventario

Sistema web de gestión de inventario desarrollado con **Laravel 12**, **Vue 3** e **Inertia.js**. Permite administrar productos, categorías y usuarios con control de acceso basado en roles (RBAC), migrando desde una arquitectura legacy PHP hacia un stack moderno y escalable.

---

## 🛠️ Stack Tecnológico

### Backend
| Tecnología | Versión | Descripción |
|---|---|---|
| PHP | ^8.2 | Lenguaje del servidor |
| Laravel | ^12.0 | Framework principal |
| Inertia.js (Laravel) | ^2.0 | Puente entre backend y frontend SPA |
| Spatie Permissions | ^6.25 | Control de roles y permisos (RBAC) |
| Laravel Sanctum | ^4.0 | Autenticación de API |
| Laravel Breeze | ^2.4 | Scaffolding de autenticación |

### Frontend
| Tecnología | Versión | Descripción |
|---|---|---|
| Vue 3 | ^3.4 | Framework reactivo del frontend |
| Vite | ^7.0 | Bundler de assets |
| Tailwind CSS | ^3.2 | Framework de estilos |
| Lucide Vue | ^1.0 | Iconos |

### Testing
| Tecnología | Descripción |
|---|---|
| PestPHP | Framework de pruebas |
| Playwright | Pruebas end-to-end (E2E) |

---

## 🗂️ Módulos del Sistema

### 👤 Usuarios
- Registro y gestión de cuentas de usuario
- Asignación de roles y permisos (RBAC con Spatie)
- Actualización de perfil y contraseña

### 🏷️ Categorías
- Creación, edición y eliminación de categorías de productos
- Listado paginado con búsqueda en tiempo real

### 📦 Productos
- Gestión completa (crear, editar, eliminar)
- Carga de imagen por producto (almacenada en `storage/app/public/products`)
- Control de stock con indicador visual de nivel bajo
- Búsqueda por nombre, código y categoría
- Listado paginado

### 🔐 Autenticación
- Login / Logout
- Recuperación de contraseña por email
- Protección de rutas por rol

---

## ⚙️ Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL / MariaDB
- XAMPP (o equivalente en entorno local)

---

## 🚀 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/LuisDiaz122001/Sistema-Inventario.git
cd Sistema-Inventario
```

### 2. Instalar dependencias PHP
```bash
composer install
```

### 3. Instalar dependencias JavaScript
```bash
npm install
```

### 4. Configurar variables de entorno
```bash
cp .env.example .env
php artisan key:generate
```

Editar el archivo `.env` con los datos de tu base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecutar migraciones
```bash
php artisan migrate
```

### 6. Crear enlace simbólico para imágenes
```bash
php artisan storage:link
```

### 7. (Opcional) Configurar el script de setup automático
```bash
composer run setup
```
> Este comando ejecuta automáticamente: `composer install`, generación de clave, migraciones, `npm install` y compilación de assets.

---

## ▶️ Levantar el entorno de desarrollo

### Opción A — Todos los servicios en paralelo (recomendado)
```bash
composer run dev
```
> Levanta simultáneamente: servidor Laravel, worker de colas, log viewer (Pail) y Vite.

### Opción B — Por separado
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

La aplicación estará disponible en: **http://127.0.0.1:8000**

---

## 🧪 Ejecutar Pruebas

```bash
composer run test
```
O directamente:
```bash
php artisan test
```

---

## 📁 Estructura del Proyecto (resumida)

```
inventario/
├── app/
│   ├── Http/Controllers/
│   │   ├── ProductController.php
│   │   ├── CategoryController.php
│   │   └── UserController.php
│   └── Models/
│       ├── Product.php
│       ├── Category.php
│       └── User.php
├── resources/
│   └── js/
│       └── Pages/
│           ├── Products/
│           ├── Categories/
│           ├── Users/
│           └── Dashboard.vue
├── database/migrations/
├── legacy/          ← Sistema PHP legado (referencia histórica)
└── storage/app/public/products/  ← Imágenes de productos
```

---

## 🖼️ Almacenamiento de Imágenes

Las imágenes de los productos se guardan en:
```
storage/app/public/products/
```
Y son accesibles públicamente desde:
```
http://127.0.0.1:8000/storage/products/{nombre-imagen}
```

> Requiere haber ejecutado `php artisan storage:link` una sola vez.

---

## 📝 Licencia

Este proyecto es de uso privado. Todos los derechos reservados © 2026.
