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
            $this->send_reserved_email();
            $location = 'reserve/reserved_detail/' . $reserved_date;
        else:
            $location = 'home/calendar';
        endif;
        redirect($location);
    }

    public function send_reserved_email() {
        $user_id = $this->input->post('user_id');
        $reserved_date = $this->input->post('reserved_date');

        $this->db->where('user_id', $user_id);
        $query = $this->db->get('xps_user');
        foreach ($query->result() as $row) :
            $email = $row->email;
            $firstname = $row->firstname;
            $lastname = $row->lastname;
            $phone = $row->phone;
        endforeach;
        $this->db->where('user_id', $user_id);
        $q_position = $this->db->get('xps_user_position');
        foreach ($q_position->result() as $r_po) :
            $position = $r_po->position;
            $detail = $r_po->detail;
            $supervisor = $r_po->supervisor;
            $institute = $r_po->institute;
        endforeach;
        $this->db->where('reserved_date', $reserved_date);
        $q_re = $this->db->get('xps_reservation');
        foreach ($q_re->result() as $r_re) :
            $sample_number = $r_re->sample_number;
            $sample_detail = $r_re->detail;
        endforeach;

        $subject_text = "XPS reservation. " . date("Y-m-d H:i:s");
        $adminemail = $this->admin_email();
        
        $config['wordwrap'] = FALSE;
        $this->email->initialize($config);
        
        $this->email->from('xps_noreply@thep-center.org', 'XPS ThEP');
        $this->email->to($adminemail);
        $this->email->subject($subject_text);

        $message = "วันที่จอง: " . date("l, F j, Y", strtotime($reserved_date)) . "\r\n";
        $message .= "จำนวน Sample: " . $sample_number . "\r\n";
        $message .= "รายละเอียด Sample: " . $sample_detail . "\r\n\r\n";
        $message .= "ชื่อผู้จอง: " . $firstname . ' ' . $lastname . "\r\n";
        if ($position == 'other'):
            $position = $detail;
        endif;
        $message .= "Email: " . $email . "\r\n";
        $message .= "โทรศัพท์: " . $phone . "\r\n";
        $message .= "ตำแหน่ง / อาชีพ: " . $position . "\r\n";
        if (!empty($supervisor)):
            $message .= "อาจารย์ที่ปรึกษา (supervisor): " . $supervisor . "\r\n";
        endif;
        $message .= "สถาบัน/สถานศึกษา/หน่วยงาน: " . $institute;

        $this->email->message($message);

        if (!$this->email->send()) {
            redirect('home');
        }
    }

    public function admin_email() {
        $this->db->where('level', 10);
        $query = $this->db->get('xps_user');
        $email_list = array();
        $nums = $query->num_rows();
        for($i=1;$i<$nums;$i++):
            $email_list[$i] = '';
        endfor;
        $i = 0;
        foreach ($query->result() as $row) {
            $email_list[$i] = $row->email;
            $i++;
        }
        return $email_list;
    }

    public function reserved_detail($reserve_date) {
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