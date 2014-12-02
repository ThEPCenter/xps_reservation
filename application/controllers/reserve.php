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

    public function process() {
        $this->reserve_model->add_reserved();
    }

    public function edit_reserved($reserve_date) {
        $query = $this->reserve_model->get_reserved_data($reserve_date);
        if ($query->num_rows() == 0):
            redirect('home/calendar');
        endif;
        foreach ($query->result() as $row):
            $data['reserved_id'] = $row->reserved_id;
            $data['user_id'] = $row->user_id;
            $data['reserved_date'] = $row->reserved_date;
            $data['sample_number'] = $row->sample_number;
            $data['detail'] = $row->detail;
        endforeach;
        if ($data['user_id'] != $this->session->userdata('user_id')):
            redirect('home/calendar');
        endif;

        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data['reserve_date'] = $reserve_date;
        $data['title'] = 'แก้ไขการจอง';
        $this->load->view('templates/header', $data);
        $this->load->view('edit_reserve_view');
        $this->load->view('templates/footer');
    }
    
    public function edit_reserved_process(){
        $reserved_id = $this->input->post('reserved_id');
        if(empty($reserved_id)){
            redirect('home/calendar');
        }
        $this->reserve_model->update_reserved_data();
    }

}
