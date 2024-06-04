<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {
    public $sorted = 'titre';  // Variable pour le tri, par défaut par 'titre'
    public $by = 'asc';  // Direction du tri, par défaut ascendante

    public function __construct() {
        parent::__construct();
        /* chargement des models et helper */
        $this->load->model('model_artiste');
        $this->load->model('model_music');  
        $this->load->helper('html'); 
        $this->load->helper('url');

        // Récupération des paramètres de tri ou définition des valeurs par défaut
        $this->sorted = $this->input->get('sorted') ?? 'titre';
        $this->by = $this->input->get('by') ?? 'asc';
    }

    public function index() {
        $search_query = $this->input->post('search');  // Récupération de la requête de recherche

        // Recherche d'artistes si une requête de recherche est fournie, sinon obtention de tous les artistes
        $artistes = $this->model_artiste->getArtists($this->by, $this->input->get('search'));


        // Chargement des vues avec les données nécessaires
        $this->load->view('layout/header');
        $this->load->view('artiste_list', ['artistes' => $artistes, 'by' => $this->by, 'search'=>$this->input->get('search'), 'search_query' => $search_query]);
        $this->load->view('layout/footer');
    }

    public function view($id) {
        // Récupération des détails d'un seul artiste et de ses albums et musiques associées
        $artiste = $this->model_artiste->getSingleArtiste($id);
        $albums = $this->model_music->getAlbumsOfArtist($id);
        $musics = $this->model_music->getMusicsOfArtist($id, $this->sorted, $this->by);

        // Chargement des vues pour la page de détails de l'artiste
        $this->load->view('layout/header');
        $this->load->view('artiste_page', ['artiste'=>$artiste, 'albums'=>$albums, 'musics'=>$musics, 'id'=>$id, 'sorted'=>$this->sorted, 'by'=>$this->by]);
        $this->load->view('layout/footer');
    }
}
