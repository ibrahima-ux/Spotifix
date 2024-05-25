<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function connect($user, $mdp){
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			ORDER BY year
			"
		);
	return $query->result();
	}
	public function getPlaylists(){
		$id = $_SESSION['id'];
		$query = $this->db->query(
			"SELECT * FROM playlists
			WHERE userId = $id
			"
		);
	return $query->result();
	}
}
