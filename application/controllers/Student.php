<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Student extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model', 'model');
		$this->data['user_session'] = $this->session->userdata('member_login');
		$this->is_login();
	}

	private function is_login()
	{
		if($this->data['user_session'] == false){
			redirect(base_url());
			exit(); //No further Execution
		}else{
			if($this->data['user_session']['user_level'] == 'student'){
				return true;
			}else{
				redirect(base_url());
				exit();
			}
		}
	}
	public function index()
	{
		$user = $this->data['user_session'];
		$data['student_id'] = $user['student_id'];
		$data['student'] = $this->model->get_student($data['student_id']);
		$user_folder = encodeFolder($data['student_id']);
		$data['folder'] = 'assets/uploads/docs/'.$user_folder.'/';

		$data['request_cgmc_ojt'] = $this->model->get_request_cgmc_ojt($data['student_id']);
		$data['ojt_registration_form_status'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->registration_form_status : '';
		$data['ojt_cgmc_form_status'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->cgmc_form_status : '';
		$data['ojt_career_advising_status'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->career_advising_status : '';
		$data['ojt_registration_form_file'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->registration_form_file : '';
		$data['ojt_cgmc_form_file'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->cgmc_form_file : '';
		$data['ojt_career_advising_file'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->career_advising_file : '';
		$data['ojt_cgmc_file'] = isset($data['request_cgmc_ojt']) ? $data['request_cgmc_ojt']->cgmc_file : '';

		$data['request_cgmc_job_application'] = $this->model->get_request_cgmc_job_application($data['student_id']);
		$data['ja_receipt_number_status'] = isset($data['request_cgmc_job_application']) ? $data['request_cgmc_job_application']->receipt_number_status : '';
		$data['ja_tor_status'] = isset($data['request_cgmc_job_application']) ? $data['request_cgmc_job_application']->tor_status : '';
		$data['ja_receipt_number'] = isset($data['request_cgmc_job_application']) ? $data['request_cgmc_job_application']->receipt_number : '';
		$data['ja_tor_file'] = isset($data['request_cgmc_job_application']) ? $data['request_cgmc_job_application']->tor_file : '';
		$data['ja_cgmc_file'] = isset($data['request_cgmc_job_application']) ? $data['request_cgmc_job_application']->cgmc_file : '';


		$data['request_cgmc_scholarship'] = $this->model->get_request_cgmc_scholarship($data['student_id']);
		$data['ss_receipt_number'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->receipt_number : '';
		$data['ss_receipt_number_status'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->receipt_number_status : '';
		$data['ss_application_form_file'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->application_form_file : '';
		$data['ss_application_form_status'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->application_form_status : '';
		$data['ss_registration_form_file'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->registration_form_file : '';
		$data['ss_registration_form_status'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->registration_form_status : '';
		$data['ss_grade_from_prev_file'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->grades_from_prev_file : '';
		$data['ss_grade_from_prev_status'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->grades_from_prev_status : '';
		$data['scholarship_cgmc_file'] = isset($data['request_cgmc_scholarship']) ? $data['request_cgmc_scholarship']->cgmc_file : '';

		$data['request_cgmc_transferee'] = $this->model->get_request_cgmc_transferee($data['student_id']);
		$data['transferee_receipt_number'] = isset($data['request_cgmc_transferee']) ? $data['request_cgmc_transferee']->receipt_number : '';
		$data['transferee_receipt_number_status'] = isset($data['request_cgmc_transferee']) ? $data['request_cgmc_transferee']->receipt_number_status : '';
		$data['transferee_exit_interview_form_file'] = isset($data['request_cgmc_transferee']) ? $data['request_cgmc_transferee']->exit_interview_form_file : '';
		$data['transferee_exit_interview_form_status'] = isset($data['request_cgmc_transferee']) ? $data['request_cgmc_transferee']->exit_interview_form_status : '';
		$data['transferee_cgmc_file'] = isset($data['request_cgmc_transferee']) ? $data['request_cgmc_transferee']->cgmc_file : '';

		$data['request_cgmc_tosa_app'] = $this->model->get_request_cgmc_tosa_app($data['student_id']);
		$data['tosa_app_receipt_number'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->receipt_number : '';
		$data['tosa_app_receipt_number_status'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->receipt_number_status : '';
		$data['tosa_app_form_of_scholarship_file'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->tosa_app_form_of_scholarship_file : '';
		$data['tosa_app_form_of_scholarship_status'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->tosa_app_form_of_scholarship_status : '';
		$data['tosa_app_registration_file'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->registration_file : '';
		$data['tosa_app_registration_status'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->registration_status : '';
		$data['tosa_app_proof_of_app_of_ha_file'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->proof_of_app_of_ha_file : '';
		$data['tosa_app_proof_of_app_of_ha_status'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->proof_of_app_of_ha_status : '';
		$data['tosa_app_cgmc_file'] = isset($data['request_cgmc_tosa_app']) ? $data['request_cgmc_tosa_app']->cgmc_file : '';

		$data['request_cgmc_rnu_rep'] = $this->model->get_request_cgmc_rnu_rep($data['student_id']);
		$data['rnu_rep_registration_form_file'] = isset($data['request_cgmc_rnu_rep']) ? $data['request_cgmc_rnu_rep']->registration_form_file : '';
		$data['rnu_rep_registration_form_status'] = isset($data['request_cgmc_rnu_rep']) ? $data['request_cgmc_rnu_rep']->registration_form_status : '';
		$data['rnu_rep_cgmc_file'] = isset($data['request_cgmc_rnu_rep']) ? $data['request_cgmc_rnu_rep']->cgmc_file : '';

		$data['appointment_group_counseling'] = $this->model->get_appointment($data['student_id'], 'group_counseling');
		$data['default_available_slots']	= $this->model->count_gc_appointment(date('Y-m-d'));

		$data['appointment_exit_interview'] = $this->model->get_appointment($data['student_id'], 'exit_interview');
		$data['appointment_initial_interview'] = $this->model->get_appointment($data['student_id'], 'initial_interview');
		$data['appointment_post_interview'] = $this->model->get_appointment($data['student_id'], 'post_interview');


		if(!$user){
			redirect(base_url());
		}
		parent::view('pages/student', $data);
	}

	public function request_cgmc_ojt()
	{

		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_ojt($user['student_id']);

		$data['registration-form-error'] = $this->validate_file('registration-form');
		$data['cogmc-form-error'] = $this->validate_file('cogmc-form');
		$data['interview-form-error'] = $this->validate_file('interview-form');

		if ($data['registration-form-error'] && $data['cogmc-form-error'] && $data['interview-form-error']) {
			if($no_dup){
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_register_form = $this->media_upload($directory, 'registration-form');
		        $upload_cogmc_form = $this->media_upload($directory, 'cogmc-form');
		        $upload_interview_form = $this->media_upload($directory, 'interview-form');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		            'registration_form_file' =>  $upload_register_form['file_name'],
		            'cgmc_form_file'  =>  $upload_cogmc_form['file_name'],
		            'career_advising_file' => $upload_interview_form['file_name'],
		            'registration_form_status' => 'pending',
		            'cgmc_form_status' => 'pending',
		            'career_advising_status' => 'pending'
		        ];
		        $this->model->store_request_cgmc_ojt($new_cgcm);
		        $output = '{"status": true}';
			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'registration-form' => ['message' => $this->validate_file_msg('registration-form')],
                'cogmc-form' => ['message' => $this->validate_file_msg('cogmc-form')],
                'interview-form' => ['message' => $this->validate_file_msg('interview-form')]
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

	public function update_request_cgmc_ojt()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';

		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if (!empty($_FILES['registration-form']['name']) && !is_null($_FILES['registration-form']['name'])) {
            if($this->validate_file_msg('registration-form')){
            	$error['fields']['registration-form'] = ['message' => $this->validate_file_msg('registration-form')];
            }else{
            	$upload_register_form = $this->media_upload($directory, 'registration-form');
            	$update_request['registration_form_file'] = $upload_register_form['file_name'];
            	$update_request['registration_form_status'] = 'pending';
            }
        }
        if (!empty($_FILES['cogmc-form']['name']) && !is_null($_FILES['cogmc-form']['name'])) {
        	if($this->validate_file_msg('cogmc-form')){
        		$error['fields']['cogmc-form'] = ['message' => $this->validate_file_msg('cogmc-form')];
        	}else{
        		$upload_cogmc_form = $this->media_upload($directory, 'cogmc-form');
            	$update_request['cgmc_form_file'] = $upload_cogmc_form['file_name'];
            	$update_request['cgmc_form_status'] = 'pending';
        	}
        }
        if (!empty($_FILES['interview-form']['name']) && !is_null($_FILES['interview-form']['name'])) {
            if($this->validate_file_msg('interview-form')){
            	$error['fields']['interview-form'] = ['message' => $this->validate_file_msg('interview-form')];
            }else{
            	$upload_interview_form = $this->media_upload($directory, 'interview-form');
            	$update_request['career_advising_file'] = $upload_interview_form['file_name'];
            	$update_request['career_advising_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_ojt', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}

	public function request_cgmc_job_application()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_job_application($user['student_id']);

		$this->form_validation->set_rules('receipt-number', 'Official Receipt Number', 'trim|required');
		$data['tor'] = $this->validate_file('tor');

		if ($this->form_validation->run() && $data['tor']) {
			if($no_dup){
				$receipt_number = antiHack($this->input->post('receipt-number'));
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_tor = $this->media_upload($directory, 'tor');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		        	'receipt_number' => $receipt_number,
		            'tor_file' =>  $upload_tor['file_name'],
		            'receipt_number_status' => 'pending',
		            'tor_status' => 'pending'
		        ];

		        $this->model->store_request_cgmc_job_application($new_cgcm);
		        $output = '{"status": true}';

			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'receipt-number' => ['message' => strip_tags(form_error('receipt-number'))],
                'tor' => ['message' => $this->validate_file_msg('tor')]
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

	public function update_request_cgmc_job_application()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';
		$receipt_number = $this->input->post('receipt-number');
		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if($receipt_number){
			$update_request['receipt_number'] = $receipt_number;
			$update_request['receipt_number_status'] = 'pending';
			
		}else{
			$error['fields']['receipt-number'] = ['message' => 'This field is required.'];
		}

		if (!empty($_FILES['tor']['name']) && !is_null($_FILES['tor']['name'])) {
            if($this->validate_file_msg('tor')){
            	$error['fields']['tor'] = ['message' => $this->validate_file_msg('tor')];
            }else{
            	$upload_tor = $this->media_upload($directory, 'tor');
            	$update_request['tor_file'] = $upload_tor['file_name'];
            	$update_request['tor_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_job_application', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}

	public function request_cgmc_scholarship()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_scholarship($user['student_id']);

		$this->form_validation->set_rules('ss_receipt_number', 'Official Receipt Number', 'trim|required');
		$data['ss_application_form_file'] = $this->validate_file('ss_application_form_file');
		$data['ss_registration_form_file'] = $this->validate_file('ss_registration_form_file');
		$data['ss_grade_from_prev_file'] = $this->validate_file('ss_grade_from_prev_file');

		if ($this->form_validation->run() && $data['ss_application_form_file'] && $data['ss_application_form_file'] && $data['ss_application_form_file']) {
			if($no_dup){
				$receipt_number = antiHack($this->input->post('ss_receipt_number'));
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_application_form = $this->media_upload($directory, 'ss_application_form_file');
		        $upload_registration_form = $this->media_upload($directory, 'ss_registration_form_file');
		        $upload_grade_from_prev = $this->media_upload($directory, 'ss_grade_from_prev_file');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		        	'receipt_number' => $receipt_number,
		            'receipt_number_status' => 'pending',
		            'application_form_file' =>  $upload_application_form['file_name'],
		            'application_form_status' => 'pending',
		            'registration_form_file' =>  $upload_registration_form['file_name'],
		            'registration_form_status' => 'pending',
		            'grades_from_prev_file' =>  $upload_grade_from_prev['file_name'],
		            'grades_from_prev_status' => 'pending'
		        ];

		        $this->model->store_request_cgmc_scholarship($new_cgcm);
		        $output = '{"status": true}';

			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'ss_receipt_number' => ['message' => strip_tags(form_error('ss_receipt_number'))],
                'ss_application_form_file' => ['message' => $this->validate_file_msg('ss_application_form_file')],
                'ss_registration_form_file' => ['message' => $this->validate_file_msg('ss_registration_form_file')],
                'ss_grade_from_prev_file' => ['message' => $this->validate_file_msg('ss_grade_from_prev_file')]
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

	public function update_request_cgmc_scholarship()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';
		$receipt_number = $this->input->post('ss_receipt_number');
		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if(isset($receipt_number) && !empty($receipt_number)){
			if($receipt_number){
				$update_request['receipt_number'] = $receipt_number;
				$update_request['receipt_number_status'] = 'pending';
			}else{
				$error['fields']['ss_receipt_number'] = ['message' => $receipt_number];
			}
			
		}

		if (!empty($_FILES['ss_application_form_file']['name']) && !is_null($_FILES['ss_application_form_file']['name'])) {
            if($this->validate_file_msg('ss_application_form_file')){
            	$error['fields']['ss_application_form_file'] = ['message' => $this->validate_file_msg('ss_application_form_file')];
            }else{
            	$upload_app_form = $this->media_upload($directory, 'ss_application_form_file');
            	$update_request['application_form_file'] = $upload_app_form['file_name'];
            	$update_request['application_form_status'] = 'pending';
            }
        }

        if (!empty($_FILES['ss_registration_form_file']['name']) && !is_null($_FILES['ss_registration_form_file']['name'])) {
            if($this->validate_file_msg('ss_registration_form_file')){
            	$error['fields']['ss_registration_form_file'] = ['message' => $this->validate_file_msg('ss_registration_form_file')];
            }else{
            	$upload_reg_form = $this->media_upload($directory, 'ss_registration_form_file');
            	$update_request['registration_form_file'] = $upload_reg_form['file_name'];
            	$update_request['registration_form_status'] = 'pending';
            }
        }

        if (!empty($_FILES['ss_grade_from_prev_file']['name']) && !is_null($_FILES['ss_grade_from_prev_file']['name'])) {
            if($this->validate_file_msg('ss_grade_from_prev_file')){
            	$error['fields']['ss_grade_from_prev_file'] = ['message' => $this->validate_file_msg('ss_grade_from_prev_file')];
            }else{
            	$upload_grades = $this->media_upload($directory, 'ss_grade_from_prev_file');
            	$update_request['grades_from_prev_file'] = $upload_grades['file_name'];
            	$update_request['grades_from_prev_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_scholarship', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}

	public function request_cgmc_transferee()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_transferee($user['student_id']);

		$this->form_validation->set_rules('transferee_receipt_number', 'Official Receipt Number', 'trim|required');
		$data['transferee_exit_interview_form_file'] = $this->validate_file('transferee_exit_interview_form_file');

		if ($this->form_validation->run() && $data['transferee_exit_interview_form_file']) {
			if($no_dup){
				$receipt_number = antiHack($this->input->post('transferee_receipt_number'));
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_form = $this->media_upload($directory, 'transferee_exit_interview_form_file');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		        	'receipt_number' => $receipt_number,
		            'receipt_number_status' => 'pending',
		            'exit_interview_form_file' =>  $upload_form['file_name'],
		            'exit_interview_form_status' => 'pending'
		        ];

		        $this->model->store_request_cgmc_transferee($new_cgcm);
		        $output = '{"status": true}';

			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'transferee_receipt_number' => ['message' => strip_tags(form_error('transferee_receipt_number'))],
                'transferee_exit_interview_form_file' => ['message' => $this->validate_file_msg('transferee_exit_interview_form_file')]
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

	public function update_request_cgmc_transferee()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';
		$receipt_number = $this->input->post('transferee_receipt_number');
		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if($receipt_number){
			$update_request['receipt_number'] = $receipt_number;
			$update_request['receipt_number_status'] = 'pending';
			
		}else{
			$error['fields']['transferee_receipt_number'] = ['message' => 'This field is required.'];
		}

		if (!empty($_FILES['transferee_exit_interview_form_file']['name']) && !is_null($_FILES['transferee_exit_interview_form_file']['name'])) {
            if($this->validate_file_msg('transferee_exit_interview_form_file')){
            	$error['fields']['transferee_exit_interview_form_file'] = ['message' => $this->validate_file_msg('transferee_exit_interview_form_file')];
            }else{
            	$upload_form = $this->media_upload($directory, 'transferee_exit_interview_form_file');
            	$update_request['exit_interview_form_file'] = $upload_form['file_name'];
            	$update_request['exit_interview_form_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_transferee', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}


	public function request_cgmc_tosa_app()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_tosa_app($user['student_id']);

		$this->form_validation->set_rules('tosa_app_receipt_number', 'Official Receipt Number', 'trim|required');
		$data['tosa_app_form_of_scholarship_file'] = $this->validate_file('tosa_app_form_of_scholarship_file');
		$data['tosa_app_registration_file'] = $this->validate_file('tosa_app_registration_file');
		$data['tosa_app_proof_of_app_of_ha_file'] = $this->validate_file('tosa_app_proof_of_app_of_ha_file');

		if ($this->form_validation->run() && $data['tosa_app_form_of_scholarship_file'] && $data['tosa_app_registration_file'] && $data['tosa_app_proof_of_app_of_ha_file']) {
			if($no_dup){
				$receipt_number = antiHack($this->input->post('tosa_app_receipt_number'));
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_scholarship_form = $this->media_upload($directory, 'tosa_app_form_of_scholarship_file');
		        $upload_registration_form = $this->media_upload($directory, 'tosa_app_registration_file');
		        $upload_app_prof = $this->media_upload($directory, 'tosa_app_proof_of_app_of_ha_file');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		        	'receipt_number' => $receipt_number,
		            'receipt_number_status' => 'pending',
		            'tosa_app_form_of_scholarship_file' =>  $upload_scholarship_form['file_name'],
		            'tosa_app_form_of_scholarship_status' => 'pending',
		            'registration_file' =>  $upload_registration_form['file_name'],
		            'registration_status' => 'pending',
		            'proof_of_app_of_ha_file' =>  $upload_app_prof['file_name'],
		            'proof_of_app_of_ha_status' => 'pending'
		        ];

		        $this->model->store_request_cgmc_tosa_app($new_cgcm);
		        $output = '{"status": true}';

			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'tosa_app_receipt_number' => ['message' => strip_tags(form_error('tosa_app_receipt_number'))],
                'tosa_app_form_of_scholarship_file' => ['message' => $this->validate_file_msg('tosa_app_form_of_scholarship_file')],
                'tosa_app_registration_file' => ['message' => $this->validate_file_msg('tosa_app_registration_file')],
                'tosa_app_proof_of_app_of_ha_file' => ['message' => $this->validate_file_msg('tosa_app_proof_of_app_of_ha_file')]
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

	public function update_request_cgmc_tosa_app()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';
		$receipt_number = $this->input->post('tosa_app_receipt_number');
		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if($receipt_number){
			$update_request['receipt_number'] = $receipt_number;
			$update_request['receipt_number_status'] = 'pending';
			
		}else{
			$error['fields']['tosa_app_receipt_number'] = ['message' => 'This field is required.'];
		}

		if (!empty($_FILES['tosa_app_form_of_scholarship_file']['name']) && !is_null($_FILES['tosa_app_form_of_scholarship_file']['name'])) {
            if($this->validate_file_msg('tosa_app_form_of_scholarship_file')){
            	$error['fields']['tosa_app_form_of_scholarship_file'] = ['message' => $this->validate_file_msg('tosa_app_form_of_scholarship_file')];
            }else{
            	$upload_form_1 = $this->media_upload($directory, 'tosa_app_form_of_scholarship_file');
            	$update_request['tosa_app_form_of_scholarship_file'] = $upload_form_1['file_name'];
            	$update_request['tosa_app_form_of_scholarship_status'] = 'pending';
            }
        }

        if (!empty($_FILES['tosa_app_registration_file']['name']) && !is_null($_FILES['tosa_app_registration_file']['name'])) {
            if($this->validate_file_msg('tosa_app_registration_file')){
            	$error['fields']['tosa_app_registration_file'] = ['message' => $this->validate_file_msg('tosa_app_registration_file')];
            }else{
            	$upload_form_2 = $this->media_upload($directory, 'tosa_app_registration_file');
            	$update_request['registration_file'] = $upload_form_2['file_name'];
            	$update_request['registration_status'] = 'pending';
            }
        }

        if (!empty($_FILES['tosa_app_proof_of_app_of_ha_file']['name']) && !is_null($_FILES['tosa_app_proof_of_app_of_ha_file']['name'])) {
            if($this->validate_file_msg('tosa_app_proof_of_app_of_ha_file')){
            	$error['fields']['tosa_app_proof_of_app_of_ha_file'] = ['message' => $this->validate_file_msg('tosa_app_proof_of_app_of_ha_file')];
            }else{
            	$upload_form_3 = $this->media_upload($directory, 'tosa_app_proof_of_app_of_ha_file');
            	$update_request['proof_of_app_of_ha_file'] = $upload_form_3['file_name'];
            	$update_request['proof_of_app_of_ha_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_tosa_app', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}

	public function request_cgmc_rnu_rep()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';
		$no_dup = $this->model->check_duplicate_cgmc_rnu_rep($user['student_id']);

		$data['rnu_rep_registration_form_file'] = $this->validate_file('rnu_rep_registration_form_file');

		if ($data['rnu_rep_registration_form_file']) {
			if($no_dup){
				$user_folder = encodeFolder($user['student_id']);
				$directory = 'assets/uploads/docs/'.$user_folder.'/';
		        $upload_form = $this->media_upload($directory, 'rnu_rep_registration_form_file');

		        $new_cgcm = [
		        	'student_id' => $user['student_id'],
		            'registration_form_file' =>  $upload_form['file_name'],
		            'registration_form_status' => 'pending'
		        ];

		        $this->model->store_request_cgmc_rnu_rep($new_cgcm);
		        $output = '{"status": true}';

			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending request. Cant add multiple request."}';
			}
		} else {

			$fields = [
                'rnu_rep_registration_form_file' => ['message' => $this->validate_file_msg('rnu_rep_registration_form_file')]
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

	public function update_request_cgmc_rnu_rep()
	{

		$user = $this->data['user_session'];
		$output = '{"status" : true}';
		$request_id = $this->input->post('request_id');
		$user_folder = encodeFolder($user['student_id']);
		$directory = 'assets/uploads/docs/'.$user_folder.'/';
		$update_request = [];
        $fields = [];
		$error = [
			'error' => true,
			'fields' => $fields 
		];

		if (!empty($_FILES['rnu_rep_registration_form_file']['name']) && !is_null($_FILES['rnu_rep_registration_form_file']['name'])) {
            if($this->validate_file_msg('rnu_rep_registration_form_file')){
            	$error['fields']['rnu_rep_registration_form_file'] = ['message' => $this->validate_file_msg('rnu_rep_registration_form_file')];
            }else{
            	$upload_form = $this->media_upload($directory, 'rnu_rep_registration_form_file');
            	$update_request['registration_form_file'] = $upload_form['file_name'];
            	$update_request['registration_form_status'] = 'pending';
            }
        }

		if(isset($error['fields']) && !empty($error['fields'])){
			$output = json_encode($error);
		}else{
			$this->model->update('request_cgmc_rnu_rep', $update_request, 'id', base64_decode($request_id));
		}

		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output); 
	}

	public function set_appointment()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';

		$this->form_validation->set_rules('appointment-type', 'Appointment', 'required|callback_appointment_type');
		$this->form_validation->set_rules('date', 'Date Schedule', 'trim|required|callback_validate_date');
		$this->form_validation->set_rules('time', 'Time Schedule', 'required|callback_available_time');

		if($this->form_validation->run()){
			$time = $this->input->post('time');
			$time_arr = explode(' ', $time);
			$time_format = date('H:i:s', strtotime($time_arr[0].' '.$time_arr[1]));
			$date = $this->input->post('date').' '.$time_format;
			$type = $this->input->post('appointment-type');

			$no_dup = $this->model->check_duplicate_appointment($user['student_id'], $type);

			if($no_dup){
				$form_data = array(
					'student_id' => $user['student_id'],
					'appointment_date' => $date,
					'type' => $type,
					'status' => 'pending'
				);
				$this->model->store_appointment($form_data);	
				$output = '{"status": true}';
			}else{
				$output = '{"error": true, "message": "[ERROR] : You still have pending appointment. Cant add multiple request."}';
			}
			
		}else{
			$fields = [
                'appointment-type' => ['message' => strip_tags(form_error('appointment-type'))],
                'date' => ['message' => strip_tags(form_error('date'))],
                'time' => ['message' => strip_tags(form_error('time'))]
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

	public function form_appointment_validate()
	{
		$user = $this->data['user_session'];
		$output = '{"error" : true}';

		$this->form_validation->set_rules('appointment-type', 'Appointment', 'required|callback_appointment_type');
		$this->form_validation->set_rules('date', 'Date Schedule', 'trim|required|callback_validate_date');
		$this->form_validation->set_rules('time', 'Time Schedule', 'required|callback_available_time');

		if($this->form_validation->run()){
			$time = $this->input->post('time');
			$time_arr = explode(' ', $time);
			$time_format = date('H:i:s', strtotime($time_arr[0].' '.$time_arr[1]));
			$date = $this->input->post('date').' '.$time_format;
			$type = $this->input->post('appointment-type');
			$no_dup = $this->model->check_duplicate_appointment($user['student_id'], $type);
			$disable_month = $this->model->get_option('disable_month');
			$disable_day = $this->model->get_option('disable_day');
			$month_arr = maybe_unserialize($disable_month->option_value);
			$day_arr = maybe_unserialize($disable_day->option_value);
			// print_r($arr);
			$format_month = date('F', strtotime($this->input->post('date')));
			$format_day = date('j', strtotime($this->input->post('date')));
			// echo $format_month;
			if(in_array($format_month, $month_arr) && in_array($format_day, $day_arr)){
				$output = '{"error": true, "message": "Please select only available date"}';
			}else{
				$no_dup = $this->model->check_duplicate_appointment($user['student_id'], $type);

				if($no_dup){
					$output = '{"status": true}';
				}else{
					$output = '{"error": true, "message": "[ERROR] : You still have pending appointment. Cant add multiple request."}';
				}
			}
			
		}else{
			$fields = [
                'appointment-type' => ['message' => strip_tags(form_error('appointment-type'))],
                'date' => ['message' => strip_tags(form_error('date'))],
                'time' => ['message' => strip_tags(form_error('time'))]
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


	public function gc_check_available_slots()
	{
		$output = '{"available_slots": '.max_slots().'}';
		$date = $this->input->post('date');
		$count = $this->model->count_gc_appointment($date);
		if($count > 0){
			$c = max_slots() - $count;
			$output = '{"available_slots": '.$c.'}';
		}
		return $this->output
                    ->set_content_type('application/json')
                    ->set_output($output);  
	}

	public function appointment_type($field)
	{
		$arr = ['group_counseling','exit_interview','initial_interview','post_interview'];
		if(!in_array($field, $arr)){
			$this->form_validation->set_message('appointment_type', 'This type is not in our list');
			return false;
		}else{
			return true;
		}
	}

	public function available_time($field)
	{
		$arr = allow_hour();
		if(!in_array($field, $arr)){
			$this->form_validation->set_message('available_time', 'This [time] is not available');
			return false;
		}else{
			return true;
		}
	}

	public function validate_date($str)
    {
        if ((!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $str))) {
            $this->form_validation->set_message('validate_date', '*Invalid date format');
            return false;
        } else {
            return true;
        }
    }
}
