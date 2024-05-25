<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_playlist extends CI_Model {
	public function __construct(){
		$this->load->database();
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
