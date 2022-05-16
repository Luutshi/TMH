<?php

namespace Mvc\Controllers;

use Config\Controller;
use Mvc\Models\LocationModel;

class PageController extends Controller
{
    private LocationModel $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModel();
        parent::__construct();
    }

    public function base()
    {
        echo $this->twig->render('Page/home.html.twig');
    }

    public function locationList()
    {
        if (isset($_SESSION['user'])) {
            $locations = $this->locationModel->eachLocations();

            echo $this->twig->render('Page/locationAdminList.html.twig', [
                'locations' => $locations,
            ]);

        } else {
            header('Location: /register');
            exit;
        }
    }

    public function locationCreate()
    {
        if (isset($_SESSION['user'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['houseCity']) && isset($_POST['nightPrice']) && isset($_POST['sqrtMeters']) && isset($_POST['description']) && isset($_POST['dpe']) && isset($_POST['ges']) && isset($_POST['nbOfRooms']) && isset($_POST['nbOfChambers'])) {
                $this->locationModel->insertHouse($_POST['houseCity'], $_POST['nightPrice'], $_POST['sqrtMeters'], $_POST['description'], $_POST['dpe'], $_POST['ges'], $_POST['nbOfRooms'], $_POST['nbOfChambers']);

                header('Location: /admin/location');
                exit;
            } else {
                echo $this->twig->render('Page/locationAdminCreate.html.twig');
            }
        } else {
            header('Location: /register');
            exit;
        }
    }

    public function locationDelete($houseID)
    {
        $this->locationModel->deleteHouse($houseID);

        header('Location: /admin/location');
        exit;
    }
}