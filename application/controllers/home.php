<?php

class Home extends CI_Controller {

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

        if ($this->session->userdata('level') == 10) {
            redirect('admin');
        }

        $this->load->model('login_model');
        $this->load->model('reserve_model');
    }

    public function index() {
        redirect('home/calendar');
    }

    public function calendar() {
        $query = $this->reserve_model->get_reserved_data();
        $all_text = '';
        foreach ($query->result() as $row):
            if ($row->user_id == $this->session->userdata('user_id')):
                if ($this->session->userdata('level') == 10):
                    $all_text .= '{"title":"' . $this->reserved_status($row->status) . '","start": "' . $row->reserved_date . '", "url":"' . $this->url_detail($row->reserved_date) . '","color":"' . $this->status_color($row->status) . '","className":"occupied"},';
                else:
                    $all_text .= '{"title":"คุณ' . $this->reserved_status($row->status) . '","start": "' . $row->reserved_date . '", "url":"' . $this->url_detail($row->reserved_date) . '","color":"green","className":"occupied"},';
                endif;
            else:
                $all_text .= '{"title":"' . $this->reserved_status($row->status) . '","start":"' . $row->reserved_date . '","color":"' . $this->status_color($row->status) . '","className":"occupied"},';
            endif;
        endforeach;
        $data['reserved_data'] = $all_text;

        $date_nums = 61;
        $free_text = '';
        for ($i = 1; $i < $date_nums; $i++):
            $date_reserve = date("Y-m-d", strtotime("+$i days"));
            if ($this->check_date($i)):
                $free_text .= '{"title":"ว่าง","start":"' . date("Y-m-d", strtotime("+$i days")) . '","url":"' . $this->url_reserve($date_reserve) . '","color": "white","textColor":"black","className":"unoccupied"},';
            endif;
        endfor;
        $data['free_date'] = $free_text;

        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data['email'] = $this->session->userdata('email');
        $data['title'] = 'Home';
        $this->load->view('home_view', $data);
        $this->load->view('templates/footer');
    }

    public function reserved_status($status) {
        switch ($status):
            case 'unoccupied':
                return 'ว่าง';
            case 'occupied':
                return 'จองแล้ว';
            case 'maintenance':
                return 'Maintenance';
            case 'holiday':
                return 'วันหยุดพิเศษ';
        endswitch;
    }

    public function status_color($status) {
        switch ($status):
            case 'unoccupied':
                return 'white';
            case 'occupied':
                return '#ca320a';
            case 'maintenance':
                return '#3a87ad';
            case 'holiday':
                return '#f85226';
        endswitch;
    }

    public function check_date($num) {
        $date_to_check = date("Y-m-d", strtotime("+$num days"));
        $day_to_check = date("l", strtotime("+$num days"));
        $this->db->where('reserved_date', $date_to_check);
        $query = $this->db->get('xps_reservation');
        if ($query->num_rows() == 0):
            if ($day_to_check != 'Saturday' && $day_to_check != 'Sunday'):
                return TRUE;
            else:
                return FALSE;
            endif;

            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function url_reserve($date_reserve) {
        if ($this->session->userdata('level') != 10):
            return site_url() . '/reserve/reserved_date/' . $date_reserve;
        endif;
    }

    public function url_detail($date_reserve) {
        if ($this->session->userdata('level') != 10):
            return site_url() . '/reserve/reserved_detail/' . $date_reserve;
        endif;
    }

    public function url_edit($date_reserve) {
        if ($this->session->userdata('level') != 10):
            return site_url() . '/reserve/edit_reserved/' . $date_reserve;
        endif;
    }

}
