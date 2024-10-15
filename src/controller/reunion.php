<?php
    require_once('src/repository/reservation.php');
    require_once('src/repository/salle.php');
    require_once('src/repository/employee.php');

    class ReunionController{

        private $dbconnect;

        private $EmployeeRepo;
        private $ReservationRepo;
        private $SalleRepo;

        private $employees = [];
        private $salles = [];
        private $reservations = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->EmployeeRepo = new EmployeeRepository($this->dbconnect);
            $this->ReservationRepo = new ReservationRepository($this->dbconnect);
            $this->SalleRepo = new SalleRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions($_REQUEST['subaction']);

            $this->init();
        }

        public function show()
        {
            $employees = $this->employees;
            $salles = $this->salles;
            $reservations = $this->reservations;

            $events = $this->events($this->reservations);

            // var_dump($events);
            require("template/calendar.php");
        }

        function init()
        {
            $this->employees = $this->EmployeeRepo->getAll();
            $this->salles = $this->SalleRepo->getAll();
            $this->reservations = $this->ReservationRepo->getAll();
        }


        function subactions($subaction)
        {

            switch ($subaction) {
                case 'save':
                    
                    $reservation = new Reservation();
                    $reservation->reservation_id = uniqid("RU_");
                    $reservation->description = $_REQUEST['description'];
                    $reservation->jour = $_REQUEST['jour'];
                    $reservation->debut = $_REQUEST['debut'];
                    $reservation->fin = $_REQUEST['fin'];
                    $reservation->salle = $_REQUEST['salle'];
                    $reservation->employee = $_SESSION['matricule'];

                    $this->ReservationRepo->save( $reservation );

                    break;

                case 'delete':
            
                    $reservation = new Reservation();
                    $reservation->reservation_id = $_REQUEST['reservation_id'];

                    $this->ReservationRepo->delete( $reservation );
                    break;

                default:
                    # code...
                    break;
            }

        }

        function events($reservations){

            $text = "[";

            foreach ($reservations as $reservation) {
                
                $timestamp = strtotime($reservation->jour);
                $day = date('d', $timestamp);
                $month = date('m', $timestamp) - 1;
                $year = date('Y', $timestamp);
                $debut = explode(":",$reservation->debut);
                $fin = explode(":",$reservation->fin);

                $text = $text.

                // "{
                //     title: ' $reservation->description ',
                //     start: new Date(y, m, d, 06, 00),
                //     end: new Date(y,m, d, 14, 30),
                //     backgroundColor: '#f56954',
                //     borderColor: '#fff',
                //     allDay: false
                // },";

                "{
                    title: ' $reservation->description ',
                    start: new Date($year,$month,$day,".$debut[0].",".$debut[1]."),
                    end: new Date($year,$month,$day,".$fin[0].",".$fin[1]."),
                    backgroundColor: '#f56954',
                    borderColor: '#fff',
                    allDay: false
                },";
            }

            $text = $text."]";

            return $text;
        }

    }