<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model', 'model');
	}

	public function index()
	{
		$data['student'] = $this->model->request_list(1);
		print_r($data['student']);
	}
}
