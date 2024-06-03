<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Musique extends CI_Controller {
	public $sorted = 'nom';
	public $by = 'asc';
	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');

		$this->sorted = $this->input->get('sorted') ?? 'nom';
		$this->by = $this->input->get('by') ?? 'asc';
	}
	public function index($page = 0){
		if ($page < 0) {
			$page = 0;
		}
		$pagesmax = $this->model_music->CountMusics($this->sorted, $this->by, $this->input->get('search'));
		$musics = $this->model_music->getMusics($this->sorted, $this->by, $this->input->get('search'), $page);
		$this->load->view('layout/header');
		$this->load->view('music_list',['musics'=>$musics, 'sorted'=>$this->sorted, 'by'=>$this->by, 'page'=>$page, 'pagesmax'=>$pagesmax, 'search'=>$this->input->get('search')]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$musics = $this->model_music->getSingleMusics($id);
		$this->load->view('layout/header');
		$this->load->view('music_page',['musics'=>$musics]);
		$this->load->view('layout/footer');
	}
}

