<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Playlist extends CI_Controller {
	public $sorted = 'year';
	public $by = 'asc';
	public function __construct(){
		parent::__construct();
		$this->load->model('model_user');
		$this->load->model('model_playlist');
		$this->load->helper('html');
		$this->load->helper('url');

		$this->sorted = $this->input->get('sorted') ?? 'year';
		$this->by = $this->input->get('by') ?? 'asc';
	}
	public function index(){
		if (!isset($_SESSION)){
			session_start();
		}
		if (isset($_SESSION['id'])) {
			$playlists = $this->model_playlist->getPlaylists();
			$this->load->view('layout/header');
			$this->load->view('playlist_list',['playlists'=>$playlists, 'sorted'=>$this->sorted, 'by'=>$this->by]);
			$this->load->view('layout/footer');
		}else {
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
				foreach ($query as $user) {
				}
				$_SESSION['id'] = $user->id;
				$_SESSION['user'] = $user->user;
				$this->index();
			}
		}
	}

	public function deconnection(){
		session_start();
		unset($_SESSION['id']);
		unset($_SESSION['user']);
		session_destroy();
		$this->index();
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
					$this->load->view('user_create', ['message'=>"ERREUR : ce login ou ce mot de passe existe déjà"]);
					$this->load->view('layout/footer');
				}else{
					$this->connection();
				}
			}else{
				$this->load->view('layout/header');
				$this->load->view('user_create', ['message'=>"ERROR : Les champs 'password' et 'confirm_password' doivent être les mêmes"]);
				$this->load->view('layout/footer');
			}
		}
	}
}