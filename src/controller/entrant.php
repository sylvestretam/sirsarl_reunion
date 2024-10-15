<?php

    require_once('src/repository/entrant.php');
    require_once('src/repository/employee.php');

    class EntrantController{

        private $dbconnect;

        private $EntrantRepo;
        private $EmployeeRepo;

        private $employees = [];
        private $courriers = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();
            
            $this->EntrantRepo = new EntrantRepository($this->dbconnect);
            $this->EmployeeRepo = new EmployeeRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $employees = $this->employees;
            $courriers = $this->courriers;

            $total = sizeof($courriers);
            $nonlu = array_reduce($this->courriers,function($carry, $object){ return  ($object->statut == "NON LU") ? $carry + 1 : $carry + 0;},0);
            
            require("template/entrant.php");
        }

        function init()
        {
            $this->employees = $this->EmployeeRepo->getAll();
            $this->courriers = $this->EntrantRepo->getAll();
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'save':
                    
                    
                    if ($this->SaveFile()) {
                        $courrier = new Entrant();
                        $courrier->date_emmission = $_REQUEST['date_emmission'];
                        $courrier->date_reception = $_REQUEST['date_reception'];
                        $courrier->objet = $_REQUEST['objet'];
                        $courrier->reference = $_REQUEST['reference'];
                        $courrier->numero_archivage = $_REQUEST['numero_archivage'];
                        $courrier->emmetteur = $_REQUEST['emmetteur'];
                        $courrier->destinataire = $_REQUEST['destinataire'];
                        $courrier->observation = $_REQUEST['observation'];
                        $courrier->statut = "NON LU";
                        $courrier->adresse_fichier = basename($_FILES['fichier']['name']);

                        $repo = new EntrantRepository($this->dbconnect);
                        $repo->save($courrier);
                    } else {
                        $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    }

                    break;

                case 'delete':
            
                    $courrier = new Entrant();
                    $courrier->numero = $_REQUEST['numero'];

                    $repo = new EntrantRepository($this->dbconnect);
                    $repo->delete($courrier);
                    break;

                default:
                    # code...
                    break;
            }

        }

        function SaveFile()
        {

            $uploaddir = $GLOBALS['EFILESERVERPATH'];
            $uploadfile = $uploaddir . basename($_FILES['fichier']['name']);
            return move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile);
        }
    }