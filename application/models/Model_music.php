<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');                                             

class Model_music extends CI_Model {
	public function __construct(){
		$this->load->database();
	}

	public function getAlbums(){
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
	public function getSingleAlbums($id){
		$query = $this->db->query(
			"SELECT album.name,album.id,year,artist.name as artistName, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			WHERE album.id = $id
			ORDER BY year
			"
		);
	return $query->result();
	}
	public function getAlbumMusics($id){
		$query = $this->db->query(
			"SELECT * FROM `track` 
			JOIN song on songId = song.id
			WHERE albumId = $id  
			ORDER BY `track`.`number` ASC
			"
		);
	return $query->result();
	}
	public function getSingleMusics($id){
		$query = $this->db->query(
			"SELECT song.id as ID, diskNumber, number, duration, song.name as song, album.name as album, artist.name as artist, album.id as album_id, artist.id as artist_id
			FROM `track` 
			JOIN song on songId = song.id
			JOIN album ON albumId = album.id
			JOIN artist ON album.artistId = artist.id
			WHERE track.id = 295  
			ORDER BY `track`.`number` ASC
			"
		);
	return $query->result();
	}
}
