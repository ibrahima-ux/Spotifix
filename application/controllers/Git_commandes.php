<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	
class Git_commandes extends CI_Controller {

	/**
	 * cette class aurait permis de gérer l'envoie et la récupération 
	 * de modifications fait dans sur un serveur git.
	 * 
	 * la fonction push() : permet de récupérer son travail depuis un dépot
	 * la fonction push() : permet d'envoyer son travail sur un dépot
	 */

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
		//shell_exec("git commit -m 'update_with_php'");
		//shell_exec("git push");
		$this->index();
	}

	public function pull(){
		//shell_exec("git pull");
		$this->index();
	}
}