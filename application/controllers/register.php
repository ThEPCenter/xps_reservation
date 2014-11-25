<?php

class Register extends CI_Controller {

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

        // ========= Commom Models ========= //
        $this->load->model('register_model');
    }

    public function index() {
        if (!$this->input->post('email')) {
            redirect('login');
        }
    }

    public function process() {
        echo "Hello " . $this->input->post('firstname');
    }

}
