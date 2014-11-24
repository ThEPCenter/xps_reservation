<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // ======== Library ======== //
        $this->load->library('session');

        // ======== Driver ======== //
        $this->load->database();

        // ======== Helper ======== //
        $this->load->helper('url');
        $this->load->helper('html');

        // ======== Class ======== //
        $this->load->library('pagination');


        if (!($this->session->userdata('validated'))) {
            redirect('login');
        }

        // ========= Commom Models ========= //
        $this->load->model('login_model');
    }

    public function index() {
        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data['email'] = $this->session->userdata('email'); 
        $data['title'] = 'Home';
        $this->load->view('templates/header', $data);
        $this->load->view('home_view');
        $this->load->view('templates/footer');
        
    }

}
