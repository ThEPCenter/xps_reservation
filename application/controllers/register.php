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

    public function process() {
        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)):
            include("recaptcha/getCurlData.php");
            $google_url = "https://www.google.com/recaptcha/api/siteverify";
            $secret = '6LcLV_8SAAAAALq9QzOQoMY59_5g9Me95FBNwb1s';
            $ip = $this->input->ip_address();
            $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
            $res = getCurlData($url);
            $res = json_decode($res, true);
            if ($res['success']) {
                $user_id = $this->register_model->add_new_user();
                redirect(site_url() . '/register/result/success/' . $user_id);
            } else {
                if (!empty($res['error-codes'])) {
                    $error_msg = $res['error-codes'];
                } else {
                    $error_msg = 'Error Not definded error.';
                }
                redirect(site_url() . '/login/error/' . urlencode($error_msg));
            }
        else:
            $error_msg = "Please enter your reCAPTCHA";
            $location = site_url() . '/login/error/' . urlencode($error_msg);
            redirect($location);
        endif;
    }

    public function result($status, $user_id) {
        if ($status == 'success' && !empty($user_id)):
            $text = "<h3>ขอบคุณที่สมัครใช้งาน</h3> ";
            $text .= '<h4>ท่านสามารถเข้าสู่ระบบเพื่อจองคิวได้ที่หน้า  <a href="' . site_url() . '/login">Login</a></h4>';
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
