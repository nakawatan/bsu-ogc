<?php

class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // $table, $columns, $limit, $offset, $order_val=NULL, $order_dir=NULL, $search_val=NULL
    public function get_table()
    {   
        $results = Array();
        $params = func_get_args()[0];

        $table = $params['table'];
        $columns = $params['columns'];
        $limit = $params['limit'] ?? NULL;
        $offset = $params['offset'] ?? NULL;
        $order_val = ($params['order_val']) ?? NULL;
        $order_dir = ($params['order_dir']) ?? NULL;
        $search_val = ($params['search_val']) ?? NULL;
        $filter = ($params['filter']) ?? NULL;
        $join = ($params['join']) ?? NULL;
        $group_by = ($params['group_by']) ?? NULL;

        
        $this->db->select();
        if ( isset( $join ) && !is_null( $join ) && !empty( $join ) ) {
            foreach ($join as $key => $value) {
                $value = explode('|', $value);
                if ( isset($value[1]) && !is_null($value[1]) && !empty($value[1]) ) {
                    $this->db->join($key, $value[0], $value[1]);
                }else{
                    $this->db->join($key, $value[0]);
                }
            }
        }
        if ( isset( $filter ) && !is_null( $filter ) && !empty( $filter ) ) {
            foreach ($filter as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if(!empty($search_val)) {
            $x=0;
            $this->db->group_start();
            foreach($columns as $s_col) {
                if($x==0) {
                    $this->db->like($s_col,$search_val);
                }else {
                    $this->db->or_like($s_col,$search_val);
                }
                $x++;
            }
            $this->db->group_end();               
        }
        if ( isset( $group_by ) && !is_null( $group_by ) && !empty( $group_by ) ) {
            $this->db->group_by($group_by);
        }
        if( is_null($order_val) && empty($order_val) ) {
            $this->db->order_by('id', $order_dir);
        }else{
            $this->db->order_by($order_val, $order_dir);
        }
        $compile_query = $this->db->get_compiled_select($table,false);
        $results['count'] = $this->db->query($compile_query)->num_rows();
        $compile_query = $this->db->limit($limit,$offset)->get_compiled_select();
        $results['data'] = $this->db->query($compile_query)->result_array();
        
        // echo $compile_query;
        return $results;
    }

    // $table, $columns=NULL, $order_col=NULL, $order_dir='asc', $where_col=NULL, $where_val=NULL
    public function get()
    {   
        $params = func_get_args()[0];
        
        $table = $params['table'];
        $columns = ($params['columns']) ?? '*';
        $order_col = ($params['order_col']) ?? NULL;
        $order_dir = ($params['order_dir']) ?? NULL;
        $where_col = ($params['where_col']) ?? NULL;
        $where_val = ($params['where_val']) ?? NULL;
        $where_in = ($params['where_in']) ?? NULL;
        $join = ($params['join']) ?? NULL;
        $group_by = ($params['group_by']) ?? NULL;
        $limit = ($params['limit']) ?? NULL;
        $offset = ($params['offset']) ?? NULL;

        if ( !isset($columns) && is_null($columns) && empty($columns) ) {
            $columns = '*';
        }

        if( isset($order_col) && !is_null($order_col) && !empty($order_col) ) {
            if ( is_array($order_col) ) {
                foreach ($order_col as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }else{
                $this->db->order_by($order_col, $order_dir);
            }
        }

        $this->db->select($columns);
        if ( isset( $join ) && !is_null( $join ) && !empty( $join ) ) {
            foreach ($join as $key => $value) {
                $value = explode('|', $value);
                if ( isset($value[1]) && !is_null($value[1]) && !empty($value[1]) ) {
                    $this->db->join($key, $value[0], $value[1]); //$value[1] is equivalent to 'left','right','outer','inner','full'
                }else{
                    $this->db->join($key, $value[0]);
                }
            }
        }
        if ( isset($where_val) && !is_null($where_val) && !empty($where_val) ) {
            $this->db->where($where_col, $where_val);
        }
        if ( is_array($where_col) ) {
            foreach ($where_col as $key => $value) {
                 $this->db->where($key, $value);
            }
        }
        if ( isset( $group_by ) && !is_null( $group_by ) && !empty( $group_by ) ) {
            $this->db->group_by($group_by);
        }
        if ( isset($where_in) && is_array($where_in) && !empty($where_in) ) {
            $this->db->where_in($where_col, $where_in);
        }
        if ( isset($limit) && !is_null($limit) ) {
            if ( isset($offset) && !is_null($offset) ) {
                $this->db->limit($limit, $offset);
            }else{
                $this->db->limit($limit);
            }
        }

        $compile_query = $this->db->get_compiled_select($table);
        $results = $this->db->query($compile_query)->result_array();
        
        // echo $compile_query;
        return $results;
    }

    public function search($table, $key, $field)
    {
        
    }

    public function store($table, $data, $fields = NULL)
    {
        $sql = $this->db->insert($table, $this->security->xss_clean($data));
        return $this->db->affected_rows();
    }

    public function delete($table, $id)
    {
        $sql = $this->db->where('id', $id)
             ->delete($table);
    }
    // $table, $fields, $data
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

    public function store_batch($table, $fields, $data)
    {
        # code...
    }

    public function delete_batch()
    {
        # code...
    }

    public function update_options($data)
    {
        $this->db->update_batch('options', $data, 'option_name');
    }

    public function get_options()
    {
        $result = $this->db->select('option_name, option_value')
            ->get('options')
            ->result_array();

        return $result;
    }

    public function get_single_request($table, $id)
    {
       $qry = $this->db->select('*')
            ->where('id', $id)
            ->join('students', 'students.student_id = '.$table.'.student_id')
            ->get($table)
            ->row_array();

        return $qry;
    }

    public function get_requests_cgmc_ojt()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_ojt')
            // ->or_where('registration_form_status','pending')
            // ->or_where('cgmc_form_status','pending')
            // ->or_where('career_advising_status','pending')
            ->join('students', 'students.student_id = request_cgmc_ojt.student_id')
            ->join('users', 'users.student_id = request_cgmc_ojt.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_generic_notification($table)
    {
        $qry = $this->db->select('*')
            ->from($table)
            ->where('cgmc_file','')
            // ->or_where('cgmc_form_status','pending')
            // ->or_where('career_advising_status','pending')
            ->join('students', 'students.student_id = '.$table.'.student_id')
            ->join('users', 'users.student_id = '.$table.'.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_requests_cgmc_ja()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_job_application')
            // ->or_where('receipt_number_status','pending')
            // ->or_where('tor_status','pending')
            ->join('students', 'students.student_id = request_cgmc_job_application.student_id')
            ->join('users', 'users.student_id = request_cgmc_job_application.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_requests_cgmc_rnur()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_rnu_rep')
            // ->where('registration_form_status','pending')
            ->join('students', 'students.student_id = request_cgmc_rnu_rep.student_id')
            ->join('users', 'users.student_id = request_cgmc_rnu_rep.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_requests_cgmc_ss()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_scholarship')
            // ->or_where('receipt_number_status','pending')
            // ->or_where('application_form_status','pending')
            // ->or_where('registration_form_status','pending')
            // ->or_where('grades_from_prev_status','pending')
            ->join('students', 'students.student_id = request_cgmc_scholarship.student_id')
            ->join('users', 'users.student_id = request_cgmc_scholarship.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_requests_cgmc_ta()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_tosa_app')
            // ->or_where('receipt_number_status','pending')
            // ->or_where('tosa_app_form_of_scholarship_status','pending')
            // ->or_where('registration_status','pending')
            // ->or_where('proof_of_app_of_ha_status','pending')
            ->join('students', 'students.student_id = request_cgmc_tosa_app.student_id')
            ->join('users', 'users.student_id = request_cgmc_tosa_app.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function get_requests_cgmc_tf()
    {
        $qry = $this->db->select('*')
            ->from('request_cgmc_transferee')
            // ->or_where('receipt_number_status','pending')
            // ->or_where('exit_interview_form_status','pending')
            ->join('students', 'students.student_id = request_cgmc_transferee.student_id')
            ->join('users', 'users.student_id = request_cgmc_transferee.student_id')
            ->get()->result_array();

        return $qry;
    }

    public function check_cgmc_ojt_pending()
    {
        $this->db->or_where('registration_form_status','pending');
        $this->db->or_where('cgmc_form_status','pending');
        $this->db->or_where('career_advising_status','pending');
        $this->db->from('request_cgmc_ojt');
        return $this->db->count_all_results();
    }

    public function check_cgmc_ja_pending()
    {
        $this->db->or_where('receipt_number_status','pending');
        $this->db->or_where('tor_status','pending');
        $this->db->from('request_cgmc_job_application');
        return $this->db->count_all_results();
    }

    public function check_cgmc_rnur_pending()
    {

        $this->db->where('registration_form_status','pending');
        $this->db->from('request_cgmc_rnu_rep');
        return $this->db->count_all_results();
    }

    public function check_cgmc_ss_pending()
    {

        $this->db->or_where('receipt_number_status','pending');
        $this->db->or_where('application_form_status','pending');
        $this->db->or_where('registration_form_status','pending');
        $this->db->or_where('grades_from_prev_status','pending');
        $this->db->from('request_cgmc_scholarship');
        return $this->db->count_all_results();
    }

    public function check_cgmc_ta_pending()
    {

        $this->db->or_where('receipt_number_status','pending');
        $this->db->or_where('tosa_app_form_of_scholarship_status','pending');
        $this->db->or_where('registration_status','pending');
        $this->db->or_where('proof_of_app_of_ha_status','pending');
        $this->db->from('request_cgmc_tosa_app');
        return $this->db->count_all_results();
    }

    public function check_cgmc_tf_pending()
    {

        $this->db->or_where('receipt_number_status','pending');
        $this->db->or_where('exit_interview_form_status ','pending');
        $this->db->from('request_cgmc_transferee');
        return $this->db->count_all_results();
    }

    public function get_gc_appointments()
    {
        $start = date('Y-m-d');
        $end = date('Y-m-d', strtotime('+1 year'));
        $result = $this->db->select('*')
            ->where('appointment_date >=', $start . ' 00:00:00')
            ->where('appointment_date <=', $end . ' 23:59:59')
            ->where('type', 'group_counseling')
            ->group_by('DAY(appointment_date)')
            ->get('appointment')
            ->result_array();
        return $result;
    }

    public function count_gc_appointment($date)
    {
        $this->db->where('appointment_date >=', $date . ' 00:00:00');
        $this->db->where('appointment_date <=', $date . ' 23:59:59');
        $this->db->where('type', 'group_counseling');
        $this->db->from('appointment');
        return $this->db->count_all_results();
    }

    public function get_appointment_list_by_day($date)
    {
        $result = $this->db->select('*')
            ->where('appointment_date >=', $date . ' 00:00:00')
            ->where('appointment_date <=', $date . ' 23:59:59')
            ->get('appointment')
            ->result_array();
        return $result;
    }

    public function get_appointment_list($date, $type)
    {
        $result = $this->db->select('*')
            ->where('appointment_date >=', $date . ' 00:00:00')
            ->where('appointment_date <=', $date . ' 23:59:59')
            ->where('type', $type)
            ->join('students', 'students.student_id = appointment.student_id')
            ->order_by('appointment_date', 'asc')
            ->get('appointment')
            ->result_array();
        return $result;
    }

    public function get_appointment_list_by_range($type)
    {
        $result = $this->db->select('*')
            // ->where('appointment_date >=', $date . ' 00:00:00')
            // ->where('appointment_date <=', $date . ' 23:59:59')
            ->where('type', $type)
            ->join('students', 'students.student_id = appointment.student_id')
            ->order_by('appointment_date', 'asc')
            ->get('appointment')
            ->result_array();
        return $result;
    }

    public function validate_password($userID, $password)
    {
        $password = MD5('BatangasStateUniversity::' . $password . '::BSU');
        $result = $this->db
            ->where('user_id', $userID)
            ->where('password', $password)
            ->get('users')
            ->num_rows();

        if ($result > 0) {
            return true;
        }
        return false;
    }

    public function change_password($userID, $password)
    {
        $password = MD5('BatangasStateUniversity::' . $password . '::BSU');
        $this->db->where('user_id', $userID);
        $data = [
            "password"=>$password
        ];
        $this->db->update('users', $data);
    }

    public function get_appointment_list_by_type_status($type,$status)
    {
        $result = $this->db->select('*')
            ->where('type', $type)
            ->where('status', $status)
            ->join('students', 'students.student_id = appointment.student_id')
            ->order_by('appointment_date', 'asc')
            ->get('appointment')
            ->result_array();
        return $result;
    }

    public function get_appointment_pending($date, $type)
    {
        $this->db->where('type', $type);
        $this->db->where('appointment_date >=', $date . ' 00:00:00');
        $this->db->where('appointment_date <=', $date . ' 23:59:59');
        $this->db->where('status', 'pending');
        $this->db->from('appointment');
        return $this->db->count_all_results();
    }

    public function get_appointment_request_by_date($date, $type)
    {
        $this->db->where('type', $type);
        $this->db->where('appointment_date >=', $date . ' 00:00:00');
        $this->db->where('appointment_date <=', $date . ' 23:59:59');
        $this->db->from('appointment');
        return $this->db->count_all_results();
    }

    public function update_batch_appointment($data)
    {
        $this->db->update_batch('appointment', $data, 'id');
    }

    public function store_form_file($data)
    {
        $this->db->insert('forms', $data);
        return $this->db->insert_id();
    }

    public function get_form_file()
    {
        $qry = $this->db->select('*')
            ->from('forms')
            ->get()->result_array();
        return $qry;
    }

}
