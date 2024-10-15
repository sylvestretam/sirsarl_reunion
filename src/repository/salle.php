<?php

    require_once("src/model/salle.php");

    class SalleRepository
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
                    "SELECT * FROM RU_salle"
                );


                $statement->execute();
                
                $salles = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $salle = new Salle();
                    $salle->designation =$row['designation'];
                    $salle->code =$row['code'];

                    $salles[]= $salle;
                }
                
                return $salles;
            }catch(Exception $e){ $GLOBALS['error'] = $e->getMessage(); }

        }

    }