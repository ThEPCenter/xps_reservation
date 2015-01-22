<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // ======== Library ========//
        $this->load->library('session');

        // ======== Driver ======== //
        $this->load->database();

        // ======== Helper ======== //
        $this->load->helper('url');
        $this->load->helper('html');

        if ($this->session->userdata('validated')) {
            redirect('home');
        }
    }

    public function index() {
        $data['title'] = "ระบบจองคิวเครื่อง XPS";
        $this->load->view('templates/header', $data);
        $this->load->view('login_view', $data);
        $this->load->view('templates/footer');
    }

    public function error($error_msg) {
        $data['title'] = "Error Register";
        $data['error_msg'] = urldecode($error_msg);
        $this->load->view('templates/header', $data);
        $this->load->view('login_view', $data);
        $this->load->view('templates/footer');
    }

    public function process() {
        // Load the model
        $this->load->model('login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if (!$result) {
            // If user did not validate, then show them login page again
            redirect('login');
        } else {
            // If user did validate, 
            // Send them to members area
            redirect('home');
        }
    }

}
