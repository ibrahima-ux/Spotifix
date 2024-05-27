<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {
    public $sorted = 'year';
    public $by = 'asc';

    public function __construct() {
        parent::__construct();
        $this->load->model('model_music');
        $this->load->helper('html');
        $this->load->helper('url');

        $this->sorted = $this->input->get('sorted') ?? 'year';
        $this->by = $this->input->get('by') ?? 'asc';
    }

    public function index() {
        $albums = $this->model_music->getAlbums($this->sorted, $this->by);
        $search_query = $this->input->get('search_query'); // Prévoir de recevoir un paramètre de recherche

        // Si une requête de recherche est fournie, filtrer les résultats
        if (!empty($search_query)) {
            $albums = $this->model_music->searchAlbums($search_query);
        }

        $this->load->view('layout/header');
        $this->load->view('albums_list', [
            'albums' => $albums, 
            'sorted' => $this->sorted, 
            'by' => $this->by,
            'search_query' => $search_query  // Passer la requête de recherche à la vue
        ]);
        $this->load->view('layout/footer');
    }

    public function view($id) {
        $album = $this->model_music->getSingleAlbum($id);
        $musics = $this->model_music->getAlbumMusics($id);

        $this->load->view('layout/header');
        $this->load->view('albums_page', [
            'album' => $album, 
            'musics' => musics
        ]);
        $this->load->view('layout/footer');
    }
}


