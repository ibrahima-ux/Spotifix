<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index(){
		$artistes = $this->model_music->getAlbums();
		$this->load->view('layout/header');
		$this->load->view('artiste_list',['artistes'=>$artistes]);
		$this->load->view('layout/footer');
	}

}