<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {
	public $sorted = 'year';
	public $by = 'asc';
	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');

		$this->sorted = $this->input->get('sorted') ?? 'year';
		$this->by = $this->input->get('by') ?? 'asc';
	}
	public function index(){
		$albums = $this->model_music->getAlbums($this->sorted, $this->by);
		$this->load->view('layout/header');
		$this->load->view('albums_list',['albums'=>$albums, 'sorted'=>$this->sorted, 'by'=>$this->by]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$albums = $this->model_music->getSingleAlbums($id);
		$musics = $this->model_music->getAlbumMusics($id);
		$this->load->view('layout/header');
		$this->load->view('albums_page',['albums'=>$albums, 'musics'=>$musics]);
		$this->load->view('layout/footer');
	}
}

