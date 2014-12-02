<?php

class Reserve_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
    }

    public function add_reserved() {
        $sample_number = $this->input->post('sample_number');
        $detail = $this->security->xss_clean($this->input->post('sample_detail'));
        $reserved_date = $this->input->post('reserved_date');
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
        
    }

}
