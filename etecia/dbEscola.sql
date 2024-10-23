DROP DATABASE IF EXISTS dbescola;

CREATE DATABASE dbescola;

USE dbescola;
 
CREATE TABLE tbFuncionario (

    func_id INT NOT NULL AUTO_INCREMENT,

    nome VARCHAR(100) NOT NULL,

    cpf VARCHAR(14) NOT NULL UNIQUE,

    email VARCHAR(70) NOT NULL,

    tel VARCHAR(14) NOT NULL,

    end VARCHAR(80) NOT NULL,

    cep VARCHAR(9) NOT NULL,

    bair VARCHAR(80) NOT NULL,

    numer VARCHAR(3) NOT NULL,

    cargo VARCHAR(50) NOT NULL,

    PRIMARY KEY (func_id)

);
 
INSERT INTO tbFuncionario (nome, cpf, email,tel, end, cep, bair, numer, cargo) 

VALUES ('Jose Leal', '325.543.123-12', 'joseleal@gmail.com','95342-5088', 'Rua do Limoeiro', '04653-220', 'Limõezes','129', 'secretario');
 
CREATE TABLE tbDisciplina (

    disc_id INT NOT NULL AUTO_INCREMENT,

    nome VARCHAR(50) NOT NULL,

    carga_hr INT NOT NULL,

    PRIMARY KEY (disc_id)

);
 
INSERT INTO tbDisciplina (nome, carga_hr) 

VALUES ('Matematica', 40);
 
CREATE TABLE tbAluno (

    aluno_id INT NOT NULL AUTO_INCREMENT,

    nome VARCHAR(100) NOT NULL,

    rg VARCHAR(12) NOT NULL UNIQUE,

    cpf VARCHAR(14) NOT NULL UNIQUE,

    dataNasc DATE NOT NULL,

    sexo CHAR(1) NOT NULL,

    end VARCHAR(80) NOT NULL,

    email VARCHAR(70) NOT NULL,

    tel_cel VARCHAR(10) NOT NULL,

    nom_pai VARCHAR(50) NOT NULL,

    nom_mae VARCHAR(50) NOT NULL,

    resp VARCHAR(50) NULL,

    PRIMARY KEY (aluno_id)

);
 

INSERT INTO tbAluno (nome, rg, cpf, dataNasc, sexo, end, email, tel_cel, nom_pai, nom_mae, resp) 

VALUES ('Enzo Silva', '44.123.658-9', '375.143.023-12', '2008-10-05', 'M', 'Av dos Lagos 125', 'enzosilva@gmail.com', '95342-5088', 'Luiz Carlos', 'Maria Luisa', NULL);

INSERT INTO tbAluno (nome, rg, cpf, dataNasc, sexo, end, email, tel_cel, nom_pai, nom_mae, resp) 

VALUES ('jalin', '54.123.658-9', '455.143.023-12', '2010-10-05', 'M', 'Av dos Lagos 126', 'jalin@gmail.com', '95352-5074', 'rogerio', 'veronica', NULL);
 

CREATE TABLE tbUsuario (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_aluno) REFERENCES tbAluno(aluno_id) ON DELETE CASCADE
);

INSERT INTO tbUsuario(id_aluno,login,senha)VALUES ('1','abud','123');
INSERT INTO tbUsuario(id_aluno,login,senha)VALUES ('2','abudab','1234');

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
 
-- Visualizando a estrutura das tabelas

DESC tbFuncionario;

DESC tbDisciplina;

DESC tbAluno;

DESC tbTurma;

DESC tbMatricula;
 
DESC tbUsuario;

-- Visualizando os registros das tabelas

SELECT * FROM tbFuncionario;

SELECT * FROM tbDisciplina;

SELECT * FROM tbAluno;

SELECT * FROM tbTurma;

SELECT * FROM tbMatricula;

SELECT * FROM tbUsuario;

 