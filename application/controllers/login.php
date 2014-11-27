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
        $data['title'] = "Login";
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
            if ($this->session->userdata('active') == 1):
                redirect('home');
            else:
                $email = urlencode($this->session->userdata('email'));
                // Logout
                $this->session->sess_destroy();
                redirect("login/not_confirm/$email");
            endif;
        }
    }

    public function not_confirm($email) {
        if (!empty($email)):
            $data['email'] = urldecode($email);
            $data['title'] = "ยังไม่ได้ยืนยันอีเมล";
            $this->load->view('templates/header', $data);
            $this->load->view('not_confirm_view', $data);
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

}
