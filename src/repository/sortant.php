<?php

    require_once("src/model/sortant.php");

    class SortantRepository
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
                    "SELECT * FROM COU_sortant"
                );


                $statement->execute();
                
                $courriers = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $courrier = new Sortant();
                    $courrier->numero = $row['numero'];
                    $courrier->date_emmission = $row['date_emmission'];
                    $courrier->objet = $row['objet'];
                    $courrier->reference = $row['reference'];
                    $courrier->numero_archivage = $row['numero_archivage'];
                    $courrier->emmetteur = $row['emmetteur'];
                    $courrier->destinataire = $row['destinataire'];
                    $courrier->observation = $row['observation'];
                    $courrier->adresse_fichier = $row['adresse_fichier'];
                    $courrier->statut = $row['statut'];
                    $courrier->departement = $row['departement'];
                    $courrier->date_transmission = $row['date_transmission'];
                    $courrier->transmetteur = $row['transmetteur'];
                    $courrier->visa = $row['visa'];

                    $courriers[] = $courrier;
                }
                
                return $courriers;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO COU_sortant(date_emmission,objet,reference,numero_archivage,emmetteur,destinataire,observation,
                    adresse_fichier,statut,departement,date_transmission,transmetteur,visa) 
                    VALUES(:date_emmission,:objet,:reference,:numero_archivage,:emmetteur,:destinataire,:observation,:adresse_fichier,:statut
                    ,:departement,:date_transmission,:transmetteur,:visa)"
                );

                $statement->bindParam(':date_emmission',$exercice->date_emmission);
                $statement->bindParam(':objet',$exercice->objet);
                $statement->bindParam(':reference',$exercice->reference);
                $statement->bindParam(':numero_archivage',$exercice->numero_archivage);
                $statement->bindParam(':emmetteur',$exercice->emmetteur);
                $statement->bindParam(':destinataire',$exercice->destinataire);
                $statement->bindParam(':observation',$exercice->observation);
                $statement->bindParam(':adresse_fichier',$exercice->adresse_fichier);
                $statement->bindParam(':statut',$exercice->statut);
                $statement->bindParam(':departement',$exercice->departement);
                $statement->bindParam(':date_transmission',$exercice->date_transmission);
                $statement->bindParam(':transmetteur',$exercice->transmetteur);
                $statement->bindParam(':visa',$exercice->visa);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateStatus($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE COU_sortant 
                        SET statut = :statut 
                        WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$exercice->numero);
                $statement->bindParam(':statut',$exercice->statut);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function updateVisa($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "UPDATE COU_sortant 
                        SET visa = :visa 
                        WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$exercice->numero);
                $statement->bindParam(':visa',$exercice->visa);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($exercice)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM COU_sortant WHERE numero = :numero"
                );

                $statement->bindParam(':numero',$exercice->numero);

                $statement->execute();
                                
                return $exercice;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }


    }