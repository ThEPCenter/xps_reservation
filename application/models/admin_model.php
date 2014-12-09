<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_reserved_date($reserve_date = '') {
        if (!empty($reserve_date)):
            $this->db->where('reserved_date', $reserve_date);
            return $this->db->get('xps_reservation');
        else:
            return $this->db->get('xps_reservation');
        endif;
    }

    public function get_reserved_data($reserve_date, $reserved_id) {
        if (!empty($reserve_date) && !empty($reserved_id)):
            $this->db->where('reserved_id', $reserved_id);
            $this->db->where('reserved_date', $reserve_date);
            return $this->db->get('xps_reservation');
        else:
            return $this->db->get('xps_reservation');
        endif;
    }

    public function update_reserved_data() {
        $reserved_id = $this->input->post('reserved_id');
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');
        $sample_number = $this->input->post('sample_number');
        $detail = $this->security->xss_clean($this->input->post('detail'));
        $reserved_date = $this->input->post('reserved_date');
        $data = array(
            'status' => $status,
            'sample_number' => $sample_number,
            'detail' => $detail,
            'reserved_date' => date("Y-m-d", strtotime($reserved_date)),
            'updated' => date("Y-m-d H:i:s"),
            'user_id' => $user_id
        );
        $this->db->where('reserved_id', $reserved_id);
        $this->db->update('xps_reservation', $data);
        return date("Y-m-d", strtotime($reserved_date));
    }

    public function add_reserved() {
        $reserved_date = $this->input->post('reserved_date');
        $status = $this->input->post('status');
        $detail = $this->security->xss_clean($this->input->post('detail'));
        $user_id = $this->input->post('user_id');
        $data = array(
            'status' => 'occupied',
            'status' => $status,
            'detail' => $detail,
            'reserved_date' => $reserved_date,
            'created' => date("Y-m-d H:i:s"),
            'user_id' => $user_id
        );
        $this->db->insert('xps_reservation', $data);
    }

    public function delete_reserved_data() {
        $reserved_id = $this->input->post('reserved_id');
        $this->db->delete('xps_reservation', array('reserved_id' => $reserved_id));
    }

    public function get_user_detail($user_id) {
        $this->db->where('user_id', $user_id);
        $q_user = $this->db->get('xps_user');
        return $q_user->result();
    }

    public function get_user_position($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('xps_user_position');
        return $query->result();
    }

    public function get_user_reservation($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by("reserved_date", "asc");
        return $this->db->get('xps_reservation');
    }

    public function update_user_detail() {
        $user_id = $this->input->post('user_id');
        $firstname = $this->security->xss_clean($this->input->post('firstname'));
        $lastname = $this->security->xss_clean($this->input->post('lastname'));
        $phone = $this->input->post('phone');

        $position = $this->input->post('position');
        $detail = $this->security->xss_clean($this->input->post('detail'));
        $supervisor = $this->security->xss_clean($this->input->post('supervisor'));
        $institute = $this->security->xss_clean($this->input->post('institute'));

        $data_user = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'updated' => date("Y-m-d H:i:s")
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('xps_user', $data_user);

        $data_position = array(
            'position' => $position,
            'detail' => $detail,
            'supervisor' => $supervisor,
            'institute' => $institute,
            'updated' => date("Y-m-d H:i:s")
        );
        $this->db->where('user_id', $user_id);
        $this->db->update('xps_user_position', $data_position);
    }

}
