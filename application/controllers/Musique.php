<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Musique extends CI_Controller {
	public $sorted = 'nom';
	public $by = 'asc';
	
	public function __construct(){
		parent::__construct();

		$CI =& get_instance();

		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('pagination');

		$this->sorted = $this->input->get('sorted') ?? 'nom';
		$this->by = $this->input->get('by') ?? 'asc';
	}
	public function index($page = 1){
		$page = 0 ? 0 : $page-1;
		$config['base_url'] = site_url("musique/index");
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;

		$config['prev_tag_open'] = '<button>';
		$config['prev_link'] = "<img src='".base_url("assets/previous.png")."' alt='' width='30px' />";
		$config['prev_tag_close'] = '</button>';

		$config['next_tag_open'] = '<button>';
		$config['next_link'] = "<img src='".base_url("assets/next.png")."' alt='' width='30px' />";
		$config['next_tag_close'] = '</button>';

		if ($page < 0) {
			$page = 0;
		}
		$nbMusiques = $this->model_music->CountMusics($this->sorted, $this->by, $this->input->get('search'));
		$pagesmax = $this->model_music->CountPages($this->sorted, $this->by, $this->input->get('search'));
		$musics = $this->model_music->getMusics($this->sorted, $this->by, $this->input->get('search'), $page);

		$config['total_rows'] = $nbMusiques;
		$config['per_page'] = 100;
		$this->pagination->initialize($config);

		$this->load->view('layout/header');
		$this->load->view('music_list',['musics'=>$musics, 
										'sorted'=>$this->sorted, 'by'=>$this->by, 
										'page'=>$page, 'pagesmax'=>$pagesmax, 
										'search'=>$this->input->get('search'), 'pagination'=>$this->pagination
										]);
		$this->load->view('layout/footer');
	}
	public function view($id){
		$musics = $this->model_music->getSingleMusics($id);
		$this->load->view('layout/header');
		$this->load->view('music_page',['musics'=>$musics]);
		$this->load->view('layout/footer');
	}
}

