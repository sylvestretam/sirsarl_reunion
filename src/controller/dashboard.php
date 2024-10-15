<?php

    require_once('src/repository/reservation.php');

    class DashboardController{

        private $dbconnect;
        
        private $ReservationRepo;

        private $reservations = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();
            $this->ReservationRepo = new ReservationRepository($this->dbconnect);

            $this->init();
        }

        public function show()
        {
            $reservations = $this->reservations;

            $events = $this->events($this->reservations);
            require("template/dashboard.php");
        }

        function init()
        {
            $this->reservations = $this->ReservationRepo->getAll();
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