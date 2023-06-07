CREATE DATABASE hps;

use hps;

CREATE DATABASE psiquiatric_bd2;


create table fobia(
	nombre_fob INT auto_increment PRIMARY KEY NOT NULL,
	sintoma varchar(500) not null,
	n_fobia varchar(100) not null,
	descripcion varchar(200) not null
);

create  table usuarios(
	cod_usu varchar(10) not null primary key,
	nombre varchar(100) not null,
	app varchar(100) not null,
	apm varchar(100) not null,
	ci int not null,
	fecha_nac date not null,
	password varchar(30) not null,
        tipo VARCHAR(30) not null,
	estado VARCHAR(30) not null,
	correo VARCHAR(30) not null,
	celular INT not null,
	especialidad VARCHAR(100) NOT NULL
);

CREATE TABLE paciente(
        num_pac int auto_increment PRIMARY KEY,
        cod_pac varchar(10) not null,
	foreign key(cod_pac) references usuarios(cod_usu)
);


CREATE TABLE especialista(
        num_esp int auto_increment PRIMARY KEY,
        cod_esp varchar(10) not null,
	foreign key(cod_esp) references usuarios(cod_usu)
);


create table administrador(
	num_adm int auto_increment PRIMARY KEY,
        cod_adm varchar(10) not null,
	foreign key(cod_adm) references usuarios(cod_usu)
);

create  table atenciones(
	num_at int auto_increment PRIMARY KEY,
        cod_at varchar(10) not null,
	foreign key(cod_at) references usuarios(cod_usu)
);

create  table simulador(
	num_sim int auto_increment PRIMARY KEY,
        cod_sim varchar(10) not null,
	foreign key(cod_sim) references usuarios(cod_usu)	
);

create table medicacion(
	cod_medicacion INT auto_increment PRIMARY KEY NOT NULL,
	medicamento varchar(150) NOT NULL,
	cant_sem int not null,
	duracion varchar(10) not null,
	diario int not null,
	int_tiempo varchar(20) not null
);

CREATE TABLE simulacion(
        cod_simulacion INT PRIMARY KEY NOT NULL,
        nombre  VARCHAR(10) NOT NULL,
        descripcion  VARCHAR(150) NOT NULL,
        tipo_de_simulacion  VARCHAR(20) NOT NULL,
	tiempo_simulacion time NOT NULL,
	num_sim int NOT NULL,
	foreign key(num_sim) references simulador(num_sim)	
);


CREATE TABLE tratamiento (
        cod_tratamiento INT PRIMARY KEY NOT NULL,
        cod_simulacion INT NOT NULL,
	foreign key(cod_simulacion) references simulacion(cod_simulacion),
        cod_medicacion INT NOT NULL,
        foreign key(cod_medicacion) references medicacion(cod_medicacion),
	num_esp int not null,
	foreign key(num_esp) references especialista(num_esp)
);

CREATE TABLE evaluacion(
cod_evaluacion int auto_increment PRIMARY KEY,
observaciones VARCHAR(500) NOT NULL,
estado VARCHAR(5) NOT NULL,
fechaEv datetime NOT NULL,

cod_tratamiento INT NOT NULL,
foreign key(cod_tratamiento) references tratamiento(cod_tratamiento),

cod_simulacion int not null,
foreign key(cod_simulacion) references simulacion(cod_simulacion),

cod_medicacion int null,
foreign key(cod_medicacion) references medicacion(cod_medicacion),

num_pac int not null,
foreign key(num_pac) references paciente(num_pac),

nombre_fob int not null,
foreign key(nombre_fob) references fobia(nombre_fob),

num_esp int not null,
foreign key(num_esp) references especialista(num_esp)
);



CREATE TABLE historial(
cod_historial int auto_increment not null primary key,
num_pac int not null,
foreign key(num_pac) references paciente(num_pac),

num_esp int not null,
foreign key(num_esp) references especialista(num_esp),

nombre_fob int not null,
foreign key(nombre_fob) references fobia(nombre_fob),

cod_evaluacion int not null,
foreign key(cod_evaluacion) references evaluacion(cod_evaluacion)
);



create table cita (
cod_cita INT auto_increment PRIMARY KEY NOT NULL,
fechaProxima date NOT NULL,
fechaP datetime NOT NULL,
lugar varchar(200)NOT NULL,
num_pac int not null,
foreign key(num_pac) references paciente(num_pac),
num_esp int not null,
foreign key(num_esp) references especialista(num_esp),
estado varchar(20) not null
);

create table consultas (
cod_con INT auto_increment PRIMARY KEY NOT NULL,
cod_usu varchar(10) not null,
foreign key(cod_usu) references usuarios(cod_usu),
asunto varchar(200) NOT NULL,
fecha datetime NOT NULL,
num_at int NOT NULL,
foreign key(num_at) references atenciones(num_at),
estado varchar(20) NOT NULL
);


create table detalle_admUsu (
cod_adu INT auto_increment PRIMARY KEY NOT NULL,
fecha datetime NOT NULL,
cod_usu varchar(10) not null,
foreign key(cod_usu) references usuarios(cod_usu),
num_adm int,
foreign key(num_adm) references administrador(num_adm)
);