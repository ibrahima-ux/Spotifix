<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getAlbums($sorted, $by, $search){

		$message = $search ?? '';


		if ($sorted == 'genre') {
			$sorted = 'genre.name';
		}elseif ($sorted == 'nom') {
			$sorted = 'album.name';
		}


		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE $sorted LIKE '%$message%'
			ORDER BY $sorted $by
			"
		);
	return $query->result();
	}
	public function getAlbumsOfArtist($id){
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			where artist.id = $id
			ORDER BY year
			"
		);
	return $query->result();
	}

	public function getMusicsOfArtist($id, $sorted = "titre", $by = "asc"){

		if ($sorted == 'titre') {
			$sorted = 'song.name';
		}elseif ($sorted == 'albums') {
			$sorted = 'album.name';
		}

		$query = $this->db->query(
			"SELECT track.id as id, song.name as name, album.name as album 
			FROM track 
			JOIN song on songId = song.id
			JOIN album ON albumId = album.id
			JOIN artist ON artistId = artist.id
			WHERE artist.id = $id  
			ORDER BY $sorted $by
			"
		);
	return $query->result();
	}
	public function getSingleAlbum($id){
		$query = $this->db->query(
			"SELECT album.name as name,album.id as id,year,artist.name as artistName, artist.id as artist_id, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.id = $id
			"
		);
	return $query->result();
	}
	public function getAlbumMusics($id){
		$query = $this->db->query(
			"SELECT song.name as name, track.id as id, number FROM `track` 
			JOIN song on songId = song.id
			WHERE albumId = $id  
			ORDER BY `track`.`number` ASC
			"
		);
	return $query->result();
	}
	public function getSingleMusics($id){
		$query = $this->db->query(
			"SELECT track.id as track_id, song.id as ID, diskNumber, number, duration, song.name as song, album.name as album, artist.name as artist, album.id as album_id, artist.id as artist_id, genre.name as genre
			FROM `track` 
			JOIN song on songId = song.id
			JOIN album ON track.albumId = album.id
			JOIN artist ON album.artistId = artist.id
			JOIN genre ON album.genreId = genre.id
			WHERE track.id = $id 
			ORDER BY `track`.`number` ASC
			"
		);
	return $query->result();
	}

	public function getMusics($sorted = 'nom', $by = 'asc', $search = ''){

		$message = $search ?? '';

		if ($sorted == 'genre') {
			$sorted = 'genre.name';
		}elseif ($sorted == 'nom') {
			$sorted = 'song.name';
		}elseif ($sorted == 'artistes') {
			$sorted = 'artist.name';
		}

		$query = $this->db->query(
			"SELECT track.id as id, song.name as name, artist.id as artiste_id, artist.name as artistName, genre.name as genreName
			FROM `track` 
			JOIN song on songId = song.id
			JOIN album ON track.albumId = album.id
			JOIN artist ON album.artistId = artist.id
			JOIN genre ON album.genreId = genre.id
			WHERE $sorted LIKE '%$message%'
			ORDER BY $sorted $by
			"
		);
	return $query->result();
	}

	public function nb_tracks_filtered($genres,$artists){

		$SQLwhere = 'WHERE 1=2 ';
	
		if ($genres != null) {
			foreach ($genres as $genre) {
				$SQLwhere .= "OR '$genre' = genre.name ";
			}
		}elseif($artists != null){
			foreach ($artists as $artist) {
				$SQLwhere .= "OR '$artist' = artist.name ";
			}
		}

		$musics = $this->db->query(
			"SELECT count(*) as number
			FROM artist
			JOIN album on album.artistId = artist.id
			JOIN genre on genre.id = album.genreId
			JOIN track on track.albumId = album.id
			$SQLwhere
			ORDER BY artist.name
			"
		)->result();

		return $musics;
	}
}
