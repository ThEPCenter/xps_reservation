<?php

class Register_model extends CI_Model {

    public function __construct() {
        parent::__construct();

        date_default_timezone_set("Asia/Bangkok");
    }

    /**
     * add_new_user Method
     * 
     * @return number
     */
    public function add_new_user() {
        $username = $this->security->xss_clean($this->input->post('username'));
        $email = $this->input->post('email');
        $password = sha1($this->input->post('password'));
        $firstname = $this->security->xss_clean($this->input->post('firstname'));
        $lastname = $this->security->xss_clean($this->input->post('lastname'));
        $phone = $this->security->xss_clean($this->input->post('phone'));
        $level = 1;
        $active = 1;
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

        return $user_id;
    }

    public function get_email() {
        $register_email = $this->security->xss_clean($this->input->get('register_email'));
        if (!filter_var($register_email, FILTER_VALIDATE_EMAIL)) {
            return '<span style="color: red" class="glyphicon glyphicon-remove"></span> <b style="color: red">รูปแบบอีเมลไม่ถูกต้อง (Invalid email format)</b>';
        } else {
            $this->db->where('email', $register_email);
            $query = $this->db->get('xps_user');
            if ($query->num_rows == 1):
                return '<span style="color: red" class="glyphicon glyphicon-remove"></span> <b style="color: red">อีเมลนี้ซ้ำ</b>';
            else:
                return '<span style="color: green" class="glyphicon glyphicon-ok"></span> <b style="color: green">อีเมลนี้สามารถใช้ได้</b>';
            endif;
        }
    }

}
