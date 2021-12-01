<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model', 'model');
    }

    public function index($msg = false)
    {
        $data['title'] = 'Login';
        $data['error'] = '';
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['email_hidden'] = '';
        $data['google_id'] = '';
        $data['google_image'] = '';
        // $this->form_validation->set_rules('user', 'Username', 'trim|required');
        // $this->form_validation->set_rules('pass', 'Password', 'trim|required');

        if ($this->input->post('user') != "" || $this->input->post('google_id') != "") {
            $username = $this->input->post('user');
            $password = $this->input->post('pass');
            $google_id = $this->input->post('google_id');
            $google_image = $this->input->post('google_image');
            $tmp = $this->model->authenticate($google_id);
            if ($username != "") {
                $tmp = $this->model->authenticate_admin($username,$password);
            }

            if (COUNT($tmp) > 0) {
                if ($google_image != ""){
                    $tmp['image'] = $google_image;
                }
                $this->session->set_userdata('member_login', $tmp);
            }else{
                $data['error'] = true;
                // set google user informations
                if ($google_id != ""){
                    $data['first_name'] 	= $this->input->post('first_name');
                    $data['last_name'] 		= $this->input->post('last_name');
                    $data['email_hidden'] 			= $this->input->post('email_hidden');
                    $data['google_id']      = $this->input->post('google_id');
                    $data['google_image']      = $this->input->post('google_image');
                    // end of google informations
                    parent::view('pages/register', $data);
                    return;
                }
            }
        }

        $member_login = $this->session->userdata('member_login');

        if($member_login){
            if($member_login['user_level'] == 'administrator'){
                redirect(base_url(). 'admin');
            }else{
                $this->check_user_folder($member_login['student_id']);
                redirect(base_url(). 'student');
            }
        }
        parent::view('pages/login', $data);
    }

    private function check_user_folder($id){
        $user_folder = encodeFolder($id);
        $directory = 'assets/uploads/docs/'.$user_folder.'/';
        if(!file_exists($directory)){
            mkdir($directory, 0777, TRUE);
        }
    }

}
