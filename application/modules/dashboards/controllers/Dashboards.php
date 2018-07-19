<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboards extends MY_Controller {

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
		$this->check_session();
		$this->load->model('dashboard');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');

		$this->dashboard->setIDUser($id_user);
		$this->dashboard->setJenisUser($jenis_user);

		$data_user = $this->dashboard->get_user();

		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;
		$data['data_user'] = $data_user;

		$this->load->view('layout/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('layout/footer');
	}
}
