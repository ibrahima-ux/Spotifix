<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {
	public $sorted = 'titre';
	public $by = 'asc';
	public function __construct(){
		parent::__construct();
		$this->load->model('model_artiste');
		$this->load->helper('html');
		$this->load->helper('url');

		$this->sorted = $this->input->get('sorted') ?? 'titre';
		$this->by = $this->input->get('by') ?? 'asc';

	}
	public function index(){
		$artistes = $this->model_artiste->getArtiste($this->by);
		$this->load->view('layout/header');
		$this->load->view('artiste_list',['artistes'=>$artistes, 'by'=>$this->by]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$this->load->model('model_music');
		$artiste = $this->model_artiste->getSingleArtiste($id);
		$albums = $this->model_music->getAlbumsOfArtist($id);
		$musics = $this->model_music->getMusicsOfArtist($id, $this->sorted, $this->by);
		$this->load->view('layout/header');
		$this->load->view('artiste_page',['artiste'=>$artiste, 'albums'=>$albums, 'musics'=>$musics, 'id'=>$id, 'sorted'=>$this->sorted, 'by'=>$this->by]);
		$this->load->view('layout/footer');
	}
}