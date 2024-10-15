#Ma base de données : 

DROP TABLE IF EXISTS COU_sortant;
CREATE TABLE COU_sortant(
        numero     integer auto_increment,
        date_emmission     date,
        objet     varchar(255),
        numero_archivage     varchar(25),
        departement     varchar(255),
        destinataire     varchar(255),
        visa     varchar(25),
        observation     varchar(255),
        date_transmission     date,
        adresse_fichier     varchar(255),
        statut     varchar(25),
        reference     varchar(255),
        transmetteur     varchar(32),
        emmetteur     varchar(32),
        PRIMARY KEY (numero)
);



DROP TABLE IF EXISTS COU_entrant;
CREATE TABLE COU_entrant(
        numero     integer auto_increment,
        date_emmission     date,
        date_reception     date,
        objet     varchar(255),
        reference     varchar(255),
        numero_archivage     varchar(255),
        emmetteur     varchar(255),
        destinataire     varchar(32),
        observation     varchar(255),
        adresse_fichier     varchar(255),
        statut     varchar(25),
        PRIMARY KEY (numero)
);


