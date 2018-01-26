/* 	
	createTable.sql : Déclaration des tables
	
	Version : 1.0
	Date dernière modification : 17/01/2018

*/

DROP TABLE IF EXISTS Calendrier;
DROP TABLE IF EXISTS Ressource;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Evenement;
DROP TABLE IF EXISTS Carte;

CREATE TABLE Calendrier(
	IDEvent INTEGER PRIMARY KEY AUTO_INCREMENT,
	ressource VARCHAR(100),
	dtStart DATETIME,
	dtEnd DATETIME,
	summary VARCHAR(100),
	location VARCHAR(50),
	descGroupe VARCHAR(50),
	descIntervenant VARCHAR(200),
	chevauchement INTEGER
);

CREATE TABLE Ressource(
	ressource VARCHAR(100) PRIMARY KEY,
	formation VARCHAR(50) NOT NULL,
	majeure VARCHAR(10) NOT NULL,
	groupe VARCHAR(10) NOT NULL
);

CREATE TABLE Message(
	IDMessage INTEGER PRIMARY KEY,
	dateMessage DATETIME,
	message VARCHAR(200)
);

CREATE TABLE Evenement(
	IDEvenement INTEGER PRIMARY KEY,
	dateEvenement DATETIME,
	evenement VARCHAR(200)
);

CREATE TABLE Carte(
	uid VARCHAR(100) PRIMARY KEY,
	formation VARCHAR(50) NOT NULL,
	majeure VARCHAR(10) NOT NULL,
	groupe VARCHAR(10) NOT NULL
);
