<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_model', 'model');
		$this->data['user_session'] = $this->session->userdata('member_login');
		$this->is_login();
	}

	private function is_login()
	{
		if($this->data['user_session'] == true){
			redirect(base_url());
			exit(); //No further Execution
		}
	}

	public function index()
	{
		$data['title'] = 'Create Account';
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['email_hidden'] = '';
        $data['google_id'] = '';
        $data['google_image'] = '';
		parent::view('pages/register', $data);
	}

	public function validate()
	{
		$this->form_validation->set_message('is_unique', 'This %s is already exist.');

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        // $this->form_validation->set_rules('middle_name', 'Middle Name', 'trim|required');
        $this->form_validation->set_rules('email_hidden', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash|min_length[4]|is_unique[users.username]');
        // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('department', 'Department', 'trim|required');
        $this->form_validation->set_rules('program', 'Program', 'trim|required');
        if ($this->form_validation->run()) {
            $first_name 	= $this->input->post('first_name');
            $last_name 		= $this->input->post('last_name');
            // $middle_name 	= $this->input->post('middle_name');
            $email 			= $this->input->post('email_hidden');
            $username 		= $this->input->post('username');
            // $password 		= $this->input->post('password');
            $department 	= $this->input->post('department');
            $program 		= $this->input->post('program');
            $output 		= '{"status": true}';
            $google_id      = $this->input->post('google_id');
            $google_image      = $this->input->post('google_image');


            // $password_encrypt = MD5('BatangasStateUniversity::' . $password . '::BSU');
            $student = array(
            	'first_name' 	=> $first_name,
            	'last_name' 	=> $last_name,
            	'middle_name' 	=> "",
            	'department' 	=> $this->department_name($department),
            	'course' 		=> $program
            );

            $student_id = $this->model->store_student($student);

            $user = array(
            	'username' 		=> $username,
            	'password' 		=> "",
            	'email'			=> $email,
            	'student_id'	=> $student_id,
            	'user_level' 	=> 'student',
                'google_id'     => $google_id,
                'image'         => $google_image
            );

            $this->session->set_userdata('member_login', $user);
            
            $this->model->store_user($user);
            
        }else{
            $phone_error = form_error('phone_num') ? form_error('phone_num') : form_error('phone_full');
            $fields = [
                'first_name'    => ['message' => strip_tags(form_error('first_name'))],
                'last_name'     => ['message' => strip_tags(form_error('last_name'))],
                'middle_name'   => ['message' => strip_tags(form_error('middle_name'))],
                'email'         => ['message' => strip_tags(form_error('email_hidden'))],
                'username'      => ['message' => strip_tags(form_error('username'))],
                'password'      => ['message' => strip_tags(form_error('password'))],
                'department'    => ['message' => strip_tags(form_error('department'))],
                'program'       => ['message' => strip_tags(form_error('program'))],
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

	private function department_name($id)
	{
		$arr = department();
		$select = $arr[$id];
		if(isset($select)){
			return $select['department'];
		}
	}

}
