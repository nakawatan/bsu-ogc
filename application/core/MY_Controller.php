<?php
/* Parent Controller for our moduler based controllers */
class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Admin_model', 'admin');
	}

    public function view($page = false, $data = false)
    {
    	$data['user_session'] = $this->session->userdata('member_login');
    	$data['controller'] = strtolower($this->router->fetch_class());
        $data['method']     = strtolower($this->router->fetch_method());
        // $this->show_settings();
        $data['allow_hour'] = allow_hour();
        $data['allow_day'] = allow_day();
        $data['allow_month'] = allow_month();
        $appointment_list = $this->admin->get_gc_appointments();
        $data['gc_appointments_not_available'] = '';
        foreach ($appointment_list as $d) {
            $formatDate = date('Y-m-d', strtotime($d['appointment_date']));
            $c = $this->admin->count_gc_appointment($formatDate);
            if($c >= max_slots()){
                $data['gc_appointments_not_available'][] = $formatDate;
            }
        }

        $options = $this->admin->get_options();
        foreach ($options as $option) {
            $data['option'][$option['option_name']] = $option['option_value'];
        }

        $params = [
            'table' => 'announcement',
            'order_col' => 'id',
            'order_dir' => 'desc'
        ];
        $result = $this->admin->get($params);
        $data['banners'] = $result;

        $data['form_list'] = $this->admin->get_form_file();
        // Views
        $this->load->view('header', $data);
        if (is_array($page)) {
            foreach($page AS $v){
                $this->load->view($v, $data);
            }
        } else {
            $this->load->view($page, $data);
        }
        $this->load->view('footer', $data);
    }

    public function media_upload($directory = null, $img = null) 
    {
        $config['upload_path']    = './'.$directory;
        $config['allowed_types']  = 'gif|jpg|png|jpeg|mp4|pdf';
        $config['max_size']       = 0;

        $this->upload->initialize($config);
        $this->upload->do_upload($img);
        
        return $this->upload->data();
    }
    
	public function validate_file($file) {
		$check = true;
	    if (!isset($_FILES[$file]) || $_FILES[$file]['size'] == 0) {
	        // $this->form_validation->set_message('validate_file', 'The {field} field is required here');
	        $check = false;
	    } else {
	        $allowedExts = array("pdf","PDF","png","PNG","jpeg","JPEG","jpg","JPG");
	        $extension = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
	        $detectedType = exif_imagetype($_FILES[$file]['tmp_name']);
	        $type = $_FILES[$file]['type'];
	        if(filesize($_FILES[$file]['tmp_name']) > 10485760) {
	            // $this->form_validation->set_message('validate_file', 'The Image file size shoud not exceed 20MB!');
	            $check = false;
	        }
	        if(!in_array($extension, $allowedExts)) {
	            // $this->form_validation->set_message('validate_file', "Invalid file extension {$extension}");
	            $check = false;
	        }
	    }
	    return $check;
	}

	public function validate_file_msg($file) {
		$msg = '';
	    if (!isset($_FILES[$file]) || $_FILES[$file]['size'] == 0) {
	        $msg = 'This field is required.';
	    } else {
	        $allowedExts = array("pdf","PDF","png","PNG","jpeg","JPEG","jpg","JPG");
	        $extension = pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION);
	        $detectedType = exif_imagetype($_FILES[$file]['tmp_name']);
	        $type = $_FILES[$file]['type'];
	        if(filesize($_FILES[$file]['tmp_name']) > 10485760) {
	            $msg = 'The file size should not exceed 10MB!';
	        }
	        if(!in_array($extension, $allowedExts)) {
	            $msg = 'Invalid file extension ['.strtoupper($extension).']. Only PDF, PNG, JPEG and JPG are allowed.';
	        }
	    }
	    return $msg;
	}    

}
?>