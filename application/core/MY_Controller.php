<?php (defined('BASEPATH')) or exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function check_session(){
		if(!($this->session->userdata('jenis_user'))){
			redirect('logins');
		}
	}

	// default layout
	public function beview($template, $data=null){
		if (!$this->ion_auth->logged_in()){
			redirect(base_url().'permission', 'refresh');
		}else{
			if($this->uri->segment('2') AND $this->uri->segment('3')){
				$data['seg_2'] = $this->uri->segment('2');
				$data['seg_3'] = $this->uri->segment('3');
			}
			$this->load->view('layout/header', $data);
			$this->load->view($template, $data);
			$this->load->view('layout/footer');
		}
	}
}
?>
