<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'model');
        $this->data['user_session'] = $this->session->userdata('member_login');
        $this->is_login();
    }

    private function is_login()
    {
        if($this->data['user_session'] == false){
            redirect(base_url());
            exit(); //No further Execution
        }else{
            if($this->data['user_session']['user_level'] == 'administrator'){
                return true;
            }else{
                redirect(base_url());
                exit();
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Admin Panel';
        parent::view('pages/admin', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url().'login');
    }

    public function request_cgmc()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['cgmc_ojt_pending'] = $this->model->check_cgmc_ojt_pending() > 0 ? true : false;
        $data['cgmc_ja_pending'] = $this->model->check_cgmc_ja_pending() > 0 ? true : false;
        $data['cgmc_ss_pending'] = $this->model->check_cgmc_ss_pending() > 0 ? true : false;
        $data['cgmc_tf_pending'] = $this->model->check_cgmc_tf_pending() > 0 ? true : false;
        $data['cgmc_ta_pending'] = $this->model->check_cgmc_ta_pending() > 0 ? true : false;
        $data['cgmc_rnur_pending'] = $this->model->check_cgmc_rnur_pending() > 0 ? true : false;
        parent::view('admin/cgmc', $data);
    }

    public function cgmc_ojt()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'On-the-Job Training';
        $result = $this->model->get_requests_cgmc_ojt();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_ojt', $data);
    }

    public function update_cgmc_ojt($id=null)
    {

        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_ojt', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('registration_form_status', 'Registration Form Status', 'trim|required');
        $this->form_validation->set_rules('cgmc_form_status', 'Certificate of Good Moral Character Status', 'trim|required');
        $this->form_validation->set_rules('career_advising_status', 'Interview/Career Avising Status', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'registration_form_status' => $this->input->post('registration_form_status'),
                'cgmc_form_status' => $this->input->post('cgmc_form_status'),
                'career_advising_status' => $this->input->post('career_advising_status')
            ];

            $this->model->update('request_cgmc_ojt', $update_data, 'id', $id);

        }

        $this->load->view('admin/form_cgmc_ojt', $data);
    }

    public function cgmc_ja()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'Employment, licensure examination and further studies';
        $result = $this->model->get_requests_cgmc_ja();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_ja', $data);
    }

    public function update_cgmc_ja($id=null)
    {

        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_job_application', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('receipt_number_status', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('tor_status', 'TOR', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'receipt_number_status' => $this->input->post('receipt_number_status'),
                'tor_status' => $this->input->post('tor_status'),
                'cgmc_form_status' => $this->input->post('ja_cgmc_form_status')
            ];

            $this->model->update('request_cgmc_job_application', $update_data, 'id', $id);

        }

        $this->load->view('admin/form_cgmc_ja', $data);
    }

    public function cgmc_ss()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'Scholarship';
        $result = $this->model->get_requests_cgmc_ss();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_ss', $data);
    }

    public function update_cgmc_ss($id=null)
    {

        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_scholarship', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('receipt_number_status', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('application_form_status', 'Application Form', 'trim|required');
        $this->form_validation->set_rules('registration_form_status', 'Registration Form', 'trim|required');
        $this->form_validation->set_rules('grades_from_prev_status', 'Grades from Previous Semester Form', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'receipt_number_status' => $this->input->post('receipt_number_status'),
                'application_form_status' => $this->input->post('application_form_status'),
                'registration_form_status' => $this->input->post('registration_form_status'),
                'grades_from_prev_status' => $this->input->post('grades_from_prev_status'),
                'cgmc_form_status' => $this->input->post('ss_cgmc_form_status')
            ];

            $this->model->update('request_cgmc_scholarship', $update_data, 'id', $id);

        }

        $this->load->view('admin/form_cgmc_ss', $data);
    }


    public function cgmc_tf()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'Transferring Students';
        $result = $this->model->get_requests_cgmc_tf();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_tf', $data);
    }

    public function update_cgmc_tf($id=null)
    {
        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_transferee', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('receipt_number_status', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('exit_interview_form_status', 'Exit Interview Form', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'receipt_number_status' => $this->input->post('receipt_number_status'),
                'exit_interview_form_status' => $this->input->post('exit_interview_form_status'),
                'cgmc_form_status' => $this->input->post('transferee_cgmc_form_status')
            ];
            $this->model->update('request_cgmc_transferee', $update_data, 'id', $id);
        }
        $this->load->view('admin/form_cgmc_tf', $data);
    }

    public function cgmc_ta()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'Ten Outstanding Students Awards (TOSA) Application';
        $result = $this->model->get_requests_cgmc_ta();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_ta', $data);
    }

    public function update_cgmc_ta($id=null)
    {
        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_tosa_app', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('receipt_number_status', 'Receipt Number', 'trim|required');
        $this->form_validation->set_rules('tosa_app_form_of_scholarship_status', 'TOSA Application Form of Scholarship', 'trim|required');
        $this->form_validation->set_rules('registration_status', 'Registration Form', 'trim|required');
        $this->form_validation->set_rules('proof_of_app_of_ha_status', 'Proof of application of honors/awards', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'receipt_number_status' => $this->input->post('receipt_number_status'),
                'tosa_app_form_of_scholarship_status' => $this->input->post('tosa_app_form_of_scholarship_status'),
                'registration_status' => $this->input->post('registration_status'),
                'proof_of_app_of_ha_status' => $this->input->post('proof_of_app_of_ha_status'),
                'cgmc_form_status' => $this->input->post('tosa_app_cgmc_form_status')
            ];
            $this->model->update('request_cgmc_tosa_app', $update_data, 'id', $id);
        }
        $this->load->view('admin/form_cgmc_ta', $data);
    }

    public function cgmc_rnur()
    {
        $data['title'] = 'Request for Certificate of Good Moral Character';
        $data['sub_heading'] = 'Students who will represent the University in regional/ national/ international competitions';
        $result = $this->model->get_requests_cgmc_rnur();
        $data['data_table'] = $result;
        parent::view('admin/cgmc_rnur', $data);
    }

    public function update_cgmc_rnur($id=null)
    {
        $data['title'] = '';
        // View Data
        $result = $this->model->get_single_request('request_cgmc_rnu_rep', $id);
        $data['data_table'] = $result;

        $this->form_validation->set_rules('registration_form_status', 'Registration Form', 'trim|required');

        if ($this->form_validation->run()) {
            // Update Data
            $update_data = [
                'registration_form_status' => $this->input->post('registration_form_status'),
                'cgmc_form_status' => $this->input->post('rnu_rep_cgmc_form_status')
            ];
            $this->model->update('request_cgmc_rnu_rep', $update_data, 'id', $id);
        }
        $this->load->view('admin/form_cgmc_rnur', $data);
    }



    public function update_cgmc_file($id=null)
    {

        $data['title'] = '';
        // View Data
        $output = '{"error" : true}';
        // Update Data
        $update_data = [];
        $this->form_validation->set_rules('cgmc_type', 'CGMC TYPE', 'trim|required');
        $this->form_validation->set_rules('request_id', 'Request ID', 'trim|required');
        $this->form_validation->set_rules('student_id', 'Student ID', 'trim|required');
        $cgmc_file = $this->validate_file('cgmc_file');

        if($this->form_validation->run() && $cgmc_file){
            $user_folder = encodeFolder($this->input->post('student_id'));
            $directory = 'assets/uploads/docs/'.$user_folder.'/';
            $upload_cgmc_file = $this->media_upload($directory, 'cgmc_file');
            $update_data = ['cgmc_file' => $upload_cgmc_file['file_name']];

            $this->model->update($this->input->post('cgmc_type'), $update_data, 'id', $this->input->post('request_id'));
            $output = '{"status": true}';
        }else{
            $fields = [
                'cgmc_type' => ['message' => strip_tags(form_error('cgmc_type'))],
                'request_id' => ['message' => strip_tags(form_error('request_id'))],
                'student_id' => ['message' => strip_tags(form_error('student_id'))],
                'cgmc_file' => ['message' => $this->validate_file_msg('cgmc_file')]
            ];

            $error = [
                'error' => true,
                'fields' => $fields 
            ];

            $output = json_encode($error);
        }

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output);  
    }


    public function group_counseling($month=null, $day=null)
    {
        $data['title'] = 'Group Counseling Appointments';
        $data['get_month'] = isset($month) ? $month : '';
        $data['get_day'] = isset($day) ? $day : '';
        if(!in_array($month, allow_month()) && !empty($month)){
            show_404();
        }
        else if(!in_array($day, allow_days_of_week()) && !empty($day)){
            show_404();
        }
        $year = date('Y'); //Current Date
        $list_date = get_date_of_month($year, $data['get_month'], $day);
        $arr = array();
        foreach ($list_date as $date) {
            $count = $this->model->get_appointment_request_by_date($date, 'group_counseling');
            $pending = $this->model->get_appointment_pending($date, 'group_counseling');
            if($count > 0){
                $arr[] = ['date' => $date, 'status' => ($pending > 0) ? 'pending' : 'approved' ];
                // $arr[]['status'] = '';
            }
        }
        $data['get_appointments'] = $arr;
        parent::view('admin/group_counceling', $data);
    }

    function get_group_counceling(){
        $appointment_type= "group_counseling";
        if ($this->input->get('type') != "") {
            $appointment_type = $this->input->get('type');
        }
        $result = $this->model->get_appointment_list_by_range($appointment_type);
        
        $arr = [];
        foreach ($result as $a) {
            $x = array();
            $x['title'] = $a["first_name"]. " ". $a["last_name"];
            $x['start'] = $a["appointment_date"];
            $x['id'] = $a["id"];
            $x['members'] = $a['members'];
            $x['status'] = $a['status'];
            $x['appointment_date'] = $a['appointment_date'];
            $x['remarks'] = $a['remarks'];
            $x['exit_form']=$a['exit_form'];
            $x['exit_form_url']=base_url('assets/uploads/docs/').encodeFolder($a['student_id']).'/'.$a['exit_form'];
            $x['exit_questionnaire']=$a['exit_questionnaire'];
            $x['exit_questionnaire_url']=base_url('assets/uploads/docs/').encodeFolder($a['student_id']).'/'.$a['exit_questionnaire'];
            $x['registration_form']=$a['registration_form'];
            $x['registration_form_url']=base_url('assets/uploads/docs/').encodeFolder($a['student_id']).'/'.$a['registration_form'];
            $x['certificate_of_completion']=$a['certificate_of_completion'];
            $x['certificate_of_completion_url']=base_url('assets/uploads/docs/').encodeFolder($a['student_id']).'/'.$a['certificate_of_completion'];

            if ($a['status'] == "approved"){
                $x['color'] = "#378006";
            }
            if ($a['status'] == "reject"){
                $x['color'] = "red";
            }
            $arr[] = $x;
        }

        $output = json_encode($arr);
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
    }

    function update_group_counceling_v2(){
        $id = $this->input->post('request_id');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');

        if(isset($id) && !empty($id)){
            $request_update[] = ['id' => $id, 'status' => $status, 'remarks' => $remarks];
            $this->model->update_batch_appointment($request_update);
        }

        $response = '{"status" : true}';
        
        $output = json_encode($response);
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
    }

    public function update_appointment_gc($date, $action = 'pending')
    {
        $data['title'] = '';
        $data['date'] = $date;
        $appointment = $this->model->get_appointment_list($date, 'group_counseling');
        $arr = [];
        $request_update = [];
        switch ($action) {
            case 'approved':
                $status = 'approved';
                break;
            case 'reject':
                $status = 'reject';
                break;
            default:
                $status = 'pending';
                break;
        }
        foreach ($appointment as $a) {
            $arr[$a['appointment_date']][] = $a;
        }
        $data['appointment'] = $arr;
        $request_id = $this->input->post('request_id');
        if(isset($request_id) && !empty($request_id)){
            foreach ($request_id as $id) {
                $request_update[] = ['id' => $id, 'status' => $status];
            }
            $this->model->update_batch_appointment($request_update);
        }
        $this->load->view('admin/form_appointment_gc', $data);
    }

    public function appointments($type=null, $month=null, $day=null)
    {
        switch ($type) {
            case 'initial_interview':
                $data['title'] = 'Initial On-the-Job Training Interview Appointments';
                $data['appointment_type'] = 'initial_interview';
                break;

            case 'post_interview':
                $data['title'] = 'Post On-the-Job Training Interview Appointments';
                $data['appointment_type'] = 'post_interview';
                break;

            case 'exit_interview':
                $data['title'] = 'Exit Interview Appointments';
                $data['appointment_type'] = 'exit_interview';
                break;
            
            default:
                $data['title'] = 'Test';
                break;
        }
        $data['type'] = $type;
        $data['get_month'] = isset($month) ? $month : '';
        $data['get_day'] = isset($day) ? $day : '';
        if(!in_array($month, allow_month()) && !empty($month)){
            show_404();
        }
        else if(!in_array($day, allow_days_of_week()) && !empty($day)){
            show_404();
        }
        $year = date('Y'); //Current Date
        $list_date = get_date_of_month($year, $data['get_month'], $day);
        $arr = array();
        foreach ($list_date as $date) {
            $count = $this->model->get_appointment_request_by_date($date, $type);
            $pending = $this->model->get_appointment_pending($date, $type);
            if($count > 0){
                $arr[] = ['date' => $date, 'status' => ($pending > 0) ? 'pending' : 'approved' ];
                // $arr[]['status'] = '';
            }
        }
        $data['get_appointments'] = $arr;
        parent::view('admin/appointments', $data);
    }

    public function update_appointment($type, $date)
    {
        switch ($type) {
            case 'initial_interview':
                $data['title'] = 'Initial On-the-Job Training Interview Appointments';
                break;

            case 'post_interview':
                $data['title'] = 'Post On-the-Job Training Interview Appointments';
                break;

            case 'exit_interview':
                $data['title'] = 'Exit Interview Appointments';
                break;
            
            default:
                $data['title'] = 'Test';
                break;
        }
        $data['date'] = $date;
        $appointment = $this->model->get_appointment_list($date, $type);
        $arr = [];
        foreach ($appointment as $a) {
            $arr[$a['appointment_date']][] = $a;
            // $arr[] = $a;
        }
        $data['appointment'] = $arr;
        $request_id = $this->input->post('request_id');
        if(isset($request_id) && !empty($request_id)){
            $update_data = [
                'status' => 'approved'
            ];
            // $this->model->update('appointment', $update_data, 'id', $request_id);
        }
        $this->load->view('admin/form_appointment', $data);
    }

    public function update_appointment_request($action = 'pending')
    {
        switch ($action) {
            case 'approved':
                $status = 'approved';
                break;
            case 'reject':
                $status = 'reject';
                break;
            default:
                $status = 'pending';
                break;
        }
        
        $request_id = $this->input->post('request_id');
        if(isset($request_id) && !empty($request_id)){
            $update_data = [
                'status' => $status
            ];
            $this->model->update('appointment', $update_data, 'id', $request_id);
        }
        echo 'true';
    }

    public function settings()
    {
        $data['title'] = '';

        $disable_hour = $this->input->post('disable_hour');
        $disable_day = $this->input->post('disable_day');
        $disable_month = $this->input->post('disable_month');
        
        $options_data = [
            array(
                'option_name' => 'disable_hour',
                'option_value' => maybe_serialize($disable_hour)
            ),
            array(
                'option_name' => 'disable_day',
                'option_value' => maybe_serialize($disable_day)
            ),
            array(
                'option_name' => 'disable_month',
                'option_value' => maybe_serialize($disable_month)
            )
        ];

        $this->model->update_options($options_data);
        // echo $this->validate_file('banner_new');
        // print_r($_FILES['banner_new']);
        $banner_new = $_FILES;
        if(isset($banner_new) && !empty($banner_new)){
            $new_upload = array();
            $directory = 'assets/uploads/banners/';
            // FOR INSERT DATABASE
            foreach ($banner_new as $key => $val) {
                if(isset($val['name']) && !empty($val['name'])){
                    $upload_file = $this->media_upload($directory, $key);
                    $new_upload[] = ['banner_img' => $upload_file['file_name']];
                }
            }
            // print_r($new_upload);
            $this->db->insert_batch('announcement', $new_upload);
        }
    }

    public function delete_banner(){
        $this->form_validation->set_rules('id', 'Banner', 'required');
        if ($this->form_validation->run()) {
            $this->model->delete('announcement', $this->input->post('id'));
        }
    }

    public function store_form_file()
    {
        $this->form_validation->set_rules('form_file_title', 'Form Title', 'required');
        // form_file
        $form_file = $this->validate_file('form_file');
        $output = '{"status" : true}';
        $fields = [];
        $error = [
            'error' => true,
            'fields' => $fields 
        ];

        if ($this->form_validation->run() && $form_file) {
            $directory = 'assets/forms/';
            $upload_form_file = $this->media_upload($directory, 'form_file');
            $data_form = [
                'form_title' => $this->input->post('form_file_title'),
                'form_file' =>  $upload_form_file['file_name']
            ];

            $this->model->store_form_file($data_form);
        } else {

            $fields = [
                'form_file_title' => ['message' => strip_tags(form_error('form_file_title'))],
                'form_file' => ['message' => $this->validate_file_msg('form_file')]
            ];

            $error = [
                'error' => true,
                'fields' => $fields 
            ];

            $output = json_encode($error);

        }
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output);  
    }

    public function delete_form_file(){
        $this->form_validation->set_rules('id', 'Form', 'required');
        if ($this->form_validation->run()) {
            $this->model->delete('forms', $this->input->post('id'));
        }
    }

    public function get_notifications(){
        $data['title'] = 'Request of Certificate of Good moral character';
        $data['cgmc_ojt_pending'] = $this->model->get_generic_notification('request_cgmc_ojt');
        $data['cgmc_ja_pending'] = $this->model->get_generic_notification('request_cgmc_job_application');
        $data['cgmc_ss_pending'] = $this->model->get_generic_notification('request_cgmc_scholarship');
        $data['cgmc_tf_pending'] = $this->model->get_generic_notification('request_cgmc_transferee');
        $data['cgmc_ta_pending'] = $this->model->get_generic_notification('request_cgmc_tosa_app');
        $data['cgmc_rnur_pending'] = $this->model->get_generic_notification('request_cgmc_rnu_rep');
        $data['counseling'] = $this->model->get_appointment_list_by_type_status('group_counseling',"pending");
        $data['exit_interview'] = $this->model->get_appointment_list_by_type_status('exit_interview',"pending");
        $data['initial_interview'] = $this->model->get_appointment_list_by_type_status('initial_interview',"pending");
        $data['post_interview'] = $this->model->get_appointment_list_by_type_status('post_interview',"pending");

        $output = json_encode($data);

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
    }

}
