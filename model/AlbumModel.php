<?php 
require_once(__DIR__.'/../core/CJ_Model.php');

class AlbumModel extends CJ_Model {

	function __construct(){
		parent::__construct();
	}

	function listAll() {
        $result = parent::read('album', array('*'));
        return $result;
    }
    
    function get($albumID) {
        $result = parent::read('album', array('*'), array('AlbumID' => $albumID));
		return $result[0];
    }

    function getArtists($albumID){
		$artistIDsResult = parent::read('album_artist', array('ArtistID'), array('AlbumID' => $albumID));
		$artistIDs = '(';
		foreach ($artistIDsResult as $row)
			$artistIDs .= $row['ArtistID'] . ',';
		$artistIDs = rtrim($artistIDs, ',') . ');';

		$result = $this->connection->query('SELECT * FROM artist WHERE ArtistID IN ' . $artistIDs);
		$finale = array();
		if ($result) {
			while($row=mysqli_fetch_assoc($result))
				array_push($finale,$row);
			return $finale;
		}
		else
			return array();
    }
    
    function getSongs($albumID){
        $result = parent::read('song', array('*'), array('AlbumID' => $albumID), array('Position'));
        return $result;
	}

	
	function getCover($albumID){
		$result = parent::read('album', array('CoverAddress'), array('AlbumID' => $albumID));
		return $result[0]['CoverAddress'];
	}
}