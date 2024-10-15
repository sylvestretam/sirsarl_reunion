<?php
    session_start();
    
    require_once('src/lib/outils.php');
    require_once('src/lib/database.php');

    require_once('src/controller/dashboard.php');
    require_once('src/controller/entrant.php');
    require_once('src/controller/sortant.php');
    require_once('src/controller/reunion.php');

    if(isset($_SESSION['COURRIER']))
    {

        if(isset($_REQUEST['action'])){

            switch ($_REQUEST['action']) {

                case 'dashboard':
                    $controller = new DashboardController();
                    $controller->show();
                    break;
                case 'entrant':
                    $controller = new EntrantController();
                    $controller->show();
                    break;
                case 'sortant':
                    $controller = new SortantController();
                    $controller->show();
                    break;
                case 'reunion':
                    $controller = new ReunionController();
                    $controller->show();
                    break;
                case 'logout':
                    header('location:'.$SERVERPATH.'sisas_portal');
                    break;
                default:
                    $controller = new DashboardController();
                    $controller->show();
                    break;
            }
        }
        else
        {
            if(isset($_SESSION['matricule']))
            {
                $controller = new DashboardController();
                $controller->show();
            }
            else
            {
                header('location:'.$SERVERPATH.'sisas_portal');
            }
        }
    }
    else
    {
        $ERROR = "Vous ne pouvez acceder a cette application";
        require('template/error.php');
    }