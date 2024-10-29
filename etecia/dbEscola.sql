DROP DATABASE IF EXISTS dbescola;

CREATE DATABASE dbescola;

USE dbescola;

-- Tabela de Funcionários
CREATE TABLE tbFuncionario (
    func_id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    cpf CHAR(11) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    tel VARCHAR(15) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    cep CHAR(8) NOT NULL,
    bairro VARCHAR(80) NOT NULL,
    numero VARCHAR(5) NOT NULL,
    cargo VARCHAR(50) NOT NULL,
    PRIMARY KEY (func_id)
);

INSERT INTO tbFuncionario (nome, cpf, email, tel, endereco, cep, bairro, numero, cargo) 
VALUES ('Jose Leal', '32554312312', 'joseleal@gmail.com', '953425088', 'Rua do Limoeiro', '04653220', 'Limões', '129', 'secretario');

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
    rg CHAR(9) NOT NULL UNIQUE,
    cpf CHAR(11) NOT NULL UNIQUE,
    data_nasc DATE NOT NULL,
    sexo CHAR(1) NOT NULL,
    endereco VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    tel_cel VARCHAR(15) NOT NULL,
    nom_pai VARCHAR(50) NOT NULL,
    nom_mae VARCHAR(50) NOT NULL,
    responsavel VARCHAR(50) NULL,
    PRIMARY KEY (aluno_id)
);

INSERT INTO tbAluno (nome, rg, cpf, data_nasc, sexo, endereco, email, tel_cel, nom_pai, nom_mae, responsavel) 
VALUES ('Enzo Silva', '441236589', '37514302312', '2008-10-05', 'M', 'Av dos Lagos 125', 'enzosilva@gmail.com', '953425088', 'Luiz Carlos', 'Maria Luisa', NULL),
       ('Jalin', '541236589', '45514302312', '2010-10-05', 'M', 'Av dos Lagos 126', 'jalin@gmail.com', '953525074', 'Rogerio', 'Veronica', NULL);

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

-- Tabela combinada de Notas e Faltas
CREATE TABLE tbNotasFaltas (
    id INT NOT NULL AUTO_INCREMENT,
    mat_id INT NOT NULL,
    nota DECIMAL(5,2) NOT NULL,
    data_falta DATE NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (mat_id) REFERENCES tbMatricula(mat_id) ON DELETE CASCADE
);

-- Inserindo dados de exemplo na tabela combinada
INSERT INTO tbNotasFaltas (mat_id, nota, data_falta) 
VALUES (1, 8.5, NULL),  -- Nota para matrícula 1
       (1, NULL, '2024-02-15');  -- Falta para matrícula 1

-- Exibir a estrutura das tabelas
SHOW CREATE TABLE tbFuncionario;
SHOW CREATE TABLE tbDisciplina;
SHOW CREATE TABLE tbAluno;
SHOW CREATE TABLE tbTurma;
SHOW CREATE TABLE tbMatricula;
SHOW CREATE TABLE tbUsuario;
SHOW CREATE TABLE tbNotasFaltas;

-- Exibir os registros das tabelas
SELECT * FROM tbFuncionario;
SELECT * FROM tbDisciplina;
SELECT * FROM tbAluno;
SELECT * FROM tbTurma;
SELECT * FROM tbMatricula;
SELECT * FROM tbUsuario;
SELECT * FROM tbNotasFaltas;
