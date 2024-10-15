#Ma base de données REUNION: 

DROP TABLE IF EXISTS RU_salle;
CREATE TABLE RU_salle(
        code     varchar(25),
        designation     varchar(128),
        PRIMARY KEY (code)
);


-- DROP TABLE IF EXISTS employee;
-- CREATE TABLE employee(
--         matricule     varchar(25),
--         PRIMARY KEY (matricule)
-- );


DROP TABLE IF EXISTS RU_reservation;
CREATE TABLE RU_reservation(
        reservation_id     varchar(25),
        description     varchar(128),
        jour     date,
        debut     time,
        fin     time,
        salle     varchar(25),
        employee     varchar(25),
        PRIMARY KEY (reservation_id)
);


ALTER TABLE RU_reservation ADD CONSTRAINT FK_RU_reservation_salle FOREIGN KEY (salle) REFERENCES RU_salle(code);
ALTER TABLE RU_reservation ADD CONSTRAINT FK_RU_reservation_employee FOREIGN KEY (employee) REFERENCES at_employee(matricule);