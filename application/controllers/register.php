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
        $email = $this->input->post('email');
        $confirm_code = substr(md5(microtime()), rand(0, 26), 16);

        if (!empty($email)):

            $data['email'] = $email;
            $data['confirm_code'] = $confirm_code;
            $data['token'] = 'cf427b0e093236e1009b00b7561e3294cb99a8d0';

            // $this->register_model->add_new_user();
            // $this->send_confirm_email($email);
            // $email = urlencode($email);
            // redirect("register/send_email/$email");

            $data['title'] = 'ผลการสมัคร';
            $this->load->view('register_result_view', $data);
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

    public function send_confirm_email($email) {
        if (!empty($email)) {
            // $confirm_code = substr(md5(microtime()), rand(0, 26), 16);


            /** Use this if it work
             *               
              $config['wordwrap'] = FALSE;
              $this->email->initialize($config);
              $this->email->from('xps_noreply@thep-center.org', 'XPS ThEP');
              $this->email->to($email);
              $this->email->subject('XPS Email confirmation');
              $message = "กรุณาคลิ้กยืนยันอีเมล >> http://cnxlove.com/central_instrument/index.php/register/confirm_email/$confirm_code";

              $this->email->message("$message");
              if ($this->email->send()) {
              $this->register_model->add_new_user();
              $this->register_model->insert_confirm_code($confirm_code, $email);
              } else {

              }
             * 
             */
            /** Use mail service
             * 
             */
            $this->register_model->add_new_user();
            $user_id = $this->register_model->insert_confirm_code($confirm_code, $email);
            $encode_email = urlencode($email);
            $location = "http://cnxlove.com/services/mail_service.php?email=$encode_email&user_id=$user_id&confirm_code=$confirm_code&token=cf427b0e093236e1009b00b7561e3294cb99a8d0";
            redirect($location);
        }
    }

    public function send_email($confirm_code) {
        if (!empty($confirm_code)):
            $data['title'] = "ขอบคุณที่สมัครใช้บริการ";
            $this->db->where('confirm_code', $confirm_code);
            $q_confirm = $this->db->get('xps_user_confirm');
            foreach ($q_confirm->result() as $r_confirm):
                $user_id = $r_confirm->user_id;
            endforeach;
            $this->db->where('user_id', $user_id);
            $q_user = $this->db->get('xps_user');
            foreach ($q_user->result() as $user):
                $email = $user->email;
            endforeach;

            $data['text'] = "<p>ระบบได้ส่งลิงค์ยืนยันการสมัครไปยังอีเมล: $email</p> <p><strong>กรุณากดยืนยันลิงค์ดังกล่าวก่อน อีเมลของท่านจึงจะสามารถเข้าใช้งานได้</strong></p>";
            $data['text'] .= "<p>**หมายเหตุ: หากไม่พบอีเมลยืนยันใน กล่องขาเข้า (Inbox) กรุณาตรวจสอบในกล่อง อีเมลขยะ หรือ กล่อง Spam</p>";
            $this->load->view('templates/header', $data);
            $this->load->view('send_view');
            $this->load->view('templates/footer');
        else:
            redirect('login');
        endif;
    }

    public function confirm_email($confirm_code) {

        if (!empty($confirm_code)):
            $confirm_code = $this->security->xss_clean($confirm_code);
            $user_id = $this->register_model->check_confirm_email($confirm_code);
            if ($user_id) {
                if ($this->register_model->login_after_confirm($user_id)) {
                    redirect('home');
                } else {
                    redirect('login');
                }
            } else {
                $data['title'] = 'ไม่สามารถยืนยันอีเมลได้ กรุณาตรวจสอบอีเมลที่ส่งไปยังที่อยู่อีเมลของท่าน';
                $this->load->view('templates/header', $data);
                $this->load->view('confirm_result', $data);
                $this->load->view('templates/footer');
            }
        else:
            redirect('home');
        endif;
    }

    public function check_email() {
        $data['msg'] = $this->register_model->get_email();
        $this->load->view('check_email_view', $data);
    }

}
