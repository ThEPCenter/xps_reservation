<?php

class Admin extends CI_Controller {

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

        if ($this->session->userdata('level') != 10) {
            redirect('home');
        }

        // ========= Commom Models ========= //
        $this->load->model('admin_model');
        $this->load->model('login_model');
    }

    public function index() {
        redirect('admin/calendar');
    }

    public function calendar() {
        $query = $this->admin_model->get_reserved_date();
        $all_text = '';
        foreach ($query->result() as $row):
            $all_text .= '{"title":"' . $this->reserved_status($row->status) . '","start":"' . $row->reserved_date . '","url":"' . $this->url_detail($row->reserved_date, $row->reserved_id) . '","color":"' . $this->status_color($row->status) . '","className":"occupied"},';

        endforeach;
        $data['reserved_data'] = $all_text;

        $date_nums = 90;
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
        $data['title'] = 'Admin home';
        $this->load->view('admin/calendar_view', $data);
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
        return site_url() . '/admin/reserved_date/' . $date_reserve;
    }

    public function url_detail($date_reserve, $reserved_id) {
        return site_url() . '/admin/reserved_detail/' . $date_reserve . '/' . $reserved_id;
    }

    public function url_edit($date_reserve) {
        return site_url() . '/admin/edit_reserved/' . $date_reserve;
    }

    public function reserved_detail($reserve_date, $reserved_id) {
        $query = $this->admin_model->get_reserved_data($reserve_date, $reserved_id);
        if ($query->num_rows() == 0):
            redirect('admin');
        endif;
        foreach ($query->result() as $row):
            $data['reserved_id'] = $row->reserved_id;
            $data['user_id'] = $row->user_id;
            $data['status'] = $row->status;
            $data['reserved_date'] = $row->reserved_date;
            $data['sample_number'] = $row->sample_number;
            $data['detail'] = $row->detail;
            $data['created'] = $row->created;
            $data['updated'] = $row->updated;
        endforeach;
        $this->db->where('user_id', $data['user_id']);
        $q_user = $this->db->get('xps_user');
        foreach ($q_user->result() as $r_user) :
            $data['firstname'] = $r_user->firstname;
            $data['lastname'] = $r_user->lastname;
        endforeach;

        $data['reserve_date'] = $reserve_date;
        $data['title'] = 'ข้อมูลการจองคิว';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/reserved_detail_view');
        $this->load->view('templates/footer');
    }

    public function reserved_date($date_reserve) {
        $data['date_stamp'] = strtotime($date_reserve);
        $data['user_id'] = $this->session->userdata('user_id');
        $data['firstname'] = $this->session->userdata('firstname');
        $data['lastname'] = $this->session->userdata('lastname');
        $data['title'] = 'จองคิว';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/reserve_view');
        $this->load->view('templates/footer');
    }

    public function edit_reserved_process() {
        $reserved_id = $this->input->post('reserved_id');

        if (empty($reserved_id)) {
            redirect('admin/calendar');
        }
        $reserved_date = $this->admin_model->update_reserved_data();
        $location = site_url() . '/admin/reserved_detail/' . $reserved_date . '/' . $reserved_id;
        redirect($location);
    }

    public function reserve_process() {
        $this->admin_model->add_reserved();
        $location = site_url() . '/admin/calendar';
        redirect($location);
    }

    public function delete_reserved_process() {
        $this->admin_model->delete_reserved_data();
        $location = site_url() . '/home/calendar';
        redirect($location);
    }

    public function user_detail($user_id) {
        $q_user = $this->admin_model->get_user_detail($user_id);
        foreach ($q_user as $user):
            $data['firstname'] = $user->firstname;
            $data['lastname'] = $user->lastname;
            $data['email'] = $user->email;
            $data['phone'] = $user->phone;
            $data['level'] = $user->level;
            $data['recent_login'] = $user->recent_login;
        endforeach;
        $q_position = $this->admin_model->get_user_position($user_id);
        foreach ($q_position as $position) :
            $data['position'] = $position->position;
            $data['position_thai'] = $this->position_in_thai($data['position']);
            $data['detail'] = $position->detail;
            $data['supervisor'] = $position->supervisor;
            $data['institute'] = $position->institute;
        endforeach;
        $data['q_reservation'] = $this->admin_model->get_user_reservation($user_id);

        $data['user_id'] = $user_id;
        $data['title'] = 'ข้อมูลผู้ใช้';
        $this->load->view('templates/header', $data);
        $this->load->view('admin/user_detail_view');
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
        $this->admin_model->update_user_detail();
        $user_id = $this->input->post('user_id');
        $location = site_url() . '/admin/user_detail/' . $user_id;
        redirect($location);
    }

}
