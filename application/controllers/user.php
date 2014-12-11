<?php

class User extends CI_Controller {

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

        if (!($this->session->userdata('validated'))) {
            redirect('login');
        }

        if ($this->session->userdata('level') == 10) {
            redirect('admin');
        }

        // ========= Commom Models ========= //
        $this->load->model('user_model');
    }

    public function index() {
        redirect('user/user_detail');
    }

    public function user_detail($user_id) {
        $q_user = $this->user_model->get_user_detail($user_id);
        foreach ($q_user as $user):
            $data['firstname'] = $user->firstname;
            $data['lastname'] = $user->lastname;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['recent_login'] = $user->recent_login;
        endforeach;
        $q_position = $this->user_model->get_user_position($user_id);
        foreach ($q_position as $position) :
            $data['position'] = $position->position;
            $data['position_thai'] = $this->position_in_thai($data['position']);
            $data['detail'] = $position->detail;
            $data['supervisor'] = $position->supervisor;
            $data['institute'] = $position->institute;
        endforeach;
        $data['q_reservation'] = $this->user_model->get_user_reservation($user_id);

        $data['user_id'] = $user_id;
        $data['title'] = 'ข้อมูลผู้ใช้';
        $this->load->view('templates/header', $data);
        $this->load->view('user_detail_view');
        $this->load->view('templates/footer');
    }

    public function position_in_thai($position) {
        switch ($position):
            case 'researcher':
                return 'นักวิจัย';
            case 'instructor':
                return 'อาจารย์';
            case 'student':
                return 'นักศึกษา';
            case 'other':
                return 'อื่นๆ';
            default :
                return 'อื่นๆ';
        endswitch;
    }
    
    public function edit_user_detail() {
        $this->user_model->update_user_detail();
        $user_id = $this->input->post('user_id');
        $location = site_url() . '/user/user_detail/' . $user_id;
        redirect($location);
    }

}
