<?php

class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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
    
    public function get_student($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('students')
            ->row();

        return $qry;
    }

    // public function request_list($student_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('students');
    //     $this->db->join('appointment', 'appointment.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_job_application', 'request_cgmc_job_application.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_ojt', 'request_cgmc_ojt.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_rnu_rep', 'request_cgmc_rnu_rep.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_scholarship', 'request_cgmc_scholarship.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_tosa_app', 'request_cgmc_tosa_app.student_id = students.student_id', 'left');
    //     $this->db->join('request_cgmc_transferee', 'request_cgmc_transferee.student_id = students.student_id', 'left');
    //     $this->db->where('students.student_id', $student_id);
    //     $query = $this->db->get()->row();
    //     return $query;
    // }

    public function get_appointment($student_id, $type)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->where('type', $type)
            ->order_by("id", "desc")
            ->get('appointment')
            ->row();

        return $qry;
    }

    public function store_appointment($data)
    {
        $this->db->insert('appointment', $data);
        return $this->db->insert_id();
    }

    public function check_duplicate_appointment($student_id, $type){
        $result = false;
        $this->db->where('student_id', $student_id)->where('status !=', 'reject');
        $this->db->where('type', $type);
        $result_user = $this->db->get('appointment')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function check_day_appointment($date, $type){
        $result = false;
        $this->db->where('appointment_date', $date)->where('status !=', 'reject');
        // $this->db->where('type', $type);
        $result_user = $this->db->get('appointment');
        if(isset($result_user) && $result_user->num_rows()> 1){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function check_available_time($date){
        $result = false;
        $this->db->where('appointment_date ==', date('Y-m-d h:i:s', strtotime($time)));
        $result_user = $this->db->get('appointment')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    public function count_gc_appointment($date)
    {
        $this->db->where('appointment_date >=', $date . ' 00:00:00');
        $this->db->where('appointment_date <=', $date . ' 23:59:59');
        $this->db->from('tbl_appointment');
        
        return $this->db->count_all_results();
    }

    // Request CGMC for OJT
    public function store_request_cgmc_ojt($data)
    {
        $this->db->insert('request_cgmc_ojt', $data);
        return $this->db->insert_id();
    }

    public function update_request_cgmc_ojt($data)
    {
        $this->db->insert('request_cgmc_ojt', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_ojt($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_ojt')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_ojt($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('registration_form_status', 'pending');
        $this->db->where('cgmc_form_status', 'pending');
        $this->db->where('career_advising_status', 'pending');
        $result_user = $this->db->get('request_cgmc_ojt')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    // =========================================================


    // Request CFMC for Job Application
    public function store_request_cgmc_job_application($data)
    {
        $this->db->insert('request_cgmc_job_application', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_job_application($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_job_application')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_job_application($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('receipt_number_status', 'pending');
        $this->db->where('tor_status', 'pending');
        $result_user = $this->db->get('request_cgmc_job_application')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    // =========================================================


    // Request CFMC for Scholarship
    public function store_request_cgmc_scholarship($data)
    {
        $this->db->insert('request_cgmc_scholarship', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_scholarship($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_scholarship')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_scholarship($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('receipt_number_status', 'pending');
        $this->db->where('application_form_status', 'pending');
        $this->db->where('registration_form_status', 'pending');
        $this->db->where('grades_from_prev_status', 'pending');
        $result_user = $this->db->get('request_cgmc_scholarship')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    // =========================================================


    // Request CFMC for Transferee
    public function store_request_cgmc_transferee($data)
    {
        $this->db->insert('request_cgmc_transferee', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_transferee($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_transferee')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_transferee($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('receipt_number_status', 'pending');
        $this->db->where('exit_interview_form_status', 'pending');
        $result_user = $this->db->get('request_cgmc_transferee')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    // =========================================================


    // Request CFMC for TOSA Application
    public function store_request_cgmc_tosa_app($data)
    {
        $this->db->insert('request_cgmc_tosa_app', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_tosa_app($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_tosa_app')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_tosa_app($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('receipt_number_status', 'pending');
        $this->db->where('tosa_app_form_of_scholarship_status', 'pending');
        $this->db->where('registration_status', 'pending');
        $this->db->where('proof_of_app_of_ha_status', 'pending');
        $result_user = $this->db->get('request_cgmc_tosa_app')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    // =========================================================


    // Request CFMC for Regional, National University's Representative
    public function store_request_cgmc_rnu_rep($data)
    {
        $this->db->insert('request_cgmc_rnu_rep', $data);
        return $this->db->insert_id();
    }

    public function get_request_cgmc_rnu_rep($student_id)
    {
        $qry = $this->db->select('*')
            ->where('student_id', $student_id)
            ->get('request_cgmc_rnu_rep')
            ->row();

        return $qry;
    }

    public function check_duplicate_cgmc_rnu_rep($student_id){
        $result = false;
        $this->db->where('student_id', $student_id);
        $this->db->where('registration_form_status', 'pending');
        $result_user = $this->db->get('request_cgmc_rnu_rep')->row_array();
        if(isset($result_user) && COUNT($result_user) > 0){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }


    public function get_option($option_name)
    {
        $qry = $this->db->select('option_value')
            ->where('option_name', $option_name)
            ->get('options')
            ->row();

        return $qry;
    }
}
