<?php

class Register_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function store_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function store_student($data)
    {
        $this->db->insert('students', $data);
        return $this->db->insert_id();
    }
}
