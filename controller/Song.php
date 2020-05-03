<?php 

require_once(__DIR__.'/../model/SongModel.php');
require_once(__DIR__.'/../core/CJ_Controller.php');

class Song extends CJ_Controller {
    
    function __construct() {
        $this->model = new SongModel();
    }

    function index() {}

    function getArtists_get($songID) {
        $result = $this->model->getArtists($songID);
        echo json_encode($result);
    }

    function getArtistNames_get($songID) {
        $result = $this->model->getArtistNames($songID);
        echo json_encode($result);
    }
}