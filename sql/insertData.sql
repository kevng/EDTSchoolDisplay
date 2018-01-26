/* 	
	insertData.sql : Insertion des données, initialisation de la bdd
	
	Version : 1.0
	Date dernière modification : 17/01/2018

*/

INSERT INTO Ressource(formation, majeure, groupe, ressource) VALUES
('ING5-APP', 'SI', '1', '01'),
('ING5-APP', 'SE', '1', '02'),
('ING5-APP', 'OCRES', '1', '03'),
('ING5', 'TM', '1', '04'),

INSERT INTO Message(IDMessage, dateMessage, message) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL);
