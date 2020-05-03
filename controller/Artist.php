<?php 

require_once(__DIR__.'/../model/ArtistModel.php');
require_once(__DIR__.'/../core/CJ_Controller.php');

session_start();

class Artist extends CJ_Controller {
    
    function __construct() {
        $this->model = new ArtistModel();
    }

    function index() {
        if (isset($_SESSION['username'])){
            $allArtists = $this->model->listAll();
            $this->load_view('ArtistView', array('allArtists' => $allArtists));
        } else {
            header('Location: ./login');
        }
    }

    function listAll_get() {
        $result = $this->model->listAll();
        echo json_encode($result);
    }

    function get_get($artistID) {
        $result = $this->model->get($artistID);
        echo json_encode($result);
    }

    function getAlbums_get($artistID) {
        $result = $this->model->getAlbums($artistID);
        echo json_encode($result);
    }

    function getSongs_get($artistID) {
        $result = $this->model->getSongs($artistID);
        echo json_encode($result);
    }

    function getAlbumCovers_get($artistID) {
        $result = $this->model->getAlbumCovers($artistID);
        echo json_encode($result);
    }

    function new_post() {
        if (isset($_SESSION['username'])) {       
            if (isset($_POST['name']) && file_exists($_FILES['picture']['tmp_name'])) {
                $this->model->new($_POST['name'], $_FILES['picture']);
                header('Location: ../artist');
            }
        } else {
            header('Location: ./login');
        }
    }

    function update_post() {
        if (isset($_SESSION['username'])) {            
            if (isset($_POST['artistID']) && (isset($_POST['name']) || file_exists($_FILES['picture']['tmp_name']))) {
                $name = isset($_POST['name']) ? $_POST['name'] : null;
                $picture = file_exists($_FILES['picture']['tmp_name']) ? $_FILES['picture'] : null;
                $this->model->update($_POST['artistID'], $name, $picture);
                header('Location: ../artist');
            }
        } else {
            header('Location: ./login');
        }
    }

    function delete_post() {
        if (isset($_SESSION['username'])) {            
            if (isset($_POST['artistID'])) {
                $this->model->deleteArtist($_POST['artistID']);
                header('Location: ../artist');
            }
        } else {
            header('Location: ./login');
        }
    }
}