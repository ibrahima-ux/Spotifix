<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index(){
		if ($_POST != null) {
			$infos = filter_input_array(INPUT_POST,FILTER_DEFAULT,true);
			session_start($infos);
		}

		if (isset($_SESSION)) {
			$playlists = $this->model_music->getPlaylists();
			$this->load->view('layout/header');
			$this->load->view('playlist_list',['playlist'=>$playlists]);
			$this->load->view('layout/footer');
		}else {
			$this->load->view('layout/header');
			$this->load->view('user_connect');
			$this->load->view('layout/footer');
		}
		
	}

	public function connection(){
		if (empty($query)){
			$this->load->view('layout/header');
			$this->load->view('user_connect', ['message'=>"Bad login or password, this account may not exist"]);
			$this->load->view('layout/footer');
		}
	}

}