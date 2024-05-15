-----------------------------------------------
-- CRIANDO BANCO DE DADO
-----------------------------------------------
CREATE DATABASE IF NOT EXISTS reserva_sala;
USE reserva_sala;

-----------------------------------------------
-- TABELAS
-----------------------------------------------
CREATE TABLE IF NOT EXISTS sala (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Tipo_ID INT NOT NULL,
    Capacidade INT NOT NULL,
    FOREIGN KEY (Tipo_ID) REFERENCES tipo_sala(Id)
);

CREATE TABLE IF NOT EXISTS tipo_sala(
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Tipo VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS docente (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS curso (
	Id INT AUTO_INCREMENT PRIMARY KEY,
	Nome VARCHAR(150) NOT NULL,
    Sigla VARCHAR(30) NOT NULL,
    SubArea_ID INT,
    FOREIGN KEY (SubArea_ID) REFERENCES subarea(Id) 
);

CREATE TABLE IF NOT EXISTS subarea (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(150) NOT NULL,
    Cor VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS turma (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Docente_ID INT,
    Curso_ID INT,
    Cod_Turma VARCHAR(50) NOT NULL,
    Periodo ENUM("Manhâ", "Tarde", "Noite"),
    Ativo TINYINT(1) DEFAULT 1,
    FOREIGN KEY (Curso_ID) REFERENCES curso(Id),
    FOREIGN KEY (Docente_ID) REFERENCES docente(Id)
);

CREATE TABLE IF NOT EXISTS reserva (
	Id INT AUTO_INCREMENT PRIMARY KEY,
    Sala_ID INT,
    Turma_ID INT,
    Status ENUM("Livre", "Reservado", "Manuteçâo"),
    Data_Inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    Data_FIM DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    Dias_Semana VARCHAR(50),
    FOREIGN KEY (Turma_ID) REFERENCES Turma(Id),
    FOREIGN KEY (Sala_ID) REFERENCES Sala(Id)
);

insert into turma (Id, Docente_ID, Curso_ID, Cod_Turma, Periodo, Ativo) VALUES
	(null, 1, 1, "TII04", "Noite", null);
    
insert into docente (Nome) VALUES
	("Aécio");
    
insert into curso (Id, Nome, Sigla, SubArea_ID) VALUES
	(null, "Técnico em informática para internet", "TII", 1);

insert into subarea (Id, Nome, Cor) VALUES
	(null, "Técnologia", "Red");

insert into sala (Id, Tipo_ID, Capacidade) VALUES
	(null, 1, 30);
    
insert into tipo_sala (Id, Tipo) values
	(null, "lab. Informática");
    
insert into reserva (Id, Sala_ID, Turma_ID, Status, Data_Inicio, Data_FIM, Dias_Semana) VALUES
	(null, 1, 1, "Livre", null, null, "seg/sex");


