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
                $user_id = $this->session->userdata('user_id');
                // Logout
                $this->session->sess_destroy();
                redirect("login/not_confirm/$user_id");
            endif;
        }
    }

    public function not_confirm($user_id) {
        if (!empty($user_id)):
            $user_id = $this->security->xss_clean($user_id);
            $this->db->where('user_id', $user_id);
            $query = $this->db->get('xps_user');
            if ($query->num_rows() == 1):
                foreach ($query->result() as $row):
                    $email = $row->email;
                endforeach;
            else:
                redirect('login');
            endif;

            $data['email'] = $email;
            $data['title'] = "ยังไม่ได้ยืนยันอีเมล";
            $this->load->view('templates/header', $data);
            $this->load->view('not_confirm_view', $data);
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

}
