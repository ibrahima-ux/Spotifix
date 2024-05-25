<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function connect($infos){
		$query = $this->db->query(
			"SELECT * FROM utilisateur
			WHERE login = $infos['login'] AND password = $infos['password']
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
