<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model', 'model');
	}

	public function index()
	{
		redirect(base_url().'login');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
}
