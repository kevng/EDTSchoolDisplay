/* 	
	procedure.sql : Déclaration des procédures
	
	Version : 1.0
	Date dernière modification : 17/01/2018

*/

DROP PROCEDURE IF EXISTS insertData;
DROP PROCEDURE IF EXISTS deleteData;
DROP PROCEDURE IF EXISTS modifMessage;
DROP PROCEDURE IF EXISTS modifEvenement;

DELIMITER |

-- Procédure d'insertion des données du calendrier
CREATE PROCEDURE insertData(p_ressource VARCHAR(100), p_start DATETIME, p_end DATETIME, p_summary VARCHAR(100), p_location VARCHAR(50), p_descGroupe VARCHAR(50), p_descIntervenant VARCHAR(200), p_chevauchement INTEGER)
BEGIN

	INSERT INTO Calendrier (ressource, dtStart, dtEnd, summary, location, descGroupe, descIntervenant, chevauchement)
	VALUES(p_ressource, p_start, p_end, p_summary, p_location, p_descGroupe, p_descIntervenant, p_chevauchement);

END |

-- Procédure de suppression des données du calendrier
CREATE PROCEDURE deleteData (p_ressource VARCHAR(100))
BEGIN

	-- Suppression des évènements futurs pour les mettre à jour
	DELETE FROM Calendrier WHERE ressource = p_ressource AND WEEKDAY(dtStart) >= WEEKDAY(SYSDATE());
	-- Suppression des évènements antérieurs à la semaine courante
	DELETE FROM Calendrier WHERE ressource = p_ressource AND WEEKDAY(dtStart) < WEEKDAY(SYSDATE());

END |

-- Procédure de modification d'un message
CREATE PROCEDURE modifMessage(p_IDMessage INTEGER, p_message VARCHAR(500))
BEGIN

	UPDATE Message SET message = p_message, dateMessage = SYSDATE()
	WHERE IDMessage = p_IDMessage;

END |

-- Procédure de modification d'un evenement
CREATE PROCEDURE modifEvenement(p_IDEvenement INTEGER, p_evenement VARCHAR(500))
BEGIN

	/*INSERT INTO Evenement(IDEvenement,evenement) VALUES (p_IDEvenement, p_evenement);*/
	UPDATE Evenement SET evenement = p_evenement, dateEvenement = SYSDATE()
	WHERE IDEvenement = p_IDEvenement;

END |

DELIMITER ;
