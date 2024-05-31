<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_artiste extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getArtists($by,$search){
		$message = $search ?? '';
		$query = $this->db->query(
			"SELECT DISTINCT name,id
			FROM artist
			WHERE name LIKE '%$message%'
			ORDER BY name $by
			"
		);
	return $query->result();
	}
	public function getSingleArtiste($idA){
		$query = $this->db->query(
			"SELECT DISTINCT name,id
			FROM artist
			WHERE id = $idA
			"
		);
	return $query->result();
	}
}
