<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }

    public function get_user_detail($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('xps_user');
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
