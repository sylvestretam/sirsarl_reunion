<?php

    require_once("src/model/entrant.php");

    class EntrantRepository
    {
        private $dbconnect;

        public function __construct($dbconnect)
        {
            $this->dbconnect = $dbconnect;
        }

        public function getAll()
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "SELECT * FROM COU_entrant"
                );


                $statement->execute();
                
                $courriers = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $courrier = new Entrant();
                    $courrier->numero = $row['numero'];
                    $courrier->date_emmission = $row['date_emmission'];
                    $courrier->date_reception = $row['date_reception'];
                    $courrier->objet = $row['objet'];
                    $courrier->reference = $row['reference'];
                    $courrier->numero_archivage = $row['numero_archivage'];
                    $courrier->emmetteur = $row['emmetteur'];
                    $courrier->destinataire = $row['destinataire'];
                    $courrier->observation = $row['observation'];
                    $courrier->adresse_fichier = $row['adresse_fichier'];
                    $courrier->statut = $row['statut'];

                    $courriers[] = $courrier;
                }
                
                return $courriers;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO COU_entrant(date_emmission,date_reception,objet,reference,numero_archivage,emmetteur,destinataire,observation,adresse_fichier,statut) 
                    VALUES(:date_emmission,:date_reception,:objet,:reference,:numero_archivage,:emmetteur,:destinataire,:observation,:adresse_fichier,:statut)"
                );

                $statement->bindParam(':date_emmission',$exercice->date_emmission);
                $statement->bindParam(':date_reception',$exercice->date_reception);
                $statement->bindParam(':objet',$exercice->objet);
                $statement->bindParam(':reference',$exercice->reference);
                $statement->bindParam(':numero_archivage',$exercice->numero_archivage);
                $statement->bindParam(':emmetteur',$exercice->emmetteur);
                $statement->bindParam(':destinataire',$exercice->destinataire);
                $statement->bindParam(':observation',$exercice->observation);
                $statement->bindParam(':adresse_fichier',$exercice->adresse_fichier);
                $statement->bindParam(':statut',$exercice->statut);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatus($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE COU_entrant 
                        SET statut = :statut 
                        WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$exercice->numero);
                $statement->bindParam(':statut',$exercice->statut);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM COU_entrant WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$exercice->numero);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }