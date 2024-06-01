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

	public function get_artist_with_genre($genres){

		$SQLgenres = 'WHERE "" = genre.name ';

		if ($genres == null) {
			$SQLgenres = '';
		}else{
			foreach ($genres as $genre) {
				$SQLgenres .= "OR '$genre' = genre.name ";
			}
		}

		$query = $this->db->query(
			"SELECT DISTINCT artist.name,artist.id
			FROM artist
			JOIN album on album.artistId = artist.id
			JOIN genre on genre.id = album.genreId
			$SQLgenres
			ORDER BY artist.name
			"
		);
	return $query->result();
	}
}
