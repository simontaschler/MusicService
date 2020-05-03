<?php 
require_once(__DIR__.'/../core/CJ_Model.php');

class SongModel extends CJ_Model {

	function __construct(){
		parent::__construct();
	}

	function getArtists($songID){
        $songArtists = parent::read('song_artist', array('ArtistID'), array('SongID' => $songID), array('IsFeature'));
		$artistIDs = '(';
		foreach ($songArtists as $row)
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

	function getArtistNames($songID){
        $songArtists = parent::read('song_artist', array('ArtistID'), array('SongID' => $songID), array('IsFeature'));
		$artistIDs = '(';
		foreach ($songArtists as $row)
			$artistIDs .= $row['ArtistID'] . ',';
        $artistIDs = rtrim($artistIDs, ',') . ');';
		
        $result = $this->connection->query('SELECT Name FROM artist WHERE ArtistID IN ' . $artistIDs);
		$finale = array();
		if ($result) {
			while($row=mysqli_fetch_assoc($result))
				array_push($finale,$row["Name"]);
			return $finale;
		}
		else
			return array();
	}
}