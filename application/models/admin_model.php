<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // ======== Time Zone Initialization =======//
        date_default_timezone_set("Asia/Bangkok");

        // ======== Tables Initialization =======//
        $this->tables_initialization();
    }

    public function tables_initialization() {
        // ======== Table xps_notification ======= //
        $this->clear_reserved_data();
        $this->check_xps_notifications_table();
        $this->clear_checked_data();
    }

    public function check_xps_notifications_table() {
        if (!$this->db->table_exists('xps_notifications')):
            $fields = array(
                'checked_id' => array('type' => 'INT', 'constraint' => 11, 'null' => FALSE, 'auto_increment' => TRUE),
                'reserved_id' => array('type' => 'INT', 'constraint' => 11, 'null' => FALSE),
                'user_id' => array('type' => 'INT', 'constraint' => 11, 'null' => FALSE),
                'updated' => array('type' => 'DATETIME', 'null' => FALSE),
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('checked_id', TRUE);
            $this->dbforge->create_table('xps_notifications', TRUE);
        endif;
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

    public function get_notification_number() {
        $user_id = $this->session->userdata('user_id');

        $q_reservation = $this->db->get('xps_reservation');
        $reservation_number = $q_reservation->num_rows();

        $this->db->where('user_id', $user_id);
        $q_self = $this->db->get('xps_reservation');
        $self_number = $q_self->num_rows();

        $this->db->where('user_id', $user_id);
        $q_checked = $this->db->get('xps_notifications');
        $checked_number = $q_checked->num_rows();

        return ($reservation_number - $checked_number - $self_number);
    }

    public function get_notification_data() {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id !=', $user_id);
        return $this->db->get('xps_reservation');
    }

    public function notification_checked($reserved_id) {
        $user_id = $this->session->userdata('user_id');
        $data = array(
            'reserved_id' => $reserved_id,
            'user_id' => $user_id,
            'updated' => date("Y-m-d H:i:s")
        );
        $this->db->insert('xps_notifications', $data);
    }

    public function is_checked_notification($reserved_id) {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('reserved_id', $reserved_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('xps_notifications');
        if ($query->num_rows() > 0):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

    public function clear_checked_data() {
        $q_checked = $this->db->get('xps_notifications');
        if ($q_checked->num_rows() > 0):
            foreach ($q_checked->result() as $checked) {
                $reserved_id = $checked->reserved_id;
                $this->db->where('reserved_id', $reserved_id);
                $q_reserved = $this->db->get('xps_reservation');
                if ($q_reserved->num_rows() == 0) :
                    $this->db->where('reserved_id', $reserved_id);
                    $this->db->delete('xps_notifications');
                endif;
            }
        endif;
    }

    public function clear_reserved_data() {
        $q_reserved = $this->db->get('xps_reservation');
        if ($q_reserved->num_rows() > 0):
            foreach ($q_reserved->result() as $reserved) {
                $user_id = $reserved->user_id;
                $this->db->where('user_id', $user_id);
                $q_user = $this->db->get('xps_user');
                if ($q_user->num_rows() == 0) :
                    $this->db->where('user_id', $user_id);
                    $this->db->where('status', 'occupied');
                    $this->db->delete('xps_reservation');
                endif;
            }
        endif;
    }

}
