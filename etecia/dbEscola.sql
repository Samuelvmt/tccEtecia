DROP DATABASE IF EXISTS dbescola;

CREATE DATABASE dbescola;

USE dbescola;

-- Tabela de Funcionários
CREATE TABLE tbFuncionario (
    func_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    tel CHAR(14) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    cep CHAR(9) NOT NULL,
    bairro VARCHAR(80) NOT NULL,
    numero VARCHAR(5) NOT NULL,
    cargo VARCHAR(50) NOT NULL,
    PRIMARY KEY (func_id)
);

INSERT INTO tbFuncionario (nome, cpf, email, tel, endereco, cep, bairro, numero, cargo) 
VALUES ('Jose Leal', '325.543.123-12', 'joseleal@gmail.com', '95342-5088', 'Rua do Limoeiro', '04653-220', 'Limões', '129', 'secretario');

-- Tabela de Disciplinas
CREATE TABLE tbDisciplina (
    disc_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL UNIQUE,
    carga_hr INT NOT NULL,
    PRIMARY KEY (disc_id)
);

INSERT INTO tbDisciplina (nome, carga_hr) 
VALUES ('Matematica', 40);

-- Tabela de Alunos
CREATE TABLE tbAluno (
    aluno_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    rg CHAR(12) NOT NULL UNIQUE,
    cpf CHAR(14) NOT NULL UNIQUE,
    data_nasc DATE NOT NULL,
    sexo CHAR(1) NOT NULL CHECK (sexo IN ('M', 'F')),
    endereco VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    tel_cel CHAR(10) NOT NULL,
    nom_pai VARCHAR(50) NOT NULL,
    nom_mae VARCHAR(50) NOT NULL,
    responsavel VARCHAR(50) NULL,
    PRIMARY KEY (aluno_id)
);

INSERT INTO tbAluno (nome, rg, cpf, data_nasc, sexo, endereco, email, tel_cel, nom_pai, nom_mae, responsavel) 
VALUES ('Enzo Silva', '44.123.658-9', '375.143.023-12', '2008-10-05', 'M', 'Av dos Lagos 125', 'enzosilva@gmail.com', '95342-5088', 'Luiz Carlos', 'Maria Luisa', NULL),
       ('Jalin', '54.123.658-9', '455.143.023-12', '2010-10-05', 'M', 'Av dos Lagos 126', 'jalin@gmail.com', '95352-5074', 'Rogerio', 'Veronica', NULL);

-- Tabela de Usuários
CREATE TABLE tbUsuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tbAluno(aluno_id) ON DELETE CASCADE
);

INSERT INTO tbUsuario (id_aluno, login, senha) VALUES 
(1, 'abud', '123'),
(2, 'abudab', '1234');

-- Tabela de Turmas
CREATE TABLE tbTurma (
    turma_id INT NOT NULL AUTO_INCREMENT,
    func_id INT NOT NULL,
    disc_id INT NOT NULL,
    ini_data DATE NOT NULL,
    fin_data DATE NOT NULL,
    PRIMARY KEY (turma_id),
    FOREIGN KEY (func_id) REFERENCES tbFuncionario(func_id),
    FOREIGN KEY (disc_id) REFERENCES tbDisciplina(disc_id)
);

INSERT INTO tbTurma (func_id, disc_id, ini_data, fin_data) 
VALUES (1, 1, '2024-02-10', '2024-12-05');

-- Tabela de Matrículas
CREATE TABLE tbMatricula (
    mat_id INT NOT NULL AUTO_INCREMENT,
    disc_id INT NOT NULL,
    aluno_id INT NOT NULL,
    mat_data DATE NOT NULL,
    PRIMARY KEY (mat_id),
    FOREIGN KEY (disc_id) REFERENCES tbDisciplina(disc_id),
    FOREIGN KEY (aluno_id) REFERENCES tbAluno(aluno_id)
);

INSERT INTO tbMatricula (disc_id, aluno_id, mat_data) 
VALUES (1, 1, '2024-01-21');

-- Tabela de Notas
CREATE TABLE tbNotas (
    nota_id INT NOT NULL AUTO_INCREMENT,
    mat_id INT NOT NULL,
    nota DECIMAL(5,2) CHECK (nota BETWEEN 0 AND 10) NOT NULL,
    PRIMARY KEY (nota_id),
    FOREIGN KEY (mat_id) REFERENCES tbMatricula(mat_id) ON DELETE CASCADE
);

-- Tabela de Faltas
CREATE TABLE tbFaltas (
    falta_id INT NOT NULL AUTO_INCREMENT,
    mat_id INT NOT NULL,
    data_falta DATE NOT NULL,
    PRIMARY KEY (falta_id),
    FOREIGN KEY (mat_id) REFERENCES tbMatricula(mat_id) ON DELETE CASCADE
);

-- Exibir a estrutura das tabelas
DESC tbFuncionario;
DESC tbDisciplina;
DESC tbAluno;
DESC tbTurma;
DESC tbMatricula;
DESC tbUsuario;
DESC tbNotas;
DESC tbFaltas;

-- Exibir os registros das tabelas
SELECT * FROM tbFuncionario;
SELECT * FROM tbDisciplina;
SELECT * FROM tbAluno;
SELECT * FROM tbTurma;
SELECT * FROM tbMatricula;
SELECT * FROM tbUsuario;
SELECT * FROM tbNotas;
SELECT * FROM tbFaltas;
