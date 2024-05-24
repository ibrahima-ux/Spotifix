<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_artiste');
		$this->load->helper('html');
		$this->load->helper('url');

	}
	public function index(){
		$artistes = $this->model_artiste->getArtiste();
		$this->load->view('layout/header');
		$this->load->view('artiste_list',['artistes'=>$artistes]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$this->load->model('model_music');
		$artiste = $this->model_artiste->getSingleArtiste($id);
		$musics = $this->model_music->getAlbumsOfArtist($id);
		$this->load->view('layout/header');
		$this->load->view('artiste_page',['artiste'=>$artiste, 'albums'=>$musics]);
		$this->load->view('layout/footer');
	}
}