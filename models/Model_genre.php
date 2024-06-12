<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_genre extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function get_genre(){
		$query = $this->db->query(
			"SELECT * FROM genre
			ORDER BY name
			"
		);
	return $query->result();
	}
}