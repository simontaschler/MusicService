<?php 
require_once(__DIR__.'/../core/CJ_Model.php');

class ArtistModel extends CJ_Model {

	function __construct(){
		parent::__construct();
	}

	function listAll(){
        $result = parent::read('artist', array('*'));
        return $result;
	}

	function get($artistID){
		$result = parent::read('artist', array('*'), array('ArtistID' => $artistID));
		return $result[0];	
	}

	function getAlbums($artistID){
		$albumIDsResult = parent::read('album_artist', array('AlbumID'), array('ArtistID' => $artistID));
		$albumIDs = '(';
		foreach ($albumIDsResult as $row)
			$albumIDs .=  $row['AlbumID'] . ',';
		$albumIDs = rtrim($albumIDs, ',') . ');';

		$result = $this->connection->query('SELECT * FROM album WHERE AlbumID IN ' . $albumIDs);
		$finale = array();
		if ($result) {
			while($row=mysqli_fetch_assoc($result))
				array_push($finale,$row);
			return $finale;
		}
		else
			return array();
	}

	function getSongs($artistID){
		$artistSongs = parent::read('song_artist', array('SongID'), array('ArtistID' => $artistID));
		$songIDs = '(';
		foreach ($artistSongs as $row)
			$songIDs .= $row['SongID'] . ',';
		$songIDs = rtrim($songIDs, ',') . ');';

		$result = $this->connection->query('SELECT * FROM song WHERE SongID IN ' . $songIDs);
		$finale = array();
		if ($result) {
			while($row=mysqli_fetch_assoc($result))
				array_push($finale,$row);
			return $finale;
		}
		else
			return array();
	}

	function getAlbumCovers($artistID){

		$artistAlbums = $this->connection->query('SELECT DISTINCT s.AlbumID FROM song s, song_artist sa WHERE sa.ArtistID='.$artistID.' AND s.SongID=sa.SongID;');
		$albumIDs = '(';
		foreach ($artistAlbums as $row)
			$albumIDs .= $row['AlbumID'] . ',';
		$albumIDs = rtrim($albumIDs, ',') . ');';

		$result = $this->connection->query('SELECT AlbumID, CoverAddress FROM album WHERE AlbumID IN ' . $albumIDs);

		$finale = array();
		if ($result) {
			while($row=mysqli_fetch_assoc($result))
				array_push($finale,$row);
			return $finale;
		}
		else
			return array();
	}

	function new($name, $picture){

		$targetDir = "Data/Pictures/Artists";
		$imageFileType = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION));
		$targetFile = $targetDir .'/'.preg_replace('/\s+/', '', strtolower($name)) .'.'. $imageFileType;

		if ($this->handlePictureUpload($targetFile, $picture)) {
			if ($stmt = $this->connection->prepare("INSERT INTO artist(Name, PictureAddress) VALUES(?, ?)")){
				$targetFile = '/'.$targetFile;
				$stmt->bind_param('ss', $name, $targetFile);
				$stmt->execute();
				return true;
			} else {
				echo 'test';
				echo $this->connection->error_list;
			}
		}		
		return false;
	}

	function update($artistID, $name, $picture){	
		
		if ($picture == null && $name == null)
			return false;

		$result = $this->connection->query('SELECT PictureAddress FROM artist WHERE ArtistID='.$artistID);

		if ($result->num_rows != 1)
			return false;
		else
			$row = mysqli_fetch_assoc($result);

		$oldFile = ltrim($row['PictureAddress'],'/');
		$targetDir = 'Data/Pictures/Artists';
		$targetFile = '';

		if ($name == null) {
			$oldFileType = strtolower(pathinfo($oldFile,PATHINFO_EXTENSION));
			$imageFileType = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION));
			$targetFile = ltrim(rtrim($oldFile, $oldFileType) . $imageFileType, '/');
			$this->handlePictureUpload($targetFile, $picture);
			$stmt = $this->connection->prepare('UPDATE artist SET PictureAddress=? WHERE ArtistID=?');
			$targetFile = '/'.$targetFile;
			$stmt->bind_param('si', $targetFile, $artistID);
			$stmt->execute();
			return true;
		}
		else if ($picture == null)
		{
			$imageFileType = strtolower(pathinfo($oldFile,PATHINFO_EXTENSION));
			$targetFile = $targetDir .'/'.preg_replace('/\s+/', '', strtolower($name)) .'.'. $imageFileType;
			rename($oldFile, $targetFile);
		}
		else
		{
			$imageFileType = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION));
			$targetFile = $targetDir .'/'.preg_replace('/\s+/', '', strtolower($name)) .'.'. $imageFileType;
			unlink($oldFile);
			$this->handlePictureUpload($targetFile, $picture);
		}

		$stmt = $this->connection->prepare("UPDATE artist SET Name=?, PictureAddress=? WHERE ArtistID=?");
		$targetFile = '/'.$targetFile;
		$stmt->bind_param('ssi', $name, $targetFile, $artistID);
		$stmt->execute();
		return true;
	}
	
	function deleteArtist($artistID) {

		$result = $this->connection->query('SELECT PictureAddress FROM artist WHERE ArtistID='.$artistID);
		if ($result->num_rows != 1)
			return false;
		else
			$row = mysqli_fetch_assoc($result);

		$file = ltrim($row['PictureAddress'],'/');
		unlink($file);
		$this->connection->query('DELETE FROM artist WHERE ArtistID='.$artistID);
	}

	private function handlePictureUpload($targetFile, $picture) {
		$imageFileType = strtolower(pathinfo($picture["name"],PATHINFO_EXTENSION));
		$uploadOk = true;
		if(isset($_POST["confirm"])) {
			$check = getimagesize($picture["tmp_name"]);
			if($check !== false) 
				$uploadOk = true;
			else 
				$uploadOk = false;
		}
		
		if ($picture["size"] > 1000000) 
			$uploadOk = false;
		
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") 
			$uploadOk = false;

		if ($uploadOk)
			return move_uploaded_file($picture["tmp_name"], $targetFile);
		return false;
	}
}