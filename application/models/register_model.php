<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
    }

    public function add_new_user() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $email = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $firstname = $this->security->xss_clean($this->input->post('firstname'));
        $lastname = $this->security->xss_clean($this->input->post('lastname'));
        $phone = $this->security->xss_clean($this->input->post('phone'));
        $position = $this->security->xss_clean($this->input->post('position'));
        $institute = $this->security->xss_clean($this->input->post('institute'));
        $level = 1;
        $active = 0;
        $created = date("Y-m-d H:i:s");

        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'position' => $position,
            'institute' => $institute,
            'level' => $level,
            'active' => $active,
            'created' => $created
        );
        $this->db->insert('tb_xps_user', $data);
    }

    public function insert_confirm_code($confirm_code, $email) {
        $data = array(
            'email' => $email,
            'confirm_code' => $confirm_code,
            'created' => date("Y-m-d H:i:s")
        );
        $this->db->insert('tb_xps_confirm', $data);
    }

    public function check_confirm_email($confirm_code) {
        $this->db->where('confirm_code', $confirm_code);
        $query = $this->db->get('tb_xps_confirm');

        if ($query->num_rows() == 1):
            foreach ($query->result() as $row) {
                $email = $row->email;
            }

            $updated = date("Y-m-d H:i:s");
            $data = array(
                'active' => 1,
                'updated' => $updated
            );
            $this->db->where('email', $email);
            $this->db->update('tb_xps_user', $data);

            return $row->email;

        else:

            return FALSE;
        endif;
    }

    public function login_after_confirm($email) {
        $data_update = array(
            'recent_login' => date("Y-m-d H:i:s"),
            'last_login' => date("Y-m-d H:i:s")
        );

        $this->db->where('email', $email);
        $this->db->update('tb_xps_user', $data_update);

        $this->db->where('email', $email);
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
            'validated' => TRUE
        );

        $this->session->set_userdata($data);
        return true;
    }

}
