-- database.sql - Praktikum 9 (Sairin bin Rubad - 312510134)
-- Impor melalui phpMyAdmin atau: mysql -u root < database.sql

CREATE DATABASE IF NOT EXISTS db_latihan
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_latihan;

CREATE TABLE IF NOT EXISTS users (
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nama       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    no_hp      VARCHAR(20)  DEFAULT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_users_email (email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admin (
    id       INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(50)  NOT NULL,
    nama     VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_admin_username (username)
) ENGINE=InnoDB;

-- Akun login: username "admin" / password "admin123" (disimpan sebagai hash bcrypt)
INSERT INTO admin (username, nama, password) VALUES
('admin', 'Sairin bin Rubad', '$2y$12$fZ27mWqrdgwOFf1IAk0xbO0Nka.7Iwh9SWg4./g5AKeiFXvskdP1y');

INSERT INTO users (nama, email, no_hp) VALUES
('Rina Marlina',    'rina@example.com',   '081234567801'),
('Budi Santoso',    'budi@example.com',   '081234567802'),
('Siti Aminah',     'siti@example.com',   '081234567803'),
('Andi Wijaya',     'andi@example.com',   '081234567804'),
('Dewi Lestari',    'dewi@example.com',   '081234567805');
