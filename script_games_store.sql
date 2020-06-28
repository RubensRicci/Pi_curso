drop database bd_games_store;

create database bd_games_store;
use bd_games_store;

create table tbGames(
idGame int auto_increment primary key,
nomeGame varchar(45) not null,
estiloGame varchar(45),
tempoGame int,
qtdeEstoque int not null,
precoGame decimal (5,2) not null,
imagemGame varchar(30) not null
);


insert into tbGames (nomeGame,estiloGame,tempoGame,qtdeEstoque,precoGame,imagemGame) values('Resident Evil','Ação, Aventura',10,100,'95.00','resident.png');


use bd_games_store;

create table tbClientes(
idCliente int auto_increment primary key,
nome varchar(50) not null,
email varchar(150) not null unique,
cpf varchar (11) not null unique,
endereco varchar(86),
numero int,
compl varchar(30),
cep int,
cidade varchar(30),
estado varchar(2),
senha varchar(220) not null
);

insert into tbClientes (nome,email,cpf,senha) values ('admin','admin','12345678901','$2y$10$gw6iiKQi/XqgA2GRru4XRuqG1cK0i2UHeE64c1IqV1FEE9VaWcwD2');


create table tbVendas(
idVenda int not null primary key,
dataVenda varchar(20) not null,
qtdeVenda int not null,
precoTotal varchar (100) not null,
idGame int not null,
idCliente int not null,
constraint vendGame foreign key (idGame) references tbGames (idGame),
constraint vendCli foreign key (idCliente) references tbClientes (idCliente)
);

select * from tbVendas;

use bd_games_store;
select * from tbClientes;
