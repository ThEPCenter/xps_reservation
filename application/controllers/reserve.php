<?php

class Reserve extends CI_Controller {

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
        $this->load->model('reserve_model');
    }

    public function index() {
        redirect('home');
    }

    public function reserved_date($date_reserve) {
        $this->reserve_model->check_reserved_date($date_reserve);
        $data['date_stamp'] = strtotime($date_reserve);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data["title"] = 'จองคิว';
        $this->load->view('templates/header', $data);
        $this->load->view('reserve_view');
        $this->load->view('templates/footer');
    }

    public function process() {
        $reserved_date = $this->reserve_model->add_reserved();
        if ($reserved_date):
            $location = 'reserve/reserved_detail/' . $reserved_date;
            redirect($location);
        endif;
        $location = 'home/calendar';
        redirect($location);
    }

    public function reserved_detail($reserve_date) {
        $query = $this->reserve_model->get_reserved_data($reserve_date);
        if ($query->num_rows() == 0):
            redirect('home/calendar');
        endif;
        foreach ($query->result() as $row):
            $data = array(
                'reserved_id' => $row->reserved_id,
                'user_id' => $row->user_id,
                'reserved_date' => $row->reserved_date,
                'sample_number' => $row->sample_number,
                'detail' => $row->detail,
                'created' => $row->created,
                'updated' => $row->updated
            );
        endforeach;
        if ($data['user_id'] != $this->session->userdata('user_id')):
            redirect('home/calendar');
        endif;
        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data['reserve_date'] = $reserve_date;
        $data['title'] = 'ข้อมูลการจอง';
        $this->load->view('templates/header', $data);
        $this->load->view('reserved_detail_view');
        $this->load->view('templates/footer');
    }

    public function edit_reserved_process() {
        $reserved_id = $this->input->post('reserved_id');
        if (empty($reserved_id)) {
            redirect('home/calendar');
        }
        $reserved_date = $this->reserve_model->update_reserved_data();
        $location = site_url() . '/reserve/reserved_detail/' . $reserved_date;
        redirect($location);
    }

    public function delete_reserved_process() {
        $this->reserve_model->delete_reserved_data();
        $location = site_url() . '/home/calendar';
        redirect($location);
    }

}
