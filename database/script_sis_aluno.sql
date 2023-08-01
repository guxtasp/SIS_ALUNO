CREATE DATABASE SIS_ALUNO;
USE SIS_ALUNO ;

CREATE TABLE Aluno (
  idAluno INT AUTO_INCREMENT,
  nomeAluno VARCHAR(100),
  telefoneAluno VARCHAR(20),
  enderecoAluno VARCHAR(100),
  statusAluno CHAR(2),
  matriculaAluno CHAR(10),
  emailAluno VARCHAR(100),
  senhaAluno VARCHAR(45),
  dtaNascimentoAluno date,
  PRIMARY KEY (idAluno)
  );

CREATE TABLE Professor (
  idProfessor INT AUTO_INCREMENT,
  nomeProfessor VARCHAR(100) ,
  telefoneProfessor VARCHAR(20),
  enderecoProfessor VARCHAR(100),
  emailProfessor VARCHAR(100),
  dtaNascimentoProfessor date,
  statusProfessor bool,
  senhaProfessor VARCHAR(45),
  acessoProfessor CHAR(10),
  PRIMARY KEY (idProfessor)
  );

CREATE TABLE Disciplina (
  codDisciplina INT AUTO_INCREMENT,
  nomeDisciplina VARCHAR(45),
  Professor_idProfessor INT,
    cargaHoraria INT,
  PRIMARY KEY (codDisciplina),
  FOREIGN KEY (Professor_idProfessor) REFERENCES Professor(idProfessor)
  );
  

CREATE TABLE Cursa(
  Aluno_idAluno INT,
  Disciplina_codDisciplina INT,
  nota VARCHAR(4),
  ano CHAR(1),
  PRIMARY KEY (Aluno_idAluno, Disciplina_codDisciplina),
  FOREIGN KEY (Aluno_idAluno) REFERENCES Aluno (idAluno),
  FOREIGN KEY (Disciplina_codDisciplina) REFERENCES Disciplina (codDisciplina)
);

INSERT INTO Aluno (nomeAluno, telefoneAluno, enderecoAluno, statusAluno, matriculaAluno, emailAluno, senhaAluno, dtaNascimentoAluno) VALUES
('João da Silva', '(11) 98765-4321', 'Rua das Flores, 123', 'MT', '20230001', 'joao.silva@example.com', 'senhajoao', '2000-01-15'),
('Maria Souza', '(21) 99876-5432', 'Avenida dos Sonhos, 456', 'MT', '20230002', 'maria.souza@example.com', 'senhamaria', '1999-07-22'),
('Pedro Santos', '(31) 98765-1234', 'Travessa das Estrelas, 789', 'MI', '20230003', 'pedro.santos@example.com', 'senhapedro', '2001-03-05'),
('Ana Oliveira', '(11) 98888-7777', 'Praça da Alegria, 456', 'MT', '20230004', 'ana.oliveira@example.com', 'senhaana', '2002-11-10'),
('Lucas Costa', '(41) 99999-1111', 'Avenida das Montanhas, 789', 'MT', '20230005', 'lucas.costa@example.com', 'senhalucas', '2003-06-27'),
('Mariana Fernandes', '(21) 98765-2222', 'Rua do Mar, 123', 'MT', '20230006', 'mariana.fernandes@example.com', 'senhamariana', '2001-09-14'),
('Rafaela Lima', '(31) 98888-3333', 'Travessa da Floresta, 456', 'MI', '20230007', 'rafaela.lima@example.com', 'senharafaela', '2004-02-03'),
('Fernando Pereira', '(11) 98765-8888', 'Praça do Sol, 123', 'MT', '20230008', 'fernando.pereira@example.com', 'senhafernando', '2000-12-07'),
('Juliana Carvalho', '(41) 99999-4444', 'Avenida das Flores, 789', 'MT', '20230009', 'juliana.carvalho@example.com', 'senhajuliana', '2002-04-19'),
('Gustavo Rodrigues', '(21) 98888-5555', 'Rua das Águas, 456', 'MI', '20230010', 'gustavo.rodrigues@example.com', 'senhagustavo', '2003-08-31'),
('Camila Gomes', '(31) 98765-6666', 'Travessa dos Ventos, 789', 'MT', '20230011', 'camila.gomes@example.com', 'senhacamila', '2002-01-11'),
('Henrique Castro', '(11) 98888-9999', 'Praça da Lua, 123', 'MT', '20230012', 'henrique.castro@example.com', 'senhahenrique', '2001-05-23');


