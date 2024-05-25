<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_playlist');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index(){
		if ($_POST != null) {
			$infos = filter_input_array(INPUT_POST,FILTER_DEFAULT,true);
			session_start($infos);
		}

		if (isset($_SESSION)) {
			$playlists = $this->model_playlist->getPlaylists();
			$this->load->view('layout/header');
			$this->load->view('playlist_list',['playlist'=>$playlists]);
			$this->load->view('layout/footer');
		}else {
			$this->load->view('layout/header');
			$this->load->view('user_connect', ['message'=>""]);
			$this->load->view('layout/footer');
		}
		
	}

	public function connection(){
		$infos = filter_input_array(INPUT_POST, FILTER_DEFAULT, true);
		$query = $this->model_playlist->connect($infos);
		if (empty($query)){
			$this->load->view('layout/header');
			$this->load->view('user_connect', ['message'=>"This account may not exist"]);
			$this->load->view('layout/footer');
		}else{
			$playlists = $this->model_playlist->getPlaylists();
			$this->load->view('layout/header');
			$this->load->view('playlist_list',['playlist'=>$playlists]);
			$this->load->view('layout/footer');
		}
	}

}