<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Git_commandes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
	}
	public function index(){
		$this->load->view('layout/header');
		$this->load->view('git');
		$this->load->view('layout/footer');
	}

	public function push(){
		shell_exec("git commit -m 'update_with_php'");
		shell_exec("git push");
		redirect("git/");
	}

	public function pull(){
		shell_exec("git pull");
		redirect("git/");
	}
}