-- Banco do projeto "Opinião" (PHP + MySQL)
-- Importe no phpMyAdmin ou rode: mysql -u root -p < banco.sql

CREATE DATABASE IF NOT EXISTS crud
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE crud;

CREATE TABLE IF NOT EXISTS usuarios (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  nome      VARCHAR(60)  NOT NULL UNIQUE,
  email     VARCHAR(120) NOT NULL UNIQUE,
  senha     VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS opnioes (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  titulo     VARCHAR(120) NOT NULL,
  opniao     TEXT         NOT NULL,
  usuario_id INT          NOT NULL,
  criado_em  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_opniao_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE
);

CREATE INDEX idx_opnioes_usuario ON opnioes (usuario_id);
