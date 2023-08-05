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

