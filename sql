CREATE TABLE administradores (
idAdmin INT(10) AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(5000) NOT NULL,
password VARCHAR (5000) NOT NULL
);

INSERT INTO administradores(username, password) VALUES ("admin", "8fa3c355de358108f41179f2c27259887b650b105be7f281c28bd4d4aec340b1");

CREATE TABLE mensagens (
idMensagem INT(10) AUTO_INCREMENT PRIMARY KEY,
mensagem VARCHAR (5000) NOT NULL,
aprovacao INT(1) NOT NULL,
adminResponsavel VARCHAR (5000) 
);



