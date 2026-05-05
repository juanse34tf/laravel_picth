# Sistema de Gestión Avícola

Sistema web para la gestión de una empresa avícola. Permite administrar categorías, productos, lotes, producción, alimentación, gastos y ventas.

**Stack:** Laravel 11 · PHP 8.2+ · Livewire 4 · Blade · CSS puro · SQLite

---

## Requisitos previos

- PHP 8.2 o superior
- Composer
- Node.js y npm
- Git

---

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/juanse34tf/laravel_picth.git
cd Avicola_laravel
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el archivo de entorno

Copiar el archivo de ejemplo:

```bash
# Linux / macOS
cp .env.example .env

# Windows (PowerShell)
Copy-Item .env.example .env
```

El proyecto usa **SQLite** por defecto. El `.env` ya viene configurado para ello:

```
DB_CONNECTION=sqlite
```

Crear el archivo de base de datos SQLite:

```bash
# Linux / macOS
touch database/database.sqlite

# Windows (PowerShell)
New-Item -ItemType File -Path database/database.sqlite
```

> Si se prefiere MySQL u otro motor, descomentar y configurar las variables `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` en el `.env`, y cambiar `DB_CONNECTION` al motor correspondiente.

### 4. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones

```bash
php artisan migrate
```

Esto creará las siguientes tablas:

- `users` · `cache` · `jobs` (Laravel base)
- `categorias`
- `productos`
- `lotes`
- `produccions`
- `alimentacions`
- `gastos`
- `ventas`

### 6. Instalar dependencias de frontend

```bash
npm install
npm run build
```

---

## Poner en funcionamiento

### Modo desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

Para desarrollo con hot-reload del frontend, abrir dos terminales:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

### Modo producción

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan serve
```

---

## Resumen rápido (todos los pasos en orden)

```bash
git clone <url-del-repositorio>
cd Avicola_laravel

composer install

# Linux / macOS
cp .env.example .env
touch database/database.sqlite

# Windows (PowerShell)
Copy-Item .env.example .env
New-Item -ItemType File -Path database/database.sqlite

php artisan key:generate
php artisan migrate

npm install
npm run build

php artisan serve
```

---

## Dependencias principales

| Paquete | Versión | Uso |
|---|---|---|
| laravel/framework | ^11.0 | Framework principal |
| livewire/livewire | ^4.2 | Componentes reactivos |
| barryvdh/laravel-dompdf | ^3.1 | Generación de PDFs |
| laravel/breeze | ^2.4 | Autenticación (Blade) |
