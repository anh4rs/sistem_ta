<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logins extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();
		$this->load->model('login');
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('login');
		$this->load->view('layout/footer');
	}

	function proses_login(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header');
			$this->load->view('login');
			$this->load->view('layout/footer');
			echo "<script>alert('Validation False')</script>";
		} else {
			$this->login->setUsername($this->input->post('username'));
			$this->login->setPassword(md5($this->input->post('password')));

			if($this->login->process_login() == "success"){
				$arr_user = array(
					'id' => $this->login->getID(),
					'id_user' => $this->login->getIDUser(),
					'jenis_user' => $this->login->getJenisUser()
				);
				$this->session->set_userdata($arr_user);
				redirect('dashboards');
			}else{
				echo "<script>alert('Username dan Password Anda salah')</script>";
				redirect('logins','refresh');
			}
		}
	}

	function logout_user(){
		$userid = $this->session->userdata('id');

		$this->login->setID($userid);
		$this->session->sess_destroy();

		redirect('logins','refresh');
	}
}