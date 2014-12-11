<?php

class Reserve_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
    }

    public function add_reserved() {
        $reserved_date = $this->input->post('reserved_date');

        $q_check = $this->get_reserved_data($reserved_date);
        if ($q_check->num_rows() != 0) :
            return FALSE;
        else:
            $sample_number = $this->input->post('sample_number');
            $detail = $this->security->xss_clean($this->input->post('detail'));

            $user_id = $this->input->post('user_id');
            $data = array(
                'status' => 'occupied',
                'sample_number' => $sample_number,
                'detail' => $detail,
                'reserved_date' => $reserved_date,
                'created' => date("Y-m-d H:i:s"),
                'user_id' => $user_id
            );
            $this->db->insert('xps_reservation', $data);

            return $reserved_date;
        endif;
    }

    public function get_reserved_data($reserve_date = '') {
        if (!empty($reserve_date)):
            $this->db->where('reserved_date', $reserve_date);
            return $this->db->get('xps_reservation');
        else:
            return $this->db->get('xps_reservation');
        endif;
    }

    public function update_reserved_data() {
        $reserved_id = $this->input->post('reserved_id');
        $sample_number = $this->input->post('sample_number');
        $detail = $this->security->xss_clean($this->input->post('detail'));
        $reserved_date = $this->input->post('reserved_date');
        $data = array(
            'status' => 'occupied',
            'sample_number' => $sample_number,
            'detail' => $detail,
            'reserved_date' => $reserved_date,
            'updated' => date("Y-m-d H:i:s")
        );
        $this->db->where('reserved_id', $reserved_id);
        $this->db->update('xps_reservation', $data);
        return $reserved_date;
    }

    public function delete_reserved_data() {
        $reserved_id = $this->input->post('reserved_id');
        $this->db->delete('xps_reservation', array('reserved_id' => $reserved_id));
    }

    public function check_reserved_date($reserve_date) {
        $time_stamp = strtotime($reserve_date);

        // check not before today
        $now_stamp = time();
        if ($time_stamp <= $now_stamp) :
            redirect('home');
        endif;

        // check reserved (including holiday and maintenance).
        $this->db->where('reserved_date', $reserve_date);
        $query = $this->db->get('xps_reservation');
        if ($query->num_rows() > 0):
            redirect('home');
        endif;

        // check saturday or sunday
        $time_day = date("l", $time_stamp);
        if ($time_day == 'Saturday' || $time_day == 'Sunday'):
            redirect('home');
        endif;
    }

}
