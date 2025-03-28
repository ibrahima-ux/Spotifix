<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Playlist extends CI_Controller {
	public $sorted = 'date';
	public $by = 'asc';
	public function __construct(){
		parent::__construct();
		$this->load->model('model_user');
		$this->load->model('model_music');
		$this->load->model('model_playlist');
		$this->load->helper('html');
		$this->load->helper('url');

		$this->sorted = $this->input->get('sorted') ?? 'date';
		$this->by = $this->input->get('by') ?? 'asc';
	}
	public function index(){
		if (!isset($_SESSION)){
			session_start();
		}
		
		if (isset($_SESSION['id']) ) {
			if ($this->model_user->isUser($_SESSION['id']) != null) {
				$playlists = $this->model_playlist->getPlaylists($this->sorted, $this->by, $this->input->post('search'));
				$this->load->view('layout/header');
				$this->load->view('playlist_list',['playlists'=>$playlists, 'sorted'=>$this->sorted, 'by'=>$this->by]);
				$this->load->view('layout/footer');
			}else {
				session_write_close();
				$this->connection();
			}
		}else {
			session_write_close();
			$this->connection();
		}
	}

	public function connection(){

		if ($_POST == null) {
			$this->load->view('layout/header');
			$this->load->view('user_connect', ['message'=>""]);
			$this->load->view('layout/footer');
		}else{
			$infos = filter_input_array(INPUT_POST, FILTER_DEFAULT, true);
			$query = $this->model_user->connect($infos);
			if (empty($query)){
				$this->load->view('layout/header');
				$this->load->view('user_connect', ['message'=>"ERROR : this account dose not exist.  Please try another username or password"]);
				$this->load->view('layout/footer');
			}else{
				$this->setSession($infos);
				redirect('playlist/');
			}
		}
	}

	public function setSession($infos){
		session_start();
		$query = $this->model_user->connect($infos);
		foreach ($query as $user) {
		}
		$_SESSION['id'] = $user->id;
		$_SESSION['user'] = $user->user;
		session_write_close();
	}

	public function deconnection(){
		session_start();
		session_destroy();
		redirect('playlist/');
	}

	public function register(){
		
		if ($_POST == null) {
			$this->load->view('layout/header');
			$this->load->view('user_create', ['message'=>""]);
			$this->load->view('layout/footer');
		}else{
			$infos = filter_input_array(INPUT_POST, FILTER_DEFAULT, true);
			if ($infos['password'] == $infos['confirm_password']){
				$this->model_user->add($infos);
				$query = $this->model_user->connect($infos);
				if (empty($query)){
					$this->load->view('layout/header');
					$this->load->view('user_create', ['message'=>"ERREUR : ce login ou ce mot de passe existe déjà"]);
					$this->load->view('layout/footer');
				}else{
					$this->setSession($infos);
					redirect('playlist/');
				}
			}else{
				$this->load->view('layout/header');
				$this->load->view('user_create', ['message'=>"ERROR : Les champs 'password' et 'confirm_password' doivent être les mêmes"]);
				$this->load->view('layout/footer');
			}
		}
		
	}

	public function new(){
		session_start();
		if ($this->model_user->isUser($_SESSION['id']) != null) {
			if ($this->input->get('named') == true) {
				$this->newPlaylist();
			}else {
				$this->load->view('layout/header');
				$this->load->view('new_playlist', ['what'=> 'newPlaylist/?named=true']);
				$this->load->view('layout/footer');
			}
		}else {
			session_write_close();
			$this->connection();
		}
	}

	public function newPlaylist(){
		session_start();
		if ($this->model_user->isUser($_SESSION['id']) != null) {
			$name = $this->input->post('name');
			if ($this->input->post('random') != 'random') {
				$this->model_playlist->newPlaylist($name);
				session_write_close();
				redirect('playlist/');
			}else {
				session_write_close();
				redirect("playlist/choose_genre/$name");
			}
		}
	}

	public function duplication($id){
		session_start();
		if ($this->model_user->isUser($_SESSION['id']) != null) {
			if ($this->input->get('named') == true) {
				session_write_close();
				$this->duplicationPlaylist($id);
			}else {
				$this->load->view('layout/header');
				$this->load->view('new_playlist', ['what'=> $id."?named=true"]);
				$this->load->view('layout/footer');
			}
		}else {
			session_write_close();
			$this->connection();
		}
	}

	public function duplicationPlaylist($id){
		session_start();
		if ($this->model_user->isUser($_SESSION['id']) != null) {
			$name = filter_input(INPUT_POST, "name",FILTER_DEFAULT);
			$this->model_playlist->duplicatePlaylist($name, $id);
		}
		session_write_close();
		redirect('playlist/');
	}

	public function view($id, $message = ''){
		session_start();
		$sorted = $this->input->get('sorted');
		$search = $this->input->get('search');
		$playlists = $this->model_playlist->getSinglePlaylists($id);
		foreach ($playlists as $playlist){}
		$tracks = $this->model_playlist->playlists_tracks($id, $this->by, $this->sorted, $search);
		$count = $this->model_playlist->playlists_tracks_count($id);
		$this->load->view('layout/header');
		$this->load->view('playlist_page',['id'=>$id, 'playlist'=>$playlist, 'songs'=>$tracks, 'sorted'=>$sorted, 'by'=>$this->by, 'search'=>$search, 'count'=>$count]);
		$this->load->view('layout/footer');
		session_write_close();
	}

	public function deletePlaylist($id){
		if ($this->model_playlist->getSinglePlaylists($id) != null) {
			$this->model_playlist->deletePlaylist($id);
		}
		redirect('playlist/');
	}

	public function deleteConfirm($id){
		$this->load->view('layout/header');
		$this->load->view('delete_playlist_confirm',['id'=>$id,]);
		$this->load->view('layout/footer');
	}

	public function addTrack($id){
		session_start();
		$track = $id;
		if($this->input->get('selected')){
			$playlist = $this->input->get('playlist');
			$this->model_playlist->addTrack($track, $playlist);
			redirect("playlist/view/$playlist");
		}else {
			$playlists = $this->model_playlist->getPlaylists($this->sorted, $this->by, '');
			$this->load->view('layout/header');
			$this->load->view('playlist_selector',['id'=>$track,'playlists'=>$playlists, 'addWhat'=>'addTrack']);
			$this->load->view('layout/footer');
		}
		session_write_close();
	}

	public function deleteSongFromPlaylist(){
		$track = $this->input->get('track');
		$playlist = $this->input->get('playlist');
		$this->model_playlist->deleteSongFromPlaylist($track, $playlist);
		
		redirect("playlist/view/$playlist");
	}

	public function addAlbumsTracks($id){
		session_start();
		if($this->input->get('selected')){
			$playlist = $this->input->get('playlist');
			$musiques = $this->model_music->getAlbumMusics($id);
			foreach ($musiques as $musique) {
				$this->model_playlist->addTrack($musique->id, $playlist);
			}
			session_write_close();
			redirect("playlist/view/$playlist");
		}else {
			session_write_close();
			$playlists = $this->model_playlist->getPlaylists('', '', '');
			$this->load->view('layout/header');
			$this->load->view('playlist_selector',['id'=>$id,'playlists'=>$playlists, 'addWhat'=>'addAlbumsTracks']);
			$this->load->view('layout/footer');
		}
	}

	public function addArtistsTracks($id){
		session_start();
		if($this->input->get('selected')){
			$playlist = $this->input->get('playlist');
			$musiques = $this->model_music->getMusicsOfArtist($id);
			foreach ($musiques as $musique) {
				$this->model_playlist->addTrack($musique->id, $playlist);
			}
			session_write_close();
			redirect("playlist/view/$playlist");
		}else {
			session_write_close();
			$playlists = $this->model_playlist->getPlaylists('', '', '');
			$this->load->view('layout/header');
			$this->load->view('playlist_selector',['id'=>$id,'playlists'=>$playlists, 'addWhat'=>'addArtistsTracks']);
			$this->load->view('layout/footer');
		}
	}

	public function choose_genre($name){
		session_start();
		if ($this->input->get('choosed_genre') != true) {
			$this->load->model('model_genre');
			$genres = $this->model_genre->get_genre();
			$this->load->view('layout/header');
			$this->load->view('choose_genre',['genres'=>$genres,'name'=>$name]);
			$this->load->view('layout/footer');
		}else{
			session_write_close();
			$this->choose_artist($name);
		}
	}

	public function choose_artist($name){
		session_start();
		$this->load->model('model_artiste');

		$genres = $this->input->post('genre');
		if ($this->input->get('choosed_artiste') != true) {
			$artists = $this->model_artiste->get_artist_with_genre($genres);
			$this->load->view('layout/header');
			$this->load->view('choose_artiste',['artists'=>$artists,"genres"=>$genres,'name'=>$name]);
			$this->load->view('layout/footer');
		}else {
			$artists = $this->input->post('artists');
			session_write_close();
			$this->choose_number($name);
		}
		session_write_close();
	}

	public function choose_number($name){
		session_start();

		$genres = $this->input->post('genre');
		$artists = $this->input->post('artists');
		if ($this->input->get('choosed_num') != true) {
			
			$max = $this->model_music->nb_tracks_filtered($genres,$artists);
			$this->load->view('layout/header');
			$this->load->view('choose_number',['artists'=>$artists,"genres"=>$genres,'name'=>$name,'max'=>$max]);
			$this->load->view('layout/footer');
		}else {
			$nb = $this->input->post('nb');
			$this->create_random_playlist($genres,$artists,$name,$nb);
		}
		session_write_close();
	}

	public function create_random_playlist($genres,$artists,$name,$nb){
		session_start();
		if ($this->model_user->isUser($_SESSION['id']) != null) {
			$this->model_playlist->newPlaylistRand($name,$genres,$artists,$nb);
			session_write_close();
			redirect('Playlist/index');
		}
		session_write_close();

	}
}
