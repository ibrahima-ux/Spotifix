<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

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

	public function playlists_tracks($id){

		$query = $this->db->query(
			"SELECT track.id as id, song.name as name
			FROM track_in_playlist
			JOIN track ON track.id = track_in_playlist.trackId
			JOIN song ON song.id = track.songId
			WHERE track_in_playlist.playlistId = 1
			ORDER BY song.name asc;
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
}
