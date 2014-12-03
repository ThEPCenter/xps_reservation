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
        $level = 1;
        $active = 0;
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
            'level' => $level,
            'active' => $active,
            'created' => date("Y-m-d H:i:s")
        );
        $this->db->insert('xps_user', $data);
        $user_id = $this->db->insert_id();

        $position = $this->security->xss_clean($this->input->post('position'));
        $detail = $this->security->xss_clean($this->input->post('detail'));
        $supervisor = $this->security->xss_clean($this->input->post('supervisor'));
        $institute = $this->security->xss_clean($this->input->post('institute'));
        $data_position = array(
            'position' => $position,
            'detail' => $detail,
            'supervisor' => $supervisor,
            'institute' => $institute,
            'user_id' => $user_id,
            'created' => date("Y-m-d H:i:s")
        );
        $this->db->insert('xps_user_position', $data_position);        
    }

    public function insert_confirm_code($confirm_code, $email) {
        $this->db->where('email', $email);
        $query = $this->db->get('xps_user');
        foreach ($query->result() as $row) {
            $user_id = $row->user_id;
        }
        $data = array(
            'confirm_code' => $confirm_code,
            'user_id' => $user_id,
            'created' => date("Y-m-d H:i:s")
        );
        $this->db->insert('xps_user_confirm', $data);
    }

    public function check_confirm_email($confirm_code) {
        $this->db->where('confirm_code', $confirm_code);
        $query = $this->db->get('xps_user_confirm');

        if ($query->num_rows() == 1):
            foreach ($query->result() as $row) :
                $user_id = $row->user_id;

                $this->db->where('user_id', $user_id);
                $qu = $this->db->get('xps_user');
                foreach ($qu->result() as $r):
                    $email = $r->email;
                endforeach;
            endforeach;

            $data = array(
                'active' => 1,
                'updated' => date("Y-m-d H:i:s")
            );
            $this->db->where('user_id', $user_id);
            $this->db->update('xps_user', $data);

            $data_confirm = array('confirmed' => date("Y-m-d H:i:s"));
            $this->db->where('confirm_code', $confirm_code);
            $this->db->update('xps_user_confirm', $data_confirm);

            return $email;

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
        $this->db->update('xps_user', $data_update);

        $this->db->where('email', $email);
        $query = $this->db->get('xps_user');
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

    public function get_email() {
        $register_email = $this->security->xss_clean($this->input->get('register_email'));
        $this->db->where('email', $register_email);        
        $query = $this->db->get('xps_user');
        if ($query->num_rows == 1):
            return '<span style="color: red" class="glyphicon glyphicon-remove"></span> <b style="color: red">อีเมลนี้ซ้ำ</b>';
        else:
            return '<span style="color: green" class="glyphicon glyphicon-ok"></span> <b style="color: green">อีเมลนี้สามารถใช้ได้</b>';
        endif;
    }

}
