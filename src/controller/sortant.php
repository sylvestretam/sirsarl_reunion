<?php

    require_once('src/repository/sortant.php');
    require_once('src/repository/employee.php');

    class SortantController{

        private $dbconnect;

        private $SortantRepo;

        private $EmployeeRepo;

        private $employees = [];
        private $courriers = [];

        public function __construct()
        {
            $this->dbconnect = new DbConnect();
            
            $this->SortantRepo = new SortantRepository($this->dbconnect);
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
            
            require("template/sortant.php");
        }

        function init()
        {
            $this->employees = $this->EmployeeRepo->getAll();
            $this->courriers = $this->SortantRepo->getAll();
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'save':
                    
                    
                    if ($this->SaveFile()) {
                        $courrier = new Sortant();
                        $courrier->date_emmission = $_REQUEST['date_emmission'];
                        $courrier->objet = $_REQUEST['objet'];
                        $courrier->reference = $_REQUEST['reference'];
                        $courrier->numero_archivage = $_REQUEST['numero_archivage'];
                        $courrier->emmetteur = $_REQUEST['emmetteur'];
                        $courrier->destinataire = $_REQUEST['destinataire'];
                        $courrier->observation = $_REQUEST['observation'];
                        $courrier->statut = "TRANSMIT";
                        $courrier->adresse_fichier = basename($_FILES['fichier']['name']);
                        $courrier->departement = $_REQUEST['departement'];
                        $courrier->date_transmission = $_REQUEST['date_transmission'];
                        $courrier->transmetteur = $_REQUEST['transmetteur'];
                        // $courrier->visa = $_REQUEST['visa'];

                        $repo = new SortantRepository($this->dbconnect);
                        $repo->save($courrier);
                    } else {
                        $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    }

                    break;

                case 'delete':
            
                    $courrier = new Sortant();
                    $courrier->numero = $_REQUEST['numero'];

                    $repo = new SortantRepository($this->dbconnect);
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