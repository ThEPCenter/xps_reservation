<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function validate() {
        // grab user input
        $email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));

        // Prep the query
        $this->db->where('email', $email);
        $this->db->where('password', sha1($password));
        // Run the query
        $query = $this->db->get('tb_xps_user');

        // Let's check if there are any results        
        if ($query->num_rows == 1) {
            $row = $query->row();
            date_default_timezone_set("Asia/Bangkok");
            $data_update = array(
                'recent_login' => date("Y-m-d H:i:s"),
                'last_login' => $row->recent_login
            );
            $where = "user_id = $row->user_id";
            $str = $this->db->update_string('tb_xps_user', $data_update, $where);
            $this->db->query($str);

            // If there is a user, then create session data
            $this->db->where('email', $email);
            $this->db->where('password', sha1($password));

            $query = $this->db->get('tb_xps_user');
            $row = $query->row();
            $data = array(
                'user_id' => $row->user_id,
                'username' => $row->username,
                'firstname' => $row->firstname,
                'lastname' => $row->lastname,
                'email' => $row->email,
                'recent_login' => $row->recent_login,
                'last_login' => $row->last_login,
                'level' => $row->level,
                'active' => $row->active,
                'validated' => true
            );

            $this->session->set_userdata($data);
            return true;
        }
    }

}
