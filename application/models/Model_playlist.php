<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use LDAP\Result;                                             

class Model_playlist extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getPlaylists($sorted, $by, $search){
		$id = $_SESSION['id'];

		$message = $search ?? '';

		if ($sorted == 'date') {
			$sorted = 'date';
		}elseif ($sorted == 'nom') {
			$sorted = 'nom';
		}else {
			$sorted = 'nom';
		}

		$query = $this->db->query(
			"SELECT * FROM playlists
			WHERE userId = $id 
			AND $sorted LIKE '%$message%'
			ORDER BY $sorted $by
			"
		);
	return $query->result();
	}

	public function newPlaylist($name){
		array($_SESSION);
		$id = $_SESSION['id'];
		$time = date('Y-m-d');

		$this->db->query(
			"INSERT INTO playlists (userId, nom, date)
			VALUES ($id, '$name', '$time')
			"
		);
	}

	public function playlists_tracks($id, $by = 'ASC', $search = ''){

		$query = $this->db->query(
			"SELECT track.id as id, song.name as name
			FROM track_in_playlist
			JOIN track ON track.id = track_in_playlist.trackId
			JOIN song ON song.id = track.songId
			WHERE track_in_playlist.playlistId = $id
			AND song.name LIKE '%$search%'
			ORDER BY song.name $by;
			"
		);

	return $query->result();
	}

	public function getSinglePlaylists($id){

		$query = $this->db->query(
			"SELECT * FROM playlists
			WHERE id = $id 
			"
		);
	return $query->result();
	}

	public function deletePlaylist($id){

		$query = $this->db->query(
			"DELETE FROM playlists
			WHERE id = $id 
			"
		);
	}

	public function addTrack($track, $playlist){
		if (!$this->isTrackInPlaylist($track, $playlist)) {
			$this->db->query(
				"INSERT INTO track_in_playlist 
				values ($playlist, $track)
				"
			);
		}
	}

	public function isTrackInPlaylist($track, $playlist){
		if ($this->db->query(
			"SELECT * FROM track_in_playlist 
			WHERE playlistId = $playlist 
			AND	trackId = $track
			"
		)->result() == null) {
			return false;
		}else {
			return true;
		}
		
	}

	public function deleteSongFromPlaylist($track, $playlist){

		$query = $this->db->query(
			"DELETE FROM track_in_playlist
			WHERE playlistId = $playlist
			AND trackId = $track
			"
		);
	}

	public function duplicatePlaylist($name, $initial){
		$id = $_SESSION['id'];
		$time = date('Y-m-d');

		$this->db->query(
			"INSERT INTO playlists (userId, nom, date)
			VALUES ($id, '$name', '$time')
			"
		);

		$query = $this->db->query(
			"SELECT @@IDENTITY AS 'id'"
		);
		$musics = $this->playlists_tracks($initial);
		
		foreach ($query->result() as $q) {}

		foreach ($musics as $music) {
			$this->addTrack($music->id, $q->id);
		}
	}

	private function is_nb_in_array($nb, $array){
		foreach ($array as $key => $value) {
			if ($value == $nb) {
				return true;
			}
		}
		return false;
	}

	public function newPlaylistRand($name,$genres,$artists,$nb){
		
		$i = 0;
		$SQLwhere = '';
		
		if ($genres != null) {
			foreach ($genres as $genre) {
				if ($genre != ''){
					if ($i == 0) {
						$SQLwhere .= "WHERE '$genre' = genre.name ";
					}else {
						$SQLwhere .= "OR '$genre' = genre.name ";
					}
					$i++;
				}
			}
		}
		if($artists != null){
			foreach ($artists as $artist) {
				if ($artist != '') {
					if ($i == 0) {
						$SQLwhere .= "WHERE '$artist' = artist.name ";
					}else {
						$SQLwhere .= "OR '$artist' = artist.name ";
					}
					$i++;
				}
			}
		}

		$musics = $this->db->query(
			"SELECT track.id
			FROM artist
			JOIN album on album.artistId = artist.id
			JOIN genre on genre.id = album.genreId
			JOIN track on track.albumId = album.id
			$SQLwhere
			ORDER BY artist.name
			"
		)->result();
		
		$max = count($musics);
		$id = $_SESSION['id'];
		$time = date('Y-m-d');
		$used_nb = [];

		$this->db->query(
			"INSERT INTO playlists (userId, nom, date)
			VALUES ($id, '$name', '$time')"
		);

		$query = $this->db->query(
			"SELECT @@IDENTITY AS 'id'"
		);

		foreach ($query->result() as $q) {}

		for ($k=0; $k < $nb; $k++) { 
			$nb_random = rand(0,$max-1);
			while ($this->is_nb_in_array($nb_random,$used_nb) && $nb_random < 0) {
				$nb_random = rand(0,$max-1);
			}
			$used_nb[$k] = $nb_random;
			$this->addTrack($musics[$nb_random]->id, $q->id);
		}
	}
}