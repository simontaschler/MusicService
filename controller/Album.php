<?php 

require_once(__DIR__.'/../model/AlbumModel.php');
require_once(__DIR__.'/../core/CJ_Controller.php');

class Album extends CJ_Controller {
    
    function __construct() {
        $this->model = new AlbumModel();
    }

    function index() {
        $this->listAll_get();
    }

    function listAll_get() {
        $result = $this->model->listAll();
        echo json_encode($result);
    }

    function get_get($albumID) {
        $result = $this->model->get($albumID);
        echo json_encode($result);
    }

    function getArtists_get($albumID) {
        $result = $this->model->getArtists($albumID);
        echo json_encode($result);
    }

    function getSongs_get($albumID) {
        $result = $this->model->getSongs($albumID);
        echo json_encode($result);
    }

    function getCover_get($albumID) {
        $result = $this->model->getCover($albumID);
        echo $result;
    }
}