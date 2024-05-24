<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Musique extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index($id){
		$albums = $this->model_music->getAlbums();
		$this->load->view('layout/header');
		$this->load->view('music_page',['albums'=>$albums]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$musics = $this->model_music->getSingleMusics($id);
		$this->load->view('layout/header');
		$this->load->view('music_page',['musics'=>$musics]);
		$this->load->view('layout/footer');
	}
}

