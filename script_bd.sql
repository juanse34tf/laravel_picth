-- Script SQL base del Sistema de Gestion Avicola
-- Estructura alineada al diagrama ER oficial (8 tablas)

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL DEFAULT 'operario',
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE gastos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    descripcion VARCHAR(255) NOT NULL,
    monto DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE categorias (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE lotes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    estado VARCHAR(255) NOT NULL DEFAULT 'Activo',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

CREATE TABLE productos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id BIGINT UNSIGNED NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    precio_venta DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_productos_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id)
        ON DELETE CASCADE
);

CREATE TABLE ventas (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    producto_id BIGINT UNSIGNED NOT NULL,
    cantidad INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    fecha DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_ventas_producto
        FOREIGN KEY (producto_id) REFERENCES productos(id)
        ON DELETE CASCADE
);

CREATE TABLE produccions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lote_id BIGINT UNSIGNED NOT NULL,
    fecha DATE NOT NULL,
    tipo_huevo VARCHAR(255) NOT NULL,
    cantidad INT NOT NULL,
    observaciones TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_produccions_lote
        FOREIGN KEY (lote_id) REFERENCES lotes(id)
        ON DELETE CASCADE
);

CREATE TABLE alimentacions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    lote_id BIGINT UNSIGNED NOT NULL,
    tipo_alimento VARCHAR(100) NOT NULL,
    cantidad_kg DECIMAL(8,2) NOT NULL,
    fecha DATE NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_alimentacions_lote
        FOREIGN KEY (lote_id) REFERENCES lotes(id)
        ON DELETE CASCADE
);
