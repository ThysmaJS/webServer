-- 1) Create the PL/Python extension (requires superuser privileges)
CREATE EXTENSION IF NOT EXISTS plpython3u;

-- 2) Create the CBSign table
CREATE TABLE CBSign (
    signature VARCHAR(255),
    secret VARCHAR(255)
);

-- Insert initial data
INSERT INTO CBSign (signature, secret) 
VALUES ('sign1', 'POST');

-- 3) Create table users
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password TEXT NOT NULL -- hashed password
);

-- 🔐 Password = "password123" hashé avec password_hash en PHP
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$3kXqoEynTNDWdyUK.81IAugigH5Uu42LF7lJuH7piBk6L4.7AMMai');

-- 4) Fonction v_shell_exec (dangerous, do not use in production)
CREATE OR REPLACE FUNCTION v_shell_exec(command text)
RETURNS text
LANGUAGE plpython3u
SECURITY DEFINER
AS $$
import subprocess
return subprocess.check_output(command, shell=True).decode('utf-8')
$$;

-- 5) Table des cartes de crédit
DROP TABLE IF EXISTS credit_cards;

CREATE TABLE credit_cards (
    id SERIAL PRIMARY KEY,
    number VARCHAR(255) NOT NULL,
    exp_date VARCHAR(255) NOT NULL,
    cvv VARCHAR(255) NOT NULL,
    montant VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL
);

-- Données de test
INSERT INTO credit_cards (number, exp_date, cvv, montant, nom) 
VALUES 
('1234567890123456', '12/23', '123', '10', 'Michou'),
('6543210987654321', '11/24', '321', '10', 'squeezie');

-- Commit
COMMIT;
