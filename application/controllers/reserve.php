<?php

class Reserve extends CI_Controller {

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
        $this->load->model('reserve_model');
    }

    public function index() {
        redirect('home');
    }

    public function reserved_date($date_reserve) {
        $data['date_stamp'] = strtotime($date_reserve);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data["title"] = 'การจองคิว';
        $this->load->view('templates/header', $data);
        $this->load->view('reserve_view');
        $this->load->view('templates/footer');
    }

}
