<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_user extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function connect($infos){
		$username = $infos['username'];
		$password = $infos['password'];
		$query = $this->db->query(
			"SELECT * FROM utilisateur
			WHERE user = '$username' AND mdp = '$password'
			"
		);
	return $query->result();
	}

	public function add($infos){
		$username = $infos['username'];
		$password = $infos['password'];
		$query = $this->connect($infos);
		if ($query == null) {
			$this->db->query(
				"INSERT INTO utilisateur (`user`,`mdp`) value ('$username', '$password')
				"
			);
		}
	}
}