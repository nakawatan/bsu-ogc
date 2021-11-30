<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function authenticate_admin($username,$password){
        $password = MD5('BatangasStateUniversity::' . $password . '::BSU');

        $this->db->where('username', antiHack($username));
        $this->db->where('password', antiHack($password));
        // $this->db->where('google_id', antiHack($google_id));

        $tmp = $this->db->get('users')->row_array();

        $result = [];
        if (isset($tmp) && COUNT($tmp) > 0) {
            $result = array(
                'user_id'       => $tmp['user_id'],
                'student_id'    => $tmp['student_id'],
                'username'      => $tmp['username'],
                'email'         => $tmp['email'],
                'user_level'    => $tmp['user_level'],
                'last_login'    => $tmp['last_login'],
                'image'         => $tmp['image'],
                'google_id'         => $tmp['google_id'],
            );

            // $this->session->set_userdata('administrator', $result);

            $last_login = array(
                'last_login' => getCurrDT(true)
            );
            $this->db->where('user_id', $tmp['user_id']);
            $this->db->update('users', $last_login);
        }
        return $result;
    }

    public function authenticate($google_id)
    {
        
        // $password = MD5('BatangasStateUniversity::' . $password . '::BSU');

        // $this->db->where('username', antiHack($username));
        // $this->db->where('password', antiHack($password));
        $this->db->where('google_id', antiHack($google_id));

        $tmp = $this->db->get('users')->row_array();

        $result = [];
        if (isset($tmp) && COUNT($tmp) > 0) {
            $result = array(
                'user_id'       => $tmp['user_id'],
                'student_id'    => $tmp['student_id'],
                'username'      => $tmp['username'],
                'email'         => $tmp['email'],
                'user_level'    => $tmp['user_level'],
                'last_login'    => $tmp['last_login'],
                'image'         => $tmp['image'],
                'google_id'         => $tmp['google_id'],
            );

            // $this->session->set_userdata('administrator', $result);

            $last_login = array(
                'last_login' => getCurrDT(true)
            );
            $this->db->where('user_id', $tmp['user_id']);
            $this->db->update('users', $last_login);
        }
        return $result;
    }

    public function user_detail($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->join('students', 'users.student_id = students.student_id');
        $query = $this->db->get()->row_array();
        return $query;
    }

    public function update($table, $data, $where_col, $where_val=NULL)
    {
        $this->db->set($data);
        if (is_array($where_col) && !empty($where_col)) {
            foreach ($where_col as $key => $value) {
                $this->db->where($key, $value);
            }
        }else {
            if (isset($where_val) && !is_null($where_val)){
                $this->db->where($where_col, $where_val);
            }
        }
        $this->db->update($table, $data);
        // return $this->db->get_compiled_insert($table);
        
        return $this->db->affected_rows();
    }
}
