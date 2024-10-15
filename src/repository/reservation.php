<?php

    require_once("src/model/reservation.php");

    class ReservationRepository
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
                    "SELECT * FROM RU_reservation"
                );


                $statement->execute();
                
                $reservations = [];

                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {        
                    $reservation = new Reservation();
                    $reservation->reservation_id =$row['reservation_id'];
                    $reservation->description =$row['description'];
                    $reservation->jour =$row['jour'];
                    $reservation->debut =$row['debut'];
                    $reservation->fin =$row['fin'];
                    $reservation->salle =$row['salle'];
                    $reservation->employee =$row['employee'];

                    $reservations[]= $reservation;
                }
                
                return $reservations;
            }catch(Exception $e){ $GLOBALS['error'] = $e->getMessage(); }

        }

        public function save($reservation)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "INSERT INTO RU_reservation(reservation_id,description,jour,debut,fin,salle,employee) 
                    VALUES(:reservation_id,:description,:jour,:debut,:fin,:salle,:employee)"
                );

                $statement->bindParam(':reservation_id',$reservation->reservation_id);
                $statement->bindParam(':description',$reservation->description);
                $statement->bindParam(':jour',$reservation->jour);
                $statement->bindParam(':debut',$reservation->debut);
                $statement->bindParam(':fin',$reservation->fin);
                $statement->bindParam(':salle',$reservation->salle);
                $statement->bindParam(':employee',$reservation->employee);

                $statement->execute();
                                
                return $reservation;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

        public function delete($reservation)
        {
            try{
                
                $statement = $this->dbconnect->getConection()->prepare(
                    "DELETE FROM COU_reservation WHERE reservation_id = :reservation_id"
                );

                $statement->bindParam(':reservation_id',$reservation->reservation_id);

                $statement->execute();
                                
                return $reservation;

            }catch(Exception $e){$GLOBALS['error'] = $e->getMessage(); }

        }

    }