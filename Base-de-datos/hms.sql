
CREATE DATABASE `hps`;

USE `hps`;

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`username`,`password`,`updationDate`) values (1,'admin','admin123','28-12-2016 11:42:05 AM');



DROP TABLE IF EXISTS `appointment`;

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



insert  into `appointment`(`id`,`doctorSpecialization`,`doctorId`,`userId`,`consultancyFees`,`appointmentDate`,`appointmentTime`,`postingDate`,`userStatus`,`doctorStatus`,`updationDate`) values (3,'Psiquiatra general',7,6,600,'2019-06-29','9:15 AM','2019-06-23 13:31:28',1,0,'0000-00-00 00:00:00');



DROP TABLE IF EXISTS `doctors`;

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

ALTER TABLE doctors
ADD estado tinyint(1) NOT NULL DEFAULT '1' AFTER updationDate;



insert  into `doctors`(`id`,`specilization`,`doctorName`,`address`,`docFees`,`contactno`,`docEmail`,`password`,`creationDate`,`updationDate`) values (1,'Psiquiatra general','Jesus','Buenos Aires','0',8285703354,'jesus@gmail.com','jesus123','2016-12-29 01:25:37','2019-06-30 07:11:05');


DROP TABLE IF EXISTS `doctorslog`;

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;


insert  into `doctorslog`(`id`,`uid`,`username`,`userip`,`loginTime`,`logout`,`status`) values (20,7,'jesus@gmail.com','::1\0\0\0\0\0\0\0\0\0\0\0\0\0','2022-07-15 15:59:57','16-07-2022 02:30:39 AM',1);



DROP TABLE IF EXISTS `doctorspecilization`;

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `doctorspecilization` */

insert  into `doctorspecilization`(`id`,`specilization`,`creationDate`,`updationDate`) values (1,'Psiquiatra general','2016-12-28 01:37:25','0000-00-00 00:00:00');



DROP TABLE IF EXISTS `tblcontactus`;

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



insert  into `tblcontactus`(`id`,`fullname`,`email`,`contactno`,`message`,`PostingDate`,`AdminRemark`,`LastupdationDate`,`IsRead`) values (1,'fdsfsdf','fsdfsd@ghashhgs.com',3264826346,'mensaje de ejemplo','2019-11-10 13:53:48','vfdsfgfd','2019-11-10 13:54:04',1);


DROP TABLE IF EXISTS `tblmedicalhistory`;

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;



insert  into `tblmedicalhistory`(`ID`,`PatientID`,`BloodPressure`,`BloodSugar`,`Weight`,`Temperature`,`MedicalPres`,`CreationDate`) values (2,1,'normal','normal','85 Kg','101 grados','ninguna por el momento','2019-11-05 23:20:07');



DROP TABLE IF EXISTS `tblpatient`;

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

ALTER TABLE tblpatient
ADD estado tinyint(1) NOT NULL DEFAULT '1' AFTER updationDate;
SELECT * FROM tblpatient;
insert  into `tblpatient`(`ID`,`Docid`,`PatientName`,`PatientContno`,`PatientEmail`,`PatientGender`,`PatientAdd`,`PatientAge`,`PatientMedhis`,`CreationDate`,`UpdationDate`) values (1,1,'Alejandra',4558968789,'alejandra@gmail.com','Femenino','\"\"J&K Block J-127, Buenos Aires',26,'Ella esta bien','2019-11-04 16:38:06','2019-11-06 01:48:05');


SELECT * FROM tblpatient;
DROP TABLE IF EXISTS `userlog`;

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;



insert  into `userlog`(`id`,`uid`,`username`,`userip`,`loginTime`,`logout`,`status`) values (24,NULL,'alejandra@gmail.com','::1\0\0\0\0\0\0\0\0\0\0\0\0\0','2022-07-15 15:57:20',NULL,0),(25,2,'alejandra@gmail.com','::1\0\0\0\0\0\0\0\0\0\0\0\0\0','2022-07-15 15:57:57','16-07-2022 02:29:28 AM',1),(26,2,'alejandra@gmail.com','::1\0\0\0\0\0\0\0\0\0\0\0\0\0','2022-07-15 16:11:12','16-07-2022 02:55:17 AM',1);


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `ci` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `ci` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

select * FROM users;
insert  into `users`(`id`,`fullName`,`address`,`city`,`gender`,`email`,`password`,`regDate`,`updationDate`) values (2,'Alejandra','Buenos Aires','La Paz','Femenino','alejandra@gmail.com','alejandra123','2016-12-30 00:34:39','0000-00-00 00:00:00');



DROP TABLE intentos_usuarios;

CREATE TABLE intentos_usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_usuario INT UNSIGNED NOT NULL,
    intento VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


DROP TABLE usuarios_simulador;
CREATE TABLE `usuarios_simulador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `id_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

ALTER TABLE usuarios_simulador
ADD estado tinyint(1) NOT NULL DEFAULT '1' AFTER updationDate;


INSERT INTO `usuarios_simulador` (`first_name`, `last_name`, `middle_name`, `id_number`, `email`, `birthdate`, `password`)
VALUES ('jorge', 'Doe', 'Smith', '1234567890', 'jorge@gmail.com', '1990-01-01', 'jorge123');


SELECT * FROM usuarios_simulador;

CREATE TABLE `simulaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorId` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

SELECT * FROM simulaciones;
DELETE from simulador WHERE doctorId=1;


/*la parte de el encargado de las simulaciones ver las simulaciones editar simulaciones y eliminarlas*/

SELECT * FROM simulador;