INSERT INTO Professor (nomeProfessor, telefoneProfessor, enderecoProfessor, emailProfessor, dtaNascimentoProfessor, statusProfessor, senhaProfessor, acessoProfessor)
VALUES
  ('John Doe', '123-456-7890', '123 Main St', 'john.doe@email.com', '1980-01-01', 1, 'password123', '1234567890'),
  ('Jane Smith', '987-654-3210', '456 Oak Ave', 'jane.smith@email.com', '1990-05-15', 1, 'password456', '0987654321'),
  ('Michael Johnson', '555-555-5555', '789 Maple Rd', 'michael.johnson@email.com', '1985-09-30', 0, 'pass123word', '1122334455'),
  ('Emily Davis', '111-222-3333', '101 Elm Blvd', 'emily.davis@email.com', '1982-07-22', 1, 'securepass', '6677889900'),
  ('Robert Wilson', '444-444-4444', '202 Pine Dr', 'robert.wilson@email.com', '1978-03-12', 0, 'password321', '5432167890'),
  ('Sarah Lee', '777-888-9999', '303 Cedar Ln', 'sarah.lee@email.com', '1992-11-25', 1, 'mysecretpw', '0099887766'),
  ('William Brown', '333-666-9999', '404 Birch Ave', 'william.brown@email.com', '1995-08-17', 0, 'topsecret', '9876543210'),
  ('Olivia Miller', '222-999-7777', '505 Oakwood Dr', 'olivia.miller@email.com', '1975-12-05', 1, 'myp@ssword', '1122334455'),
  ('James Wilson', '666-777-8888', '606 Maple Rd', 'james.wilson@email.com', '1988-06-20', 0, 'hello123', '6677889900'),
  ('Emma Johnson', '555-111-3333', '707 Elm Blvd', 'emma.johnson@email.com', '1998-04-09', 1, 'abc123', '5432167890'),
  ('David Davis', '222-222-3333', '808 Pine Dr', 'david.davis@email.com', '1984-02-28', 0, 'passpass', '0099887766'),
  ('Sophia Anderson', '111-444-7777', '909 Cedar Ln', 'sophia.anderson@email.com', '1987-10-14', 1, 'secure123', '9876543210'),
  ('Charles Moore', '777-222-1111', '1010 Birch Ave', 'charles.moore@email.com', '1972-11-02', 0, 'testing1', '1122334455'),
  ('Ava Taylor', '555-444-3333', '1111 Oakwood Dr', 'ava.taylor@email.com', '1993-07-08', 1, 'password!', '6677889900'),
  ('Daniel White', '444-777-9999', '1212 Maple Rd', 'daniel.white@email.com', '1996-01-18', 0, '123456', '5432167890'),
  ('Mia Martinez', '999-888-7777', '1313 Elm Blvd', 'mia.martinez@email.com', '1979-09-23', 1, 'qwerty', '0099887766'),
  ('Matthew Johnson', '666-111-9999', '1414 Pine Dr', 'matthew.johnson@email.com', '1986-05-07', 0, '123abc', '9876543210'),
  ('Isabella Garcia', '555-777-3333', '1515 Cedar Ln', 'isabella.garcia@email.com', '1991-03-29', 1, 'p@ssword', '1122334455'),
  ('Andrew Smith', '333-777-9999', '1616 Birch Ave', 'andrew.smith@email.com', '1999-12-12', 0, 'hello456', '6677889900'),
  ('Evelyn Johnson', '222-444-3333', '1717 Oakwood Dr', 'evelyn.johnson@email.com', '1983-08-26', 1, 'qwerty123', '5432167890');

SELECT * FROM Professor;
INSERT INTO Disciplina (nomeDisciplina, Professor_idProfessor, cargaHoraria)
VALUES
  ('Matemática', 23, 60),
  ('História', 25, 45),
  ('Física', 24, 90),
  ('Química', 26, 75),
  ('Biologia', 27, 60),
  ('Inglês', 29, 30),
  ('Ciência da Computação', 31, 90),
  ('Geografia', 33, 45),
  ('Literatura', 35, 60),
  ('Arte', 37, 30),
  ('Educação Física', 39, 60),
  ('Economia', 41, 45),
  ('Música', 42, 30),
  ('Psicologia', 40, 75),
  ('Sociologia', 38, 60),
  ('Filosofia', 36, 45),
  ('Espanhol', 34, 30),
  ('Engenharia Química', 32, 90),
  ('Direito', 30, 75),
  ('Medicina', 28, 60);