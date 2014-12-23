<?php

class Register extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // ======== Library ======== //
        $this->load->library('session');
        $this->load->library('email');

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

    public function data_confirmation() {
        $email = $this->input->post('email');
        if (!empty($email)):
            $username = $this->security->xss_clean($this->input->post('username'));
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $firstname = $this->security->xss_clean($this->input->post('firstname'));
            $lastname = $this->security->xss_clean($this->input->post('lastname'));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $position = $this->security->xss_clean($this->input->post('position'));
            $detail = $this->security->xss_clean($this->input->post('detail'));
            $supervisor = $this->security->xss_clean($this->input->post('supervisor'));
            $institute = $this->security->xss_clean($this->input->post('institute'));
            $data = array(
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'phone' => $phone,
                'position' => $position,
                'detail' => $detail,
                'supervisor' => $supervisor,
                'institute' => $institute,
            );

            $data['title'] = 'ยืนยันข้อมูล การสมัคร';
            $this->load->view('templates/header', $data);
            $this->load->view('register/process_view');
            $this->load->view('templates/footer');

        else:
            redirect(site_url() . '/login');
        endif;
    }

    public function process() {
        $email = $this->input->post('email');
        if (!empty($email)):
            $user_id = $this->register_model->add_new_user();
            $location = site_url() . '/register/result/success/' . $user_id;
            redirect($location);
        else:
            redirect('login');
        endif;
    }

    public function result($status, $user_id) {
        if ($status == 'success' && !empty($user_id)):
            $text = "<h3>ขอบคุณที่สมัครใช้งานระบบจองคิวเครื่อง  XPS</h3> ";
            $text .= '<h4>ท่านสามารถเข้าสู่ระบบเพื่อจองคิวได้ที่หน้า  <a title="เข้าสู่ระบบ" href="' . site_url() . '/login">Login</a></h4>';
            $text .= "<h4>หากประสบปัญหาหรือมีข้อสงสัย กรุณาติดต่อ </h4>";
            $text .= "<h5>คุณชาญวิทย์ ศรีพรหม</h5>";
            $text .= "<h5>E-mail : chanvit82@hotmail.com</h5>";
            $text .= "<h5>โทรศัพท์ : 053-942464, 053-943379</h5>";
            $text .= "<h5>โทรศัพท์มือถือ : 087-7250960</h5>";

            $data['text'] = $text;
            $data['title'] = "ขอบคุณที่สมัครใช้บริการ";
            $this->load->view('templates/header', $data);
            $this->load->view('send_view');
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

    public function check_email() {
        $data['check_msg'] = $this->register_model->get_email();
        $this->load->view('check_email_view', $data);
    }

}
