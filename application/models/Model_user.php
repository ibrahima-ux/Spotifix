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
			WHERE user = '$username'
			"
		); 
		$queryret = $this->db->query(
			"SELECT id, user FROM utilisateur
			WHERE FALSE
			"
		);
		foreach ( $query->result() as $q) {
			if (password_verify("$password", $q->mdp )) {
				$queryret = $this->db->query(
					"SELECT id, user FROM utilisateur
					WHERE user = '$username'
					"
				);
			}else {
				$queryret = $this->db->query(
					"SELECT id, user FROM utilisateur
					WHERE FALSE
					"
				);
			}
			break;
		}
		
	return $queryret->result();
	}

	public function add($infos){
		$username = $infos['username'];
		$password = password_hash($infos['password'], PASSWORD_DEFAULT);
		$query = $this->connect($infos);
		if ($query == null) {
			$this->db->query(
				"INSERT INTO utilisateur (`user`,`mdp`) value ('$username', '$password')
				"
			);
		}
	}
